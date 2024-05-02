<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\DaftarPengeluaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class DaftarPengeluaranController extends Controller
{
    public  function index()
    {
        $datas = DaftarPengeluaran::orderBy('id', 'DESC')->get();

        $data['datas'] = $datas;

        return view('daftar-pengeluaran.index', $data);
    }

    public function create()
    {
        return view('daftar-pengeluaran.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'tgl_pengeluaran' => 'required',
            'keterangan' => 'required',
            'jumlah_pembayaran' => 'required',
            'pengguna_terkait' => 'required',
            'metode_pembayaran' => 'required',
            'bukti_pembayaran' => 'required',
            'status_pengeluaran' => 'required',
            'jenis_pengeluaran' => 'required'
        ]);

        $foto = $request->file('bukti_pembayaran');

        $namafile = 'daftar-pengeluaran/'.$foto->hashName();
        $path = public_path('storage/daftar-pengeluaran/' . $foto->hashName());

        if($foto != ''){
            $foto->storeAs('public/daftar-pengeluaran', $foto->hashName());
            Storage::disk('google')->put($namafile, File::get($path));
        }

        $validateData['bukti_pembayaran'] = ($foto != '' ? $foto->hashName() : '');

        DaftarPengeluaran::create($validateData);

        Helper::logActivity('Simpan daftar pengeluaran');

        return redirect()->route('daftar-pengeluaran')->with('success', 'Data Berhasil Disimpan');

    }
    
    public function edit($id)
    {
        $datas = DaftarPengeluaran::find($id);
        $data['datas'] = $datas;

        return view('daftar-pengeluaran.edit', $data);
    }

    public function update($id, Request $request)
    {
        $validateData = $request->validate([
            'tgl_pengeluaran' => 'required',
            'keterangan' => 'required',
            'jumlah_pembayaran' => 'required',
            'pengguna_terkait' => 'required',
            'metode_pembayaran' => 'required',
            'status_pengeluaran' => 'required',
            'jenis_pengeluaran' => 'required'
        ]);

        $foto = $request->file('bukti_pembayaran');

        $getImage = DaftarPengeluaran::find($id);

        $namafile = 'daftar-pengeluaran/'.$foto->hashName();
        $path = public_path('storage/daftar-pengeluaran/' . $foto->hashName());

        if($foto != ''){
            Storage::delete('public/daftar-pengeluaran/'.$getImage->foto);
            $foto->storeAs('public/daftar-pengeluaran', $foto->hashName());
            
            Gdrive::delete('daftar-pengeluaran/'.$getImage->bukti_pembayaran);
            Storage::disk('google')->put($namafile, File::get($path));
        }

        $validateData['bukti_pembayaran'] = ($foto != '' ? $foto->hashName() : '');

        DaftarPengeluaran::where('id', '=', $id)->update([
            'tgl_pengeluaran' => $request->tgl_pengeluaran,
            'keterangan' => $request->keterangan,
            'jumlah_pembayaran' => $request->jumlah_pembayaran,
            'pengguna_terkait' => $request->pengguna_terkait,
            'metode_pembayaran' => $request->metode_pembayaran,
            'status_pengeluaran' => $request->status_pengeluaran,
            'jenis_pengeluaran' => $request->jenis_pengeluaran,
            'bukti_pembayaran' => ($foto != '' ? $foto->hashName() : $getImage->bukti_pembayaran)
        ]);

        Helper::logActivity('Update daftar pengeluaran dengan id: '.$id);

        return redirect()->route('daftar-pengeluaran')->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $getImage = DaftarPengeluaran::find($id);

        if(Storage::exists('public/daftar-pengeluaran/'. $getImage->bukti_pembayaran)){
            Storage::delete('public/daftar-pengeluaran/'. $getImage->bukti_pembayaran);
        }

        Gdrive::delete('daftar-pengeluaran/'.$getImage->bukti_pembayaran);

        Helper::logActivity('Hapus daftar pengeluaran dengan id : '.$getImage->id);

        DaftarPengeluaran::where('id', $id)->delete();

        return redirect()->route('daftar-pengeluaran')->with('delete', 'Daftar pengeluaran berhasil dihapus');
    }
}
