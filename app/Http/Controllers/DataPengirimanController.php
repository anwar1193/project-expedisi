<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Imports\DataPengirimanImport;
use App\Models\DataPengiriman;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

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
            'nama_penerima' => 'required',
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
            'nama_penerima' => 'required',
            'kota_tujuan' => 'required',
            'no_hp_pengirim' => 'required',
            'no_hp_penerima' => 'required',
            'berat_barang' => 'required',
            'ongkir' => 'required',
            'komisi' => 'required',
            'status_pembayaran' => 'required',
            'metode_pembayaran' => 'required'
        ]);

        $foto = $request->file('bukti_pembayaran');

        $getImage = DataPengiriman::find($id);

        $namafile = 'data-pengiriman/'.$foto->hashName();
        $path = public_path('storage/bukti_pembayaran/' . $foto->hashName());

        if($foto != ''){
            Storage::delete('public/bukti_pembayaran/'.$getImage->bukti_pembayaran);
            $foto->storeAs('public/bukti_pembayaran', $foto->hashName());

            Gdrive::delete('data-pengiriman/'.$getImage->bukti_pembayaran);
            Storage::disk('google')->put($namafile, File::get($path));
        }

        $validateData['bukti_pembayaran'] = ($foto != '' ? $foto->hashName() : '');

        DataPengiriman::where('id', '=', $id)->update([
            'no_resi' => $request->no_resi,
            'tgl_transaksi' => $request->tgl_transaksi,
            'nama_pengirim' => $request->nama_pengirim,
            'nama_penerima' => $request->nama_penerima,
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

        Gdrive::delete('data-pengiriman/'.$getImage->bukti_pembayaran);

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

    public function import_excel(Request $request)
    {
        $validateData = $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        
        $data = $request->file('file');

        $namafile = $data->getClientOriginalName();

        $path = $data->storeAs('public/excel/data_pengiriman', $namafile);

        Excel::import(new DataPengirimanImport, public_path('storage/excel/data_pengiriman/' . $namafile));

        return back()->with('success', 'Data berhasil diimport');
    }
}
