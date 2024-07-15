<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{
    public  function index()
    {
        $datas = Supplier::orderBy('id', 'DESC')->get();

        $data['datas'] = $datas;

        return view('supplier.index', $data);
    }

    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_supplier' => 'required',
            'nomor_hp' => 'required',
            'alamat' => 'required',
        ]);
        $validateData['note'] = $request->note;
        Supplier::create($validateData);

        Helper::logActivity('Simpan Data Supplier');

        return redirect()->route('supplier')->with('success', 'Data Supplier Berhasil Disimpan');

    }
    
    public function edit($id)
    {
        $datas = Supplier::find($id);
        $data['datas'] = $datas;

        return view('supplier.edit', $data);
    }

    public function update($id, Request $request)
    {
        $validateData = $request->validate([
            'nama_supplier' => 'required',
            'nomor_hp' => 'required',
            'alamat' => 'required',
        ]);

        Supplier::where('id', '=', $id)->update([
            'nama_supplier' => $request->nama_supplier,
            'nomor_hp' => $request->nomor_hp,
            'alamat' => $request->alamat,
            'note' => $request->note,
        ]);

        Helper::logActivity('Update data supplier '.$request->nama_supplier);

        return redirect()->route('supplier')->with('success', 'Data Supplier Berhasil Diupdate');
    }

    public function delete($id)
    {
        Supplier::where('id', $id)->delete();

        Helper::logActivity('Hapus data supplier berhasil');

        return redirect()->route('supplier')->with('delete', 'Data Supplier berhasil dihapus');
    }
}
