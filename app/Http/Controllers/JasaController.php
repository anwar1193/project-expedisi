<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\Jasa;

class JasaController extends Controller
{
    public function index(Request $request)
    {
        $datas = Jasa::orderBy('id', 'DESC')->get();

        $data['datas'] = $datas;

        return view('data-jasa.index', $data);
    }

    public function create()
    {
        return view('data-jasa.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nama_jasa' => 'required',
            'keterangan' => 'required'
        ]);

        Jasa::create($validateData);

        Helper::logActivity('Simpan data jasa');

        return redirect()->route('data-jasa')->with('success', 'Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $data['data'] = Jasa::find($id);
        return view('data-jasa.edit', $data);
    }

    public function update($id, Request $request)
    {
        $validateData = $request->validate([
            'nama_jasa' => 'required',
            'keterangan' => 'required',
        ]);

        Jasa::where('id', '=', $id)->update([
            'nama_jasa' => $request->nama_jasa,
            'keterangan' => $request->keterangan,
        ]);

        Helper::logActivity('Update data jasa dengan id: '.$id);

        return redirect()->route('data-jasa')->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        Jasa::where('id', $id)->delete();
        Helper::logActivity('Hapus data jasa dengan id : '.$id);

        return redirect()->route('data-jasa')->with('delete', 'Data jasa berhasil dihapus');
    }
}
