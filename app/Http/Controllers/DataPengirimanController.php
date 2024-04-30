<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\DataPengiriman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DataPengirimanController extends Controller
{
    public  function index()
    {
        $datas = DataPengiriman::orderBy('id', 'DESC')->get();

        $data['datas'] = $datas;

        return view('data-pengiriman.index', $data);
    }

    public function create()
    {
        return view('data-pengiriman.create');
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'no_resi' => 'required',
            'tgl_transaksi' => 'required',
            'nama_pengirim' => 'required',
            'kota_tujuan' => 'required',
            'no_hp_pengirim' => 'required',
            'no_hp_penerima' => 'required',
            'berat_barang' => 'required',
            'ongkir' => 'required',
            'komisi' => 'required',
            'status_pembayaran' => 'required',
            'metode_pembayaran' => 'required',
            'bukti_pembayaran' => 'required'
        ]);

        $foto = $request->file('bukti_pembayaran');

        if($foto != ''){
            $foto->storeAs('public/bukti_pembayaran', $foto->hashName());
        }

        $validateData['bukti_pembayaran'] = ($foto != '' ? $foto->hashName() : '');

        DataPengiriman::create($validateData);

        Helper::logActivity('Simpan data pengiriman dengan no resi : '.$request->no_resi);

        return redirect()->route('data-pengiriman')->with('success', 'Data Berhasil Disimpan');

    }
    
    public function edit($id)
    {
        $datas = DataPengiriman::find($id);
        $data['datas'] = $datas;

        return view('data-pengiriman.edit', $data);
    }

    public function update($id, Request $request)
    {
        $validateData = $request->validate([
            'no_resi' => 'required',
            'tgl_transaksi' => 'required',
            'nama_pengirim' => 'required',
            'kota_tujuan' => 'required',
            'no_hp_pengirim' => 'required',
            'no_hp_penerima' => 'required',
            'berat_barang' => 'required',
            'ongkir' => 'required',
            'komisi' => 'required',
            'status_pembayaran' => 'required',
            'metode_pembayaran' => 'required'
        ]);

        $foto = $request->file('foto');

        $getImage = DataPengiriman::find($id);

        if($foto != ''){
            Storage::delete('public/bukti_pembayaran/'.$getImage->foto);
            $foto->storeAs('public/bukti_pembayaran', $foto->hashName());
        }

        $validateData['bukti_pembayaran'] = ($foto != '' ? $foto->hashName() : '');

        DataPengiriman::where('id', '=', $id)->update([
            'no_resi' => $request->no_resi,
            'tgl_transaksi' => $request->tgl_transaksi,
            'nama_pengirim' => $request->nama_pengirim,
            'kota_tujuan' => $request->kota_tujuan,
            'no_hp_pengirim' => $request->no_hp_pengirim,
            'no_hp_penerima' => $request->no_hp_penerima,
            'berat_barang' => $request->berat_barang,
            'ongkir' => $request->ongkir,
            'komisi' => $request->komisi,
            'status_pembayaran' => $request->status_pembayaran,
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_pembayaran' => ($foto != '' ? $foto->hashName() : $getImage->bukti_pembayaran)
        ]);

        Helper::logActivity('Update data pengiriman dengan no resi : '.$request->no_resi);

        return redirect()->route('data-pengiriman')->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $getImage = DataPengiriman::find($id);

        if(Storage::exists('public/bukti_pembayaran/'. $getImage->bukti_pembayaran)){
            Storage::delete('public/bukti_pembayaran/'. $getImage->bukti_pembayaran);
        }

        Helper::logActivity('Hapus data pengiriman dengan no resi : '.$getImage->no_resi);

        DataPengiriman::where('id', $id)->delete();

        return redirect()->route('data-pengiriman')->with('delete', 'Data pengiriman berhasil dihapus');
    }

    public function ubah_status_pembayaran(Request $request)
    {
        $datas = DataPengiriman::where('id', $request->id)->first();

        DataPengiriman::where('id', '=', $request->id)->update([
            'status_pembayaran' => $request->status_pembayaran
        ]);

        Helper::logActivity('Data status pembayaran berhasi diperbarui');

        return back()->with('success', 'Data status pembayaran berhasi diperbarui');
    }
}
