<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogActivity;
use PDF;
use App\Exports\LogActivityExport;
use Maatwebsite\Excel\Facades\Excel;

class LogActivityController extends Controller
{
    public function index()
    {
        $logActivities = LogActivity::orderBy('id', 'DESC')->get();

        $data['log_activities'] = $logActivities;

        return view('log-activities.index', $data);
    }

    public function export_pdf()
    {
        date_default_timezone_set("Asia/Jakarta");
        $logActivities = LogActivity::orderBy('id', 'DESC')->get();
        $waktuCetak = date('d-m-Y H:i:s');

        $data['log_activities'] = $logActivities;
        $data['waktu_cetak'] = $waktuCetak;

        $pdf = PDF::loadView('log-activities.pdf', $data);
        return $pdf->download('logActivity.pdf');
    }

    public function export_excel()
    {
        return Excel::download(new LogActivityExport, 'logactivity.xlsx');
    }


}
