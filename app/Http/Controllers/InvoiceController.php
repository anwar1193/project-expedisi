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
        $options = new Options();
        $options->set('defaultFont', 'Montserrat');
        $options->set('fontDir', storage_path('fonts/'));
        $options->set('fontCache', storage_path('fonts/'));

        // Muat view dan render PDF
        $picture = public_path('assets/lion.jpg');
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml(view('invoice.pdf')->render());
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Output PDF yang dihasilkan ke browser
        return $dompdf->stream('Invoice.pdf', ['Attachment' => false]);
    }
}
