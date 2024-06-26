<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\Barang;
use App\Models\BarangMasuk;

class BarangMasukController extends Controller
{
    public function index(Request $request)
    {
        $datas = BarangMasuk::orderBy('id', 'DESC')->get();

        $data['datas'] = $datas;

        return view('data-barang-masuk.index', $data);
    }
}
