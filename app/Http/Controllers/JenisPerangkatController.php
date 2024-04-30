<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisPerangkat;
use App\Helpers\Helper;

class JenisPerangkatController extends Controller
{
    public function index()
    {
        $jenis_perangkats = JenisPerangkat::orderBy('id', 'DESC')->get();
        $data['jenis_perangkats'] = $jenis_perangkats;
        return view('jenis-perangkat.index', $data);
    }

    public function create()
    {
        return isAdmin() ? view('jenis-perangkat.create') : back()->with('error', 'Anda Tidak Memiliki Akses');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kode_jenis' => 'required',
            'jenis' => 'required'
        ]);

        JenisPerangkat::create($validateData);

        Helper::logActivity('Simpan Data Jenis Perangkat : '.$request->jenis);

        return redirect()->route('jenis-perangkat')->with('success', 'Data Berhasil Disimpan!');
    }

    public function edit($id)
    {
        $jenis_perangkat = JenisPerangkat::find($id);
        $data['jenis_perangkat'] = $jenis_perangkat;
        return isAdmin() ? view('jenis-perangkat.edit', $data) : back()->with('error', 'Anda Tidak Memiliki Akses');
    }

    public function update(Request $request)
    {
        $validateData = $request->validate([
            'kode_jenis' => 'required',
            'jenis' => 'required'
        ]);

        JenisPerangkat::where('id', '=', $request->id)->update([
            'kode_jenis' => $request->kode_jenis,
            'jenis' => $request->jenis
        ]);

        Helper::logActivity('Update Jenis Perangkat : '.$request->jenis);

        return redirect()->route('jenis-perangkat')->with('success', 'Data Berhasil Diupdate!');
    }

    public function delete($id)
    {
        if (isAdmin()) {
            Helper::logActivity('Hapus Jenis Perangkat Dengan ID : '.$id);
            JenisPerangkat::where('id', '=', $id)->delete();
            return redirect()->route('jenis-perangkat')->with('delete', 'Data Berhasil Dihapus!');
        } else {
            return back()->with('error', 'Anda Tidak Memiliki Akses'); 
        }
    }
}
