<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\JenisPengeluaran;
use Illuminate\Http\Request;

class JenisPengeluaranController extends Controller
{
    public function index()
    {
        $jenis_pengeluarans = JenisPengeluaran::orderBy('id', 'DESC')->get();
        $data['jenis_pengeluarans'] = $jenis_pengeluarans;
        return view('jenis-pengeluaran.index', $data);
    }

    public function create()
    {
        return isAdmin() ? view('jenis-pengeluaran.create') : back()->with('error', 'Anda Tidak Memiliki Akses');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'jenis_pengeluaran' => 'required',
            'keterangan' => 'required'
        ]);

        JenisPengeluaran::create($validateData);

        Helper::logActivity('Simpan Data Jenis Pengeluaran : '.$request->jenis_pengeluaran);

        return redirect()->route('jenis-pengeluaran')->with('success', 'Data Berhasil Disimpan!');
    }

    public function edit($id)
    {
        $jenis_pengeluaran = JenisPengeluaran::find($id);
        $data['jenis_pengeluaran'] = $jenis_pengeluaran;
        return isAdmin() ? view('jenis-pengeluaran.edit', $data) : back()->with('error', 'Anda Tidak Memiliki Akses');
    }

    public function update(Request $request)
    {
        $validateData = $request->validate([
            'jenis_pengeluaran' => 'required',
            'keterangan' => 'required'
        ]);

        JenisPengeluaran::where('id', '=', $request->id)->update([
            'jenis_pengeluaran' => $request->jenis_pengeluaran,
            'keterangan' => $request->keterangan
        ]);

        Helper::logActivity('Update Jenis Pengeluaran : '.$request->jenis_pengeluaran);

        return redirect()->route('jenis-pengeluaran')->with('success', 'Data Berhasil Diupdate!');
    }

    public function delete($id)
    {
        if (isAdmin()) {
            Helper::logActivity('Hapus Jenis Perangkat Dengan ID : '.$id);
            JenisPengeluaran::where('id', '=', $id)->delete();
            return redirect()->route('jenis-pengeluaran')->with('delete', 'Data Berhasil Dihapus!');
        } else {
            return back()->with('error', 'Anda Tidak Memiliki Akses'); 
        }
    }
}
