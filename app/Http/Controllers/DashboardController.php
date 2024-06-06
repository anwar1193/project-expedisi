<?php

namespace App\Http\Controllers;

use App\Models\DataPengiriman;
use Illuminate\Http\Request;
use App\Models\SurveilanceCar;
use App\Models\Perangkat;
use App\Models\LogActivity;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $tahun_terpilih = $request->input("tahun") ? $request->input("tahun") : Carbon::now()->year;

        // $jumlahArmada = SurveilanceCar::select("merk")
        //                 ->whereYear('created_at', $tahun_terpilih)
        //                 ->get()->count();

        // $armada = SurveilanceCar::select("*")
        //             ->whereYear('created_at', $tahun_terpilih)            
        //             ->get();

        $aktifitas = [];

        for ($i = 1; $i <= 12; $i++) {
            $jumlah = LogActivity::where('activity', 'Login aplikasi')
                        ->whereYear('created_at', $tahun_terpilih)
                        ->whereMonth('created_at', $i)
                        ->count();

            array_push($aktifitas, $jumlah);
        }

        return view("admin.dashboard.default", compact(["aktifitas"]));
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

    public function dashboard_customer(Request $request) {
        $id = Session::get('id');
        $metode = 'Kredit';
        // $no_resi = 'Enim libero fugiat';
        $no_resi = $request->no_resi;

        $user = User::select('users.*', 'levels.level AS nama_level')
            ->join('levels', 'levels.id', '=', 'users.user_level')
            ->where('users.id', '=', $id)
            ->first();

        $tagihan = DataPengiriman::where('metode_pembayaran', $metode)
                    ->orderBy('id', 'DESC')->get();

        $resi =  DataPengiriman::join('status_pengirimen AS status', 'status.status_pengiriman', '=', 'data_pengirimen.status_pengiriman')
                ->where('no_resi', $no_resi)->first();

        return view('customers.dashboard', compact('user', 'tagihan', 'resi'));
    }
}
