<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\DataPengiriman;
use App\Models\Invoice;
use App\Models\TransaksiInvoice;
use Carbon\Carbon;

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

        $pdf = Pdf::loadView('invoice.hasil-pdf', compact('customer', 'data' ,'picture', 'waktuCetak', 'total', 'notEmpty', 'bank', 'diskon', 'totalBersih'));
        return $pdf->stream('Invoice-'.$customer->name.'.pdf');
    }
}
