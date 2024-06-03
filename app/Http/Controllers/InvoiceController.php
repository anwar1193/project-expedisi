<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Http\Request;

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
}
