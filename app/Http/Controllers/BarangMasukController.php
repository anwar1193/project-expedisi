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
        $barang = Barang::orderBy('id', 'ASC')->get();

        $data['barang'] = $barang;

        return view('data-barang-masuk.index', $data);
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'tanggal_masuk' => 'required',
            'id_barang' => 'required',
            'jumlah' => 'required'
        ]);

        $validateData['keterangan'] = $request->keterangan;

        BarangMasuk::create($validateData);

        // Update Stok Barang
        $barang = Barang::where('id', $request->id_barang);
        $stok_lama = $barang->first()->stok;
        $stok_baru = $stok_lama + $request->jumlah;
        $barang->update([
            'stok' => $stok_baru
        ]);

        Helper::logActivity('Simpan Transaksi Barang Masuk');

        return redirect()->route('data-barang')->with('success', 'Barang masuk berhasil ditambahkan');
    }
}
