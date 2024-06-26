<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\Barang;

class BarangController extends Controller
{
    public function index(Request $request)
    {
        $datas = Barang::orderBy('id', 'DESC')->get();

        $data['datas'] = $datas;

        return view('data-barang.index', $data);
    }

    public function create()
    {
        return view('data-barang.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_barang' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
        ]);

        Barang::create($validateData);

        Helper::logActivity('Simpan data barang');

        return redirect()->route('data-barang')->with('success', 'Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $data['data'] = Barang::find($id);
        return view('data-barang.edit', $data);
    }

    public function update($id, Request $request)
    {
        $validateData = $request->validate([
            'nama_barang' => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok' => 'required',
        ]);

        Barang::where('id', '=', $id)->update([
            'nama_barang' => $request->nama_barang,
            'harga_beli' => $request->harga_beli,
            'harga_jual' => $request->harga_jual,
            'stok' => $request->stok,
        ]);

        Helper::logActivity('Update data barang dengan id: '.$id);

        return redirect()->route('data-barang')->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        Barang::where('id', $id)->delete();
        Helper::logActivity('Hapus data barang dengan id : '.$id);

        return redirect()->route('data-barang')->with('delete', 'Data barang berhasil dihapus');
    }

}
