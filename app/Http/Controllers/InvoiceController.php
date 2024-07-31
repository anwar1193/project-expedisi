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
use App\Models\TransaksiPembayaran;
use App\Models\InvoiceBank;
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

        $data = DataPengiriman::select('data_pengirimen.*')
                ->leftJoin('transaksi_invoices', 'data_pengirimen.id', '=', 'transaksi_invoices.data_pengiriman_id')
                ->where('data_pengirimen.kode_customer', $customer->kode_customer)
                ->where('data_pengirimen.status_pembayaran', DataPengiriman::STATUS_PENDING)
                ->whereNull('transaksi_invoices.data_pengiriman_id')
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

        $invoice = Invoice::create([
            'customer_id' => $customer_id,
            'invoice_no' => $no_invoice
        ]);

        return redirect()->route('invoices.detail', ['id' => $customer_id]);
    }

    public function detail($id)
    {
        $customer = Customer::find($id);
        $data = DataPengiriman::select('data_pengirimen.*')
                ->leftJoin('transaksi_invoices', 'data_pengirimen.id', '=', 'transaksi_invoices.data_pengiriman_id')
                ->where('data_pengirimen.kode_customer', $customer->kode_customer)
                ->where('data_pengirimen.status_pembayaran', DataPengiriman::STATUS_PENDING)
                ->whereNull('transaksi_invoices.data_pengiriman_id')
                ->orderBy('id', 'DESC')->get();
        foreach ($data as $item) {
            $transaksi = TransaksiInvoice::where('data_pengiriman_id', $item->id)
                    ->orderBy('id', 'ASC')->get();
            $item->transaksi = $transaksi;
        }

        $invoice = Invoice::where('customer_id', $id)->orderBy('id', 'DESC')->first();

        $total = DataPengiriman::selectRaw('SUM(ongkir) AS total')
                ->leftJoin('transaksi_invoices', 'data_pengirimen.id', '=', 'transaksi_invoices.data_pengiriman_id')
                ->where('status_pembayaran', DataPengiriman::STATUS_PENDING)
                ->whereNull('transaksi_invoices.invoice_id')
                ->where('kode_customer', $customer->kode_customer)->first();

        $totalBersih = round($total->total * $customer->diskon / 100);

        $exist = TransaksiInvoice::where('invoice_id', $invoice->id)->exists();

        $today = date('Y-m-d');

        $bank = Bank::all();

        return view('invoice.hasil', compact('data', 'customer', 'today', 'total', 'invoice', 'exist', 'bank', 'totalBersih'));
    }

    public function all_invoices(Request $request)
    {
        $tanggal = $request->tanggal;
        $customer = $request->customer_id;
        $status = $request->status;
        $customers = Customer::all();

        $data = Invoice::select('invoices.invoice_no', 'invoices.created_at', 'invoices.id AS invoiceId', 'invoices.diskon', 'customers.id', 'customers.kode_customer', 'customers.nama', 'customers.diskon AS diskon_customer')
                ->join('customers', 'customers.id', '=', 'invoices.customer_id')
                ->when($customer, function ($query, $customer) {
                    return $query->where('customers.id', $customer);
                })
                ->when($tanggal, function ($query, $tanggal) {
                    return $query->WhereDate('invoices.created_at', $tanggal);
                })
                ->orderBy('invoices.id', 'DESC')
                ->get();
                
            foreach ($data as $item) {
                $total = DataPengiriman::selectRaw('SUM(ongkir) AS total')
                ->join('transaksi_invoices', 'transaksi_invoices.data_pengiriman_id', '=', 'data_pengirimen.id')
                ->where('kode_customer', $item->kode_customer)
                ->where('invoice_id', $item->invoiceId)
                ->first();

                $nominal = TransaksiPembayaran::selectRaw('SUM(nominal) AS total')
                            ->where('invoice_id', $item->invoiceId)->first();

                $diskon = round($total->total * $item->diskon_customer / 100);

                $totalBersih = round($total->total - $item->diskon - $diskon);

                if ($nominal) {
                    $item->sisa = round($totalBersih - $nominal->total);
                } else {
                    $item->sisa = $totalBersih;
                }

                $item->totalBersih = $totalBersih;
            }

            $data = $data->filter(function ($item) use ($status) {
                if ($status == '1') {
                    return $item->sisa == 0;
                } elseif ($status == '0') {
                    return $item->sisa != 0;
                }
                return true;
            });
                    
            $data = $data->values();
                
        return view('invoice.all', compact('data', 'customers'));
    }

    public function handleInvoiceTransactions(Request $request, $id, $invoiceId)
    {
        $id_pengiriman = $request->id_pengiriman;
        $bank_id = $request->bank_id;

        $diskon = $request->diskon ?? 0;
        $customer = Customer::select('customers.id', 'customers.kode_customer', 'customers.nama', 'customers.alamat', 'invoices.invoice_no', 'invoices.id AS invoiceId', 'invoices.diskon')
                    ->join('invoices', 'invoices.customer_id', '=', 'customers.id')
                    ->where('customers.id', $id)
                    ->where('invoices.id', $invoiceId)
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

            foreach($bank_id as $id_bank){
                InvoiceBank::create([
                    'id_invoice' => $customer->invoiceId,
                    'id_bank' => $id_bank
                ]);
            }
    
            Invoice::find($customer->invoiceId)->update([
                'diskon' => $diskon
            ]); 
        }

        return redirect()->route('invoice.hasil-transaksi', ['id' => $customer->id, 'invoiceId' => $customer->invoiceId])->with("success", "Generate Invoice Berhasil");
    }

    public function generateInvoicePdf($id, $invoiceId)
    {
        $customer = Customer::select('customers.id', 'customers.diskon AS diskon_customer', 'customers.kode_customer', 'customers.nama', 'customers.alamat', 'customers.perusahaan', 'invoices.invoice_no', 'invoices.invoice_name', 'invoices.id AS invoiceId', 'invoices.diskon', 'invoices.created_at')
                    ->join('invoices', 'invoices.customer_id', '=', 'customers.id')
                    ->where('customers.id', $id)
                    ->where('invoices.id', $invoiceId)
                    ->first();

        $data = DataPengiriman::join('transaksi_invoices', 'transaksi_invoices.data_pengiriman_id', '=', 'data_pengirimen.id')
                ->where('kode_customer', $customer->kode_customer)
                ->where('invoice_id', $invoiceId)
                ->orderBy('data_pengirimen.id', 'DESC')->get();
                
        $total = DataPengiriman::selectRaw('SUM(ongkir) AS total')
                ->join('transaksi_invoices', 'transaksi_invoices.data_pengiriman_id', '=', 'data_pengirimen.id')
                ->where('kode_customer', $customer->kode_customer)
                ->where('invoice_id', $invoiceId)
                ->first();

        $diskon = round($total->total * $customer->diskon_customer / 100);

        $totalBersih = round($total->total - $customer->diskon - $diskon);

        $bank = InvoiceBank::select('invoice_banks.*', 'banks.bank', 'banks.nomor_rekening', 'banks.atas_nama', 'banks.cabang')
                ->join('banks', 'banks.id', '=', 'invoice_banks.id_bank')
                ->where('invoice_banks.id_invoice', $invoiceId)
                ->get();

        $notEmpty = $data->isNotEmpty();
        $waktuCetak = date('d-m-Y H:i:s');
        $picture = public_path('assets/lionparcel.png');
        $customerName = str_replace(' ', '', $customer->nama);

        ini_set('max_execution_time', 300);
        ini_set("memory_limit","512M");
        
        $pdf = Pdf::loadView('invoice.hasil-pdf', compact('customer', 'data' ,'picture', 'waktuCetak', 'total', 'notEmpty', 'bank', 'diskon', 'totalBersih', 'bank'));
        $pdfContent = $pdf->output();

        if (!Storage::exists('public/invoices/Invoice-'.$customer->invoice_name.'.pdf')) {
            // Simpan ke storage
            $name_invoice = $customerName.date("YmdHis"); 
            Storage::put('public/invoices/Invoice-'.$name_invoice.'.pdf', $pdfContent);

           Invoice::find($customer->invoiceId)->update([
                'invoice_name' => $name_invoice
            ]);             
        }
        
        return $pdf->stream('Invoice-'.$customerName.'.pdf');
    }

    public function send_wa_invoice(Request $request)
    {
        $id = $request->id;
        $invoiceId = $request->invoice_id;
        $customer = Customer::find($id);
        $invoice = Invoice::where('id', $invoiceId)->where('customer_id', $customer->id)->first();
        $customerName = str_replace(' ', '', $customer->nama);
        $pesan = Pesan::find(Pesan::INV);

        if (!Storage::exists('public/invoices/Invoice-'.$invoice->invoice_name.'.pdf')) {
            return back()->with("error", "Silahkan Cetak invoice Terlebih Dahulu");
        }

        $dataSending = sendWaText($customer->no_wa, $pesan->isi_pesan);
        $dataSendings = sendWaUrl($customer->no_wa, URL::to('/'). "/storage/invoices/Invoice-".$invoice->invoice_name.".pdf");
    
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
        $invoiceId = $request->invoice_id;
        $pesan = Pesan::find(Pesan::INV);
        $invoice = Customer::select('customers.id', 'customers.diskon AS diskon_customer', 'customers.kode_customer', 'customers.nama', 'customers.email', 'customers.alamat', 'invoices.invoice_no', 'invoices.invoice_name', 'invoices.id AS invoiceId', 'invoices.diskon', 'invoices.created_at')
                    ->join('invoices', 'invoices.customer_id', '=', 'customers.id')
                    ->where('invoices.id', $invoiceId)
                    ->where('customers.id', $id)
                    ->first();

        $invoice->customerName = str_replace(' ', '', $invoice->nama);
        $invoice->isi_pesan = $pesan->isi_pesan;
        if (!Storage::exists('public/invoices/Invoice-'.$invoice->invoice_name.'.pdf')) {
            return back()->with("error", "Silahkan Cetak invoice Terlebih Dahulu");
        }
                                       //natiboh@mailinator.com 
        Mail::to($invoice->email)->send(new MailInvoice($invoice));

        return redirect()->route("invoices.index")->with("success", "Invoice Berhasil Dikirim Ke Email " .$invoice->nama);
    }

    public function hasil_transaksi($id, $invoiceId)
    {
        $customer = Customer::select('customers.id', 'customers.diskon AS diskon_customer', 'customers.kode_customer', 'customers.nama', 'customers.alamat', 'customers.perusahaan', 'invoices.invoice_no', 'invoices.invoice_name', 'invoices.id AS invoiceId', 'invoices.diskon', 'invoices.created_at')
                    ->join('invoices', 'invoices.customer_id', '=', 'customers.id')
                    ->where('customers.id', $id)
                    ->where('invoices.id', $invoiceId)
                    ->first();

        $data = DataPengiriman::join('transaksi_invoices', 'transaksi_invoices.data_pengiriman_id', '=', 'data_pengirimen.id')
                ->where('kode_customer', $customer->kode_customer)
                ->where('invoice_id', $invoiceId)
                ->orderBy('data_pengirimen.id', 'DESC')->get();
                
        $total = DataPengiriman::selectRaw('SUM(ongkir) AS total')
                ->join('transaksi_invoices', 'transaksi_invoices.data_pengiriman_id', '=', 'data_pengirimen.id')
                ->where('kode_customer', $customer->kode_customer)
                ->where('invoice_id', $invoiceId)
                ->first();

        $diskon = round($total->total * $customer->diskon_customer / 100);

        $totalBersih = round($total->total - $customer->diskon - $diskon);

        $bank = InvoiceBank::select('invoice_banks.*', 'banks.bank', 'banks.nomor_rekening', 'banks.atas_nama', 'banks.cabang')
                ->join('banks', 'banks.id', '=', 'invoice_banks.id_bank')
                ->where('invoice_banks.id_invoice', $invoiceId)
                ->get();

        return view('invoice.hasil-transaksi', compact('customer', 'data', 'total', 'diskon', 'totalBersih', 'bank'));
    }

    public function pembayaran_invoice(Request $request)
    {
        $validateData = $request->validate([
            'invoice_id' => 'required|numeric',
            'nominal' => 'required|numeric',
            'tanggal_bayar' => 'required',
            'bukti_bayar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $foto = $request->file('bukti_bayar');

        if ($request->nominal > $request->total_tagihan) {
            return back()->with('error', 'Nominal Yang Anda Masukan Melebihi Total Sisa Tagihan');
        }

        if($foto != ''){
            $foto->storeAs('public/invoice-bukti-bayar', $foto->hashName());
        }

        $validateData['bukti_bayar'] = ($foto != '' ? $foto->hashName() : '');

        TransaksiPembayaran::create($validateData);

        return redirect()->route('invoices.index')->with('success', 'Pembayaran Invoice Berhasil Ditambahkan');
    }

    public function detail_riwayat_invoices($invoiceId)
    {
        $datas = TransaksiPembayaran::select('transaksi_pembayarans.*', 'invoices.invoice_no')
                ->leftjoin('invoices', 'invoices.id', '=', 'transaksi_pembayarans.invoice_id')
                ->where('transaksi_pembayarans.invoice_id', $invoiceId)
                ->orderBy('transaksi_pembayarans.id', 'DESC')
                ->get();

        return view('invoice.riwayat-pembayaran', compact('datas'));
    }
}