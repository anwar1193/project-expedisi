<?php

namespace App\Http\Controllers;

use App\Models\RiwayatArmada;
use Illuminate\Http\Request;

class RiwayatArmadaController extends Controller
{
    public function index()
    {
        $riwayat = RiwayatArmada::select('riwayat_armadas.lat', 'riwayat_armadas.lang', 'riwayat_armadas.created_at','cars.merk', 'cars.nopol')
                    ->join('surveilance_cars AS cars', 'cars.id', '=', 'riwayat_armadas.car_id')
                    ->orderBy('riwayat_armadas.id', 'DESC')->get();
        $data['riwayat'] = $riwayat;

        return view('riwayat-armada.index', $data);
    }
}
