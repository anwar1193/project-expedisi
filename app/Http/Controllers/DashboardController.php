<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SurveilanceCar;
use App\Models\Perangkat;
use App\Models\LogActivity;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $tahun_terpilih = $request->input("tahun") ? $request->input("tahun") : Carbon::now()->year;

        $jumlahArmada = SurveilanceCar::select("merk")
                        ->whereYear('created_at', $tahun_terpilih)
                        ->get()->count();

        $jammer = Perangkat::select("*")->where("jenis_perangkat", "JMR")
                    ->whereYear('created_at', $tahun_terpilih)       
                    ->get()->count();

        $otherDevice = Perangkat::select("*")->where("jenis_perangkat", "!=", "JMR")
                        ->whereYear('created_at', $tahun_terpilih)
                        ->get()->count();

        $armada = SurveilanceCar::select("*")
                    ->whereYear('created_at', $tahun_terpilih)            
                    ->get();

        $aktifitas = [];

        for ($i = 1; $i <= 12; $i++) {
            $jumlah = LogActivity::where('activity', 'Login aplikasi')
                        ->whereYear('created_at', $tahun_terpilih)
                        ->whereMonth('created_at', $i)
                        ->count();

            array_push($aktifitas, $jumlah);
        }

        return view("admin.dashboard.default", compact(["jumlahArmada", "jammer", "otherDevice", "armada", "aktifitas"]));
    }

    public function riwayatArmada($id) 
    {
        $item = SurveilanceCar::select("*")
                    ->where('id', $id)            
                    ->first();

        return view("admin.dashboard.action.riwayat", compact("item"));
    }

    public function lokasiArmada($id) 
    {
        $item = SurveilanceCar::select("*")
                    ->where('id', $id)            
                    ->first();

        return view("admin.dashboard.action.location", compact("item"));
    }
}
