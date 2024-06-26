<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Imports\DataPengirimanImport;
use App\Imports\StatusPengirimanImport;
use App\Models\DataPengiriman;
use App\Models\StatusPengiriman;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class DataPengirimanController extends Controller
{
    public  function index()
    {
        // $level = Session::get('user_level') == 2;
        $notif = request('notif');

        $datas = DataPengiriman::when(!$notif, function ($query) {
            return $query->orderBy('tgl_transaksi', 'DESC');
        })->when($notif, function ($query) {
            return $query->where('status_pembayaran', DataPengiriman::STATUS_PENDING)->orderBy('tgl_transaksi', 'DESC');
        })->get();
        $status = StatusPengiriman::orderBy('id', 'ASC')->get();

        $data['datas'] = $datas;
        $data['status'] = $status;

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
            'metode_pembayaran' => 'required'
        ]);

        // $foto = $request->file('bukti_pembayaran');

        // $getImage = DataPengiriman::find($id);

        // if($foto != ''){
        //     Storage::delete('public/bukti_pembayaran/'.$getImage->bukti_pembayaran);
        //     $foto->storeAs('public/bukti_pembayaran', $foto->hashName());

        //     $namafile = 'data-pengiriman/'.$foto->hashName();
        //     $path = public_path('storage/bukti_pembayaran/' . $foto->hashName());

        //     Gdrive::delete('data-pengiriman/'.$getImage->bukti_pembayaran);
        //     Storage::disk('google')->put($namafile, File::get($path));
        // }

        // $validateData['bukti_pembayaran'] = ($foto != '' ? $foto->hashName() : '');

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
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_pembayaran' => $request->bukti_pembayaran
            // 'bukti_pembayaran' => ($foto != '' ? $foto->hashName() : $getImage->bukti_pembayaran)
        ]);

        Helper::logActivity('Update data pengiriman dengan no resi : '.$request->no_resi);

        return redirect()->route('data-pengiriman')->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $getImage = DataPengiriman::find($id);

        // if(Storage::exists('public/bukti_pembayaran/'. $getImage->bukti_pembayaran)){
        //     Storage::delete('public/bukti_pembayaran/'. $getImage->bukti_pembayaran);
        // }

        // Gdrive::delete('data-pengiriman/'.$getImage->bukti_pembayaran);

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

        $import = Excel::import(new DataPengirimanImport, public_path('storage/excel/data_pengiriman/' . $namafile));

        return back()->with('success', 'Data berhasil diimport');
    }

    public function truncate()
    {
        DataPengiriman::truncate();
        return back()->with('success', 'Truncate Success');
    }

    public function approve($id)
    {
        $proses = DataPengiriman::find($id)->update([
            'status_pembayaran' => 1
        ]);

        return back()->with('success', 'Data Pengiriman Telah Di Approve');
    }

    public function approveSelected(Request $request)
    {
        $id_pengiriman = $request->id_pengiriman;

        if($id_pengiriman == NULL){
            return back()->with('error', 'Belum Ada Data Dipilih');
        }

        for($i=0; $i<sizeof($id_pengiriman); $i++){
            DataPengiriman::find($id_pengiriman[$i])->update([
                'status_pembayaran' => 1
            ]);
        }

        return back()->with('success', 'Data Pengiriman Telah Di Approve');
    }

    public function import_status_pengiriman(Request $request)
    {
        $validateData = $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $data = $request->file('file');

        $namafile = $data->getClientOriginalName();

        $path = $data->storeAs('public/excel/status_pengiriman', $namafile);

        $import = new StatusPengirimanImport();
        Excel::import($import, public_path('storage/excel/status_pengiriman/' . $namafile));

        $errors = $import->getErrors();
        if (!empty($errors)) {
            return redirect()->back()->with('errorStatus', $errors);
        }

        return back()->with('success', 'Data berhasil diimport');
    }
}

// 13:34