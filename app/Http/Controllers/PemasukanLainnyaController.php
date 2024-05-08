<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\PemasukanLainnya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PemasukanLainnyaController extends Controller
{
    public  function index()
    {
        $datas = PemasukanLainnya::orderBy('id', 'DESC')->get();

        $data['datas'] = $datas;

        return view('data-pemasukan.index', $data);
    }

    public function create()
    {
        return view('data-pemasukan.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kategori' => 'required',
            'nama_customer' => 'required',
            'harga' => 'required',
            'tanggal_transaksi' => 'required',
            'komisi' => 'required',
        ]);

        PemasukanLainnya::create($validateData);

        Helper::logActivity('Simpan data pemasukan');

        return redirect()->route('data-pemasukan')->with('success', 'Data Berhasil Disimpan');

    }

    public function edit($id)
    {
        $datas = PemasukanLainnya::find($id);
        $data['datas'] = $datas;

        return view('data-pemasukan.edit', $data);
    }

    public function update($id, Request $request)
    {
        $validateData = $request->validate([
            'kategori' => 'required',
            'nama_customer' => 'required',
            'harga' => 'required',
            'tanggal_transaksi' => 'required',
            'komisi' => 'required',
        ]);

        PemasukanLainnya::where('id', '=', $id)->update([
            'kategori' => $request->kategori,
            'nama_customer' => $request->nama_customer,
            'harga' => $request->harga,
            'tanggal_transaksi' => $request->tanggal_transaksi,
            'komisi' => $request->komisi,
        ]);

        Helper::logActivity('Update data pemasukan dengan id: '.$id);

        return redirect()->route('data-pemasukan')->with('success', 'Data Berhasil Diupdate');
    }
    
    public function delete($id)
    {
        Helper::logActivity('Hapus data pemasukan dengan id : '.$id);

        PemasukanLainnya::where('id', $id)->delete();

        return redirect()->route('data-pemasukan')->with('delete', 'Data pemasukan berhasil dihapus');
    }
}
