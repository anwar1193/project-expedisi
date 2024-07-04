<?php

namespace App\Http\Controllers;

use App\Mail\Invoice as MailInvoice;
use App\Models\Bank;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\DataPengiriman;
use App\Models\Invoice;
use App\Models\Pesan;
use App\Models\TransaksiInvoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class InvoiceController extends Controller
{
    public function index() {
        return view('invoice.index');
    }

    public function export_pdf()
    {
        $picture = public_path('assets/lionparcel.png');
        $pdf = Pdf::loadView('invoice.pdf', compact('picture'));
        return $pdf->stream('Invoice.pdf');
    }
    
    public function bukti_terima_pdf()
    {
        $picture = public_path('assets/lionparcel.png');
        $customPaper = array(0, 0, 350, 700);
        $pdf = Pdf::loadView('invoice.bukti-terima-pdf', compact('picture'))->setPaper($customPaper, 'landscape');
        return $pdf->stream('Bukti-Terima.pdf');
    }

    public function createInvoice()
    {
        $data['customer'] = Customer::orderBy('id')->get();
        return view('invoice.create', $data);
    }

    public function generateInvoice(Request $request)
    {
        $customer_id = $request->customer;
        if (!$customer_id) {
            return back()->with('error', 'Pilih Customer terlebih Dahulu');
        }

        $customer = Customer::find($customer_id);
        if (!$customer) {
            return back()->with('error', 'Customer tidak ditemukan');
        }

        $data = DataPengiriman::where('kode_customer', $customer->kode_customer)
                ->where('status_pembayaran', 2)
                ->orderBy('id', 'DESC')->get();
        foreach ($data as $item) {
            $transaksi = TransaksiInvoice::where('data_pengiriman_id', $item->id)
                    ->orderBy('id', 'ASC')->get();
            $item->transaksi = $transaksi;
        }

        if ($data->isEmpty()) {
            return back()->with('error', 'Customer Belum Memiliki Riwayat Transaksi');
        }

        $month = Carbon::now()->format('m');
        $year = Carbon::now()->format('Y');
        $count_invoice = Invoice::whereMonth('created_at', $month)->count() + 1;
        $no_invoice = "{$count_invoice}/INV/LP/{$year}";

        $invoice = Invoice::firstOrCreate(
            ['customer_id' => $customer_id],
            ['invoice_no' => $no_invoice]
        );

        $total = DataPengiriman::selectRaw('SUM(ongkir) AS total')
                ->join('transaksi_invoices', 'transaksi_invoices.data_pengiriman_id', '=', 'data_pengirimen.id')
                ->where('kode_customer', $customer->kode_customer)->first();

        $today = date('Y-m-d');

        return view('invoice.hasil', compact('data', 'customer', 'today', 'total', 'invoice'));
    }

    public function all_invoices(Request $request)
    {
        $tanggal = $request->tanggal;
        $customer = $request->customer_id;
        $customers = Customer::all();

        $data = Invoice::select('invoices.invoice_no', 'invoices.created_at', 'customers.id', 'customers.kode_customer', 'customers.nama')
                ->join('customers', 'customers.id', '=', 'invoices.customer_id')
                ->when($customer, function ($query, $customer) {
                    return $query->where('customers.id', $customer);
                })
                ->when($tanggal, function ($query, $tanggal) {
                    return $query->WhereDate('invoices.created_at', $tanggal);
                })
                ->orderBy('invoices.id', 'DESC')
                ->get();

        return view('invoice.all', compact('data', 'customers'));
    }

    public function handleInvoiceTransactions(Request $request, $id)
    {
        $id_pengiriman = $request->id_pengiriman;
        $diskon = $request->diskon;
        $customer = Customer::select('customers.id', 'customers.kode_customer', 'customers.nama', 'customers.alamat', 'invoices.invoice_no', 'invoices.id AS invoiceId', 'invoices.diskon')
                    ->join('invoices', 'invoices.customer_id', '=', 'customers.id')
                    ->where('customers.id', $id)
                    ->first();

        if (!isCustomer()) {
            if ($id_pengiriman == NULL) {
                return back()->with('error', 'Belum Ada Data Dipilih');
            }
    
            foreach ($id_pengiriman as $pengiriman_id) {
                $exist = TransaksiInvoice::where('data_pengiriman_id', $pengiriman_id)->exists();
                if (!$exist) {
                    TransaksiInvoice::create([
                        'invoice_id' => $customer->invoiceId,
                        'data_pengiriman_id' => $pengiriman_id
                    ]);
                }
            }
    
            Invoice::find($customer->invoiceId)->update([
                'diskon' => $diskon
            ]); 
        }

        return redirect()->route('invoice.customer-pdf', ['id' => $customer->id]);
    }

    public function generateInvoicePdf($id)
    {
        $customer = Customer::select('customers.id', 'customers.diskon AS diskon_customer', 'customers.kode_customer', 'customers.nama', 'customers.alamat', 'invoices.invoice_no', 'invoices.id AS invoiceId', 'invoices.diskon', 'invoices.created_at')
                    ->join('invoices', 'invoices.customer_id', '=', 'customers.id')
                    ->where('customers.id', $id)
                    ->first();

        $data = DataPengiriman::join('transaksi_invoices', 'transaksi_invoices.data_pengiriman_id', '=', 'data_pengirimen.id')
                ->where('kode_customer', $customer->kode_customer)
                ->orderBy('data_pengirimen.id', 'DESC')->get();
                
        $total = DataPengiriman::selectRaw('SUM(ongkir) AS total')
                ->join('transaksi_invoices', 'transaksi_invoices.data_pengiriman_id', '=', 'data_pengirimen.id')
                ->where('kode_customer', $customer->kode_customer)->first();

        $diskon = round($total->total * $customer->diskon_customer / 100);

        $totalBersih = round($total->total - $customer->diskon - $diskon);

        $bank = Bank::orderBy('id')->get();

        $notEmpty = $data->isNotEmpty();
        $waktuCetak = date('d-m-Y H:i:s');
        $picture = public_path('assets/lionparcel.png');
        $customerName = str_replace(' ', '', $customer->nama);

        ini_set('max_execution_time', 300);
        ini_set("memory_limit","512M");
        
        $pdf = Pdf::loadView('invoice.hasil-pdf', compact('customer', 'data' ,'picture', 'waktuCetak', 'total', 'notEmpty', 'bank', 'diskon', 'totalBersih'));
        $pdfContent = $pdf->output();

        // Simpan ke storage
        Storage::put('public/invoices/Invoice-'.$customerName.'.pdf', $pdfContent);
        return $pdf->stream('Invoice-'.$customerName.'.pdf');
    }

    public function send_wa_invoice(Request $request)
    {
        $id = $request->id;
        $customer = Customer::find($id);
        $customerName = str_replace(' ', '', $customer->nama);
        $pesan = Pesan::find(Pesan::INV);

        if (!Storage::exists('public/invoices/Invoice-'.$customerName.'.pdf')) {
            return back()->with("error", "Silahkan Cetak invoice Terlebih Dahulu");
        }

        $dataSending = sendWaText($customer->no_wa, $pesan->isi_pesan);
        $dataSendings = sendWaUrl($customer->no_wa, URL::to('/'). "/storage/invoices/Invoice-".$customerName.".pdf");
    
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://api.watzap.id/v1/send_message', $dataSending);
            
            $responses = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://api.watzap.id/v1/send_file_url', $dataSendings);
    
            // if ($response->successful()) {
            if ($response->successful() && $responses->successful()) {
               return redirect()->route("invoices.index")->with("success", "Invoice Berhasil Dikirim Ke WhatsApp " .$customer->nama);
            } else {
                return redirect()->route("invoices.index")->with("error", "Invoice Gagal Dikirim Ke WhatsApp " .$customer->nama);
            }
        } catch (\Throwable $e) {
            // return redirect()->route("invoices.index")->with("error", "Koneksi ke watzap.id gagal");
            return redirect()->route("invoices.index")->with("success", "Proses Pengiriman Invoice Kepada ".$customer->nama." Berhasil");
        }
    }

    public function send_email_invoice(Request $request)
    {
        $id = $request->id;
        $pesan = Pesan::find(Pesan::INV);
        $invoice = Customer::select('customers.id', 'customers.diskon AS diskon_customer', 'customers.kode_customer', 'customers.nama', 'customers.email', 'customers.alamat', 'invoices.invoice_no', 'invoices.id AS invoiceId', 'invoices.diskon', 'invoices.created_at')
                    ->join('invoices', 'invoices.customer_id', '=', 'customers.id')
                    ->where('customers.id', $id)
                    ->first();

        $invoice->customerName = str_replace(' ', '', $invoice->nama);
        $invoice->isi_pesan = $pesan->isi_pesan;
        // if (!Storage::exists('/public/invoices/invoice-'. $invoice->customerName .'.pdf')) {
        //     return back()->with("error", "Silahka Cetak invoice Terlebih Dahulu");
        // }
                                
        Mail::to($invoice->email)->send(new MailInvoice($invoice));

        return redirect()->route("invoices.index")->with("success", "Invoice Berhasil Dikirim Ke Email " .$invoice->nama);
    }

    public function test_wa()
    {
        $dataSending = [
            "api_key" => "TYBUL3W5VDXSUT9P",
            "number_key" => "TAlgCr43YndCNG0g",
            "phone_no" => 6282375377287,
            "message" => "Test Invoice",
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://api.watzap.id/v1/send_message', $dataSending);

        return "Berhasil";
    }
}