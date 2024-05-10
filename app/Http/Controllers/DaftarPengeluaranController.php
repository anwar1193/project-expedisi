<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\DaftarPengeluaran;
use App\Models\JenisPengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class DaftarPengeluaranController extends Controller
{
    public  function index()
    {
        $datas = DaftarPengeluaran::select('daftar_pengeluarans.id', 'daftar_pengeluarans.tgl_pengeluaran', 'daftar_pengeluarans.keterangan', 'daftar_pengeluarans.jumlah_pembayaran', 'daftar_pengeluarans.yang_membayar', 'daftar_pengeluarans.yang_menerima', 'daftar_pengeluarans.metode_pembayaran', 'daftar_pengeluarans.bukti_pembayaran', 'daftar_pengeluarans.status_pengeluaran', 'jenis_pengeluarans.jenis_pengeluaran')
                ->leftJoin('jenis_pengeluarans', 'jenis_pengeluarans.id', '=', 'daftar_pengeluarans.jenis_pengeluaran')
                ->orderBy('daftar_pengeluarans.id', 'DESC')->get();

        $data['datas'] = $datas;

        return view('daftar-pengeluaran.index', $data);
    }

    public function create()
    {
        $jenis_pengeluaran = JenisPengeluaran::all();
        $data['jenis_pengeluaran'] = $jenis_pengeluaran;
        if ($jenis_pengeluaran->count() == 0) {
            return redirect()->route('jenis-pengeluaran.create')->with('error', 'Silahkan tambahkan jenis pengeluaran terlebih dahulu');
        }
        return view('daftar-pengeluaran.create', $data);
    }

    public function store(Request $request)
    {

        $validateData = $request->validate([
            'keterangan' => 'required',
            'jumlah_pembayaran' => 'required',
            'yang_menerima' => 'required',
            'metode_pembayaran' => 'required',
            'bukti_pembayaran' => 'required',
            'jenis_pengeluaran' => 'required'
        ]);

        // $jenis_pengeluaran = JenisPengeluaran::find($request->jenis_pengeluaran);

        // $validateData['keterangan'] = $jenis_pengeluaran->keterangan;
        $validateData['yang_membayar'] = Session::get('nama');
        $validateData['tgl_pengeluaran'] = date('Y-m-d');
        $validateData['status_pengeluaran'] = 2;

        DaftarPengeluaran::create($validateData);

        Helper::logActivity('Simpan daftar pengeluaran');

        return redirect()->route('daftar-pengeluaran')->with('success', 'Data Berhasil Disimpan');

    }
    
    public function edit($id)
    {
        $datas = DaftarPengeluaran::find($id);
        $jenis_pengeluaran = JenisPengeluaran::all();
        $data['datas'] = $datas;
        $data['jenis_pengeluaran'] = $jenis_pengeluaran;

        return view('daftar-pengeluaran.edit', $data);
    }

    public function update($id, Request $request)
    {
        $validateData = $request->validate([
            'keterangan' => 'required',
            'jumlah_pembayaran' => 'required',
            'yang_menerima' => 'required',
            'metode_pembayaran' => 'required',
            'status_pengeluaran' => 'required',
            'jenis_pengeluaran' => 'required'
        ]);

        $getImage = DaftarPengeluaran::find($id);

        DaftarPengeluaran::where('id', '=', $id)->update([
            'keterangan' => $request->keterangan,
            'jumlah_pembayaran' => $request->jumlah_pembayaran,
            'yang_menerima' => $request->yang_menerima,
            'metode_pembayaran' => $request->metode_pembayaran,
            'jenis_pengeluaran' => $request->jenis_pengeluaran,
            'status_pengeluaran' => $request->status_pengeluaran,
            'bukti_pembayaran' => $request->bukti_pembayaran
        ]);

        Helper::logActivity('Update daftar pengeluaran dengan id: '.$id);

        return redirect()->route('daftar-pengeluaran')->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $getImage = DaftarPengeluaran::find($id);

        Helper::logActivity('Hapus daftar pengeluaran dengan id : '.$getImage->id);

        DaftarPengeluaran::where('id', $id)->delete();

        return redirect()->route('daftar-pengeluaran')->with('delete', 'Daftar pengeluaran berhasil dihapus');
    }
}
