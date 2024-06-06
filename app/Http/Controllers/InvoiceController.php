<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\DataPengiriman;

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

        $today = date('Y-m-d');

        $customer = Customer::find($customer_id);

        $data = DataPengiriman::where('kode_customer', $customer->kode_customer)
                ->orderBy('data_pengirimen.id', 'DESC')->get();

        $total = DataPengiriman::selectRaw('SUM(ongkir) AS total')->where('kode_customer', $customer->kode_customer)->first();

        if (!$customer_id) {
            return back()->with('error', 'Pilih Customer terlebih Dahulu');
        } elseif ($data->isEmpty()) {
            return back()->with('error', 'Customer Belum Memiliki Riwayat Transaksi');
        }   
        return view('invoice.hasil', compact('data', 'customer', 'today', 'total'));
    }

    public function generateInvoicePdf($id) 
    {
        $customer = Customer::find($id);

        $data = DataPengiriman::where('kode_customer', $customer->kode_customer)
                ->orderBy('data_pengirimen.id', 'DESC')->get();

        $total = DataPengiriman::selectRaw('SUM(ongkir) AS total')->where('kode_customer', $customer->kode_customer)->first();

        $notEmpty = $data->isNotEmpty();
        $waktuCetak = date('d-m-Y H:i:s');

        $picture = public_path('assets/lionparcel.png');
        $pdf = Pdf::loadView('invoice.hasil-pdf', compact('customer', 'data' ,'picture', 'waktuCetak', 'total', 'notEmpty'));
        return $pdf->stream('Invoice-'.$customer->name.'.pdf');
    }
}
