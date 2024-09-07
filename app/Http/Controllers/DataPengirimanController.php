<?php

namespace App\Http\Controllers;

use App\Exports\StatusPengirimanExport;
use App\Helpers\Helper;
use App\Imports\DataPengirimanImport;
use App\Imports\StatusPengirimanImport;
use App\Models\Bank;
use App\Models\Customer;
use App\Models\DataPengiriman;
use App\Models\KonversiPoint;
use App\Models\MetodePembayaran;
use App\Models\StatusPengiriman;
use App\Models\User;
use App\Models\Invoice;
use App\Models\TransaksiInvoice;
use App\Models\TransaksiPembayaran;
use App\Models\InvoiceBank;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Yaza\LaravelGoogleDriveStorage\Gdrive;
use Illuminate\Support\Facades\DB;

class DataPengirimanController extends Controller
{
    public  function index()
    {
        // $level = Session::get('user_level') == 2;
        $notif = request('notif');
        $tanggal = request('tanggal');
        $metode = request('metode');
        $customer = request('customer');
        $bukti_pembayaran = request('bukti_pembayaran');
        $nama_pengirim = request('nama_pengirim');
        $nama_penerima = request('nama_penerima');
        $owner = isOwner();
        $jumlahApprove = DataPengiriman::where('status_pembayaran', DataPengiriman::STATUS_PENDING)->count();

        $datas = DataPengiriman::select('data_pengirimen.*', 'customers.nama')
        ->leftjoin('customers', 'customers.kode_customer', '=', 'data_pengirimen.kode_customer')
        ->when(!$notif, function ($query) {
            return $query->orderBy('tgl_transaksi', 'DESC');
        })->when($notif, function ($query) {
            return $query->where('status_pembayaran', DataPengiriman::STATUS_PENDING)->orderBy('tgl_transaksi', 'DESC');
        })->when($owner && $jumlahApprove != 0, function ($query) {
            return $query->where('status_pembayaran', DataPengiriman::STATUS_PENDING)->orderBy('tgl_transaksi', 'DESC');
        })->when($tanggal, function ($query, $tanggal) {
            return $query->where('tgl_transaksi', 'LIKE', '%'.$tanggal.'%')->orderBy('tgl_transaksi', 'DESC');
        })->when($metode, function ($query, $metode) {
            return $query->where('metode_pembayaran', $metode)->orderBy('tgl_transaksi', 'DESC');
        })->when($customer, function ($query, $customer) {
            return $query->where('data_pengirimen.kode_customer', $customer)->orderBy('tgl_transaksi', 'DESC');
        })->when($bukti_pembayaran, function ($query, $bukti_pembayaran) {
            return $query->where('data_pengirimen.bukti_pembayaran', 'LIKE', $bukti_pembayaran)->orderBy('tgl_transaksi', 'DESC');
        })->when($nama_pengirim, function ($query, $nama_pengirim) {
            return $query->where('data_pengirimen.nama_pengirim', 'LIKE', $nama_pengirim)->orderBy('tgl_transaksi', 'DESC');
        })->when($nama_penerima, function ($query, $nama_penerima) {
            return $query->where('nama_penerima', 'LIKE', '%'.$nama_penerima.'%')->orderBy('tgl_transaksi', 'DESC');
        })
        ->get();
        foreach ($datas as $item) {
            $item->jumlahBuktiPembayaran = DataPengiriman::where('bukti_pembayaran', $item->bukti_pembayaran)->count(); 
        }
        $status = StatusPengiriman::orderBy('id', 'ASC')->get();

        $data['datas'] = $datas;
        $data['metode'] = MetodePembayaran::all();
        $data['customer'] = Customer::all();
        $data['status'] = $status;
        $data['status_lunas'] = DataPengiriman::STATUS_LUNAS;
        $data['status_approve'] = DataPengiriman::STATUS_APPROVE;
        $data['status_pending'] = DataPengiriman::STATUS_PENDING;
        $data['total'] = $datas->sum('ongkir');
        $data['bukti_pembayarans'] = $bukti_pembayaran;
        $data['nama_pengirim'] = Helper::nama_pengirim();

        $data['nama_penerima'] = Helper::nama_penerima();

        if (isOwner() && $jumlahApprove == 0) {
            return view('data-pengiriman.detail-lengkap-pengiriman', $data);
        }
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
        $data['bank'] = Bank::all();
        $data['metode'] = MetodePembayaran::all();
        $data['customer'] = Customer::orderBy('id')->get();

        return view('data-pengiriman.edit', $data);
    }

    public function update($id, Request $request)
    {
        $validateData = $request->validate([
            'kode_customer' => 'required',
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

        if(strtolower($request->metode_pembayaran) == "kredit") {
            $customer_terdaftar = Customer::where('kode_customer', $request->kode_customer)->exists();
            if(!$customer_terdaftar){
                return redirect()->route('data-pengiriman')->with('error', 'Metode Pembayaran Kredit Hanya Untuk Customer Terdaftar!');
            }
        }

        DataPengiriman::where('id', '=', $id)->update([
            'kode_customer' => $request->kode_customer,
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
            'bukti_pembayaran' => $request->bukti_pembayaran == NULL ? '' : $request->bukti_pembayaran
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
        Invoice::truncate();
        TransaksiInvoice::truncate();
        TransaksiPembayaran::truncate();
        InvoiceBank::truncate();
        return back()->with('success', 'Truncate Success');
    }

    public function approve($id)
    {
        $data_pengiriman = DataPengiriman::find($id);
        $new_status = $data_pengiriman->status_pembayaran == DataPengiriman::STATUS_APPROVE ? 
                    DataPengiriman::STATUS_PENDING : DataPengiriman::STATUS_APPROVE;
        
        $data_pengiriman->update([
            'status_pembayaran' => $new_status

        ]);

        // Masukkan point ke customer
        $kode_cust = $data_pengiriman->kode_customer;
        $besar_transaksi = $data_pengiriman->ongkir;

        $konversi_point = KonversiPoint::find(1);
        $pembagi_point = $konversi_point->nominal;
        $point_baru = $besar_transaksi / $pembagi_point;

        Customer::where('kode_customer', $kode_cust)->update([
            'point' => DB::raw("point + $point_baru")
        ]);

        $data = DataPengiriman::where('status_pembayaran', DataPengiriman::STATUS_PENDING)->count();
        $message = $new_status == 1 ? 'Data Pengiriman Telah Di Approve' : 'Approval Data Pengiriman Telah Dibatalkan';

        # Temporary Comment
        // if ($data == 0) {
        //     return redirect()->route('data-pengiriman')->with('success', 'Data Pengiriman Telah Di Approve');
        // }

        return back()->with('success', $message);
    }

    public function approveSelected(Request $request)
    {
        $id_pengiriman = $request->id_pengiriman;

        if($id_pengiriman == NULL){
            return back()->with('error', 'Belum Ada Data Dipilih');
        }

        for($i=0; $i<sizeof($id_pengiriman); $i++){
            $data_pengiriman = DataPengiriman::find($id_pengiriman[$i]);
            
            $new_status = $data_pengiriman->status_pembayaran == DataPengiriman::STATUS_APPROVE ? 
                    DataPengiriman::STATUS_PENDING : DataPengiriman::STATUS_APPROVE;
        
            $data_pengiriman->update([
                'status_pembayaran' => $new_status

            ]);

            // Masukkan point ke customer
            $kode_cust = $data_pengiriman->kode_customer;
            $besar_transaksi = $data_pengiriman->ongkir;

            $konversi_point = KonversiPoint::find(1);
            $pembagi_point = $konversi_point->nominal;
            $point_baru = $besar_transaksi / $pembagi_point;

            Customer::where('kode_customer', $kode_cust)->update([
                'point' => DB::raw("point + $point_baru")
            ]);
        }

        $data = DataPengiriman::where('status_pembayaran', DataPengiriman::STATUS_PENDING)->count();

        if ($data == 0) {
            return redirect()->route('data-pengiriman')->with('success', 'Data Pengiriman Telah Di Approve');
        }

        if ($request->unapprove == 'unapprove') {
            return back()->with('success', 'Approval Data Pengiriman Telah Dibatalkan');
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

    public function konfimasiExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $bank = Bank::all();
        $customer = Customer::all();
        $kasir = User::where('user_level', 4)->get();
        $metode = MetodePembayaran::all();
        $status = StatusPengiriman::all();
    
        $data = Excel::toArray(new DataPengirimanImport, $request->file('file'));
    
        $formattedData = (new DataPengirimanImport)->array($data[0]);

        // $rules = [
        //     '*.no_resi' => 'required|unique:data_pengirimen',
        //     '*.tgl_transaksi' => 'required',
        //     '*.nama_pengirim' => 'required',
        //     '*.nama_penerima' => 'required',
        //     '*.kota_tujuan' => 'required',
        //     '*.no_hp_pengirim' => 'required',
        //     '*.no_hp_penerima' => 'required',
        //     '*.berat_barang' => 'required',
        //     '*.ongkir' => 'required',
        //     '*.komisi' => 'required',
        //     '*.metode_pembayaran' => function($attribute, $value, $onFailure) {
        //         if($value !== NULL){
        //             if ($value !== 'Transfer' && $value !== 'Tunai' && $value !== 'Kredit') {
        //                 $onFailure('Metode Pembayaran Harus Transfer, Tunai, Kredit, atau Dikosongkan');
        //            }
        //         }
        //     },

        //     '*.jenis_pengiriman' => 'required',
        //     '*.bawa_sendiri' => 'required',
        //     '*.status_pengiriman' => 'required',
        // ];

        // $validator = Helper::validateFormattedData($formattedData);

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        // $validationResult = Helper::customValidasi($formattedData);

        // if ($validationResult !== null) {
        //     return $validationResult;
        // }
    
        return view('data-pengiriman.konfirmasi-data', compact('bank', 'customer','formattedData', 'kasir', 'metode', 'status'));
    }

    public function proses_hasil_import(Request $request)
    {   
        $datas = [];

        foreach ($request->no_resi as $i => $no_resi) {
            $datas[] = [
                'no_resi' => $request->no_resi[$i],
                'tgl_transaksi' => $request->tgl_transaksi[$i],
                'kode_customer' => $request->kode_customer[$i],
                'nama_pengirim' => $request->nama_pengirim[$i],
                'nama_penerima' => $request->nama_penerima[$i],
                'kota_tujuan' => $request->kota_tujuan[$i],
                'no_hp_pengirim' => $request->no_hp_pengirim[$i],
                'no_hp_penerima' => $request->no_hp_penerima[$i],
                'berat_barang' => $request->berat_barang[$i],
                'ongkir' => $request->ongkir[$i],
                'komisi' => $request->komisi[$i],

                'status_pembayaran' => $request->metode_pembayaran[$i] == "Tunai" ? DataPengiriman::STATUS_LUNAS : ($request->metode_pembayaran[$i] == "Transfer" ? DataPengiriman::STATUS_LUNAS :  DataPengiriman::STATUS_PENDING),

                'metode_pembayaran' => $request->metode_pembayaran[$i],
                'bank' => $request->bank[$i],
                'jumlah_pembayaran' => $request->jumlah_pembayaran[$i] ?? "",
                'bukti_pembayaran' => $request->bukti_pembayaran[$i] ?? "",
                'metode_pembayaran_2' => $request->metode_pembayaran_2[$i] ?? "",
                'bank_2' => $request->bank_2[$i] ?? "",
                'jumlah_pembayaran_2' => $request->jumlah_pembayaran_2[$i] ?? "",
                'bukti_pembayaran_2' => $request->bukti_pembayaran_2[$i] ?? "",
                'jenis_pengiriman' => $request->jenis_pengiriman[$i],
                'bawa_sendiri' => $request->bawa_sendiri[$i],
                'status_pengiriman' => $request->status_pengiriman[$i],
                'keterangan' => $request->keterangan[$i] != '' ? $request->keterangan[$i] : '-',
                'input_by' => $request->input_by[$i],
            ];
    
            $validator = Helper::validateFormattedData($datas);

            if ($validator->fails()) {
                return redirect()->route('data-pengiriman')->withErrors($validator)->withInput();
            }

            $validationResult = Helper::customValidasi($datas);

            if ($validationResult !== null) {
                return $validationResult;
            }
        }

        for ($i = 0; $i < count($request->no_resi); $i++) {

            $konversi_point = KonversiPoint::where('id', 1)->first();
            $customer = Customer::where('kode_customer', $request->kode_customer[$i]);
            $rcustomer = $customer->first();

            if($rcustomer != NULL){
                $pointOld = $rcustomer->point;
                $kreditOld = $rcustomer->limit_credit;
                
                // Update Point & Credit
                $customer->update([
                    'point' => $pointOld + ($request->ongkir[$i] / $konversi_point->nominal),
                    'limit_credit' => $kreditOld - $request->ongkir[$i]
                ]);
            }

            $metode_pembayaran_2 = '';
            $bank_2 = '';
            $bukti_pembayaran_2 = '';

            // if ($request->tambahPembayaran[$i] == 'on') {
                if ($request->metode_pembayaran_2[$i]) {
                    $metode_pembayaran_2 = $request->metode_pembayaran_2[$i];
                }
                if ($request->bank_2[$i]) {
                    $bank_2 = $request->bank_2[$i] ?? '';
                }
                if ($request->bukti_pembayaran_2[$i]) {
                    $bukti_pembayaran_2 = $request->bukti_pembayaran_2[$i] ?? '';
                }
            // }

            // dd($request->metode_pembayaran_2[1],$request->bukti_pembayaran_2[1], $request->bank_2[1]);
            // dd($request->bukti_pembayaran_2, $request->bank_2, $request->metode_pembayaran_2);

            DataPengiriman::create([
                'no_resi' => $request->no_resi[$i],
                'tgl_transaksi' => $request->tgl_transaksi[$i],
                'kode_customer' => $request->kode_customer[$i],
                'nama_pengirim' => $request->nama_pengirim[$i],
                'nama_penerima' => $request->nama_penerima[$i],
                'kota_tujuan' => $request->kota_tujuan[$i],
                'no_hp_pengirim' => $request->no_hp_pengirim[$i],
                'no_hp_penerima' => $request->no_hp_penerima[$i],
                'berat_barang' => $request->berat_barang[$i],
                'ongkir' => $request->ongkir[$i],
                'komisi' => $request->komisi[$i],
                // 'status_pembayaran' => strtolower($request->metode_pembayaran[$i]) == 'tunai' ? DataPengiriman::STATUS_LUNAS : (strtolower($request->metode_pembayaran[$i]) == 'transfer' ? DataPengiriman::STATUS_LUNAS : DataPengiriman::STATUS_PENDING ),
                'status_pembayaran' => DataPengiriman::STATUS_PENDING,
                'metode_pembayaran' => $request->metode_pembayaran[$i],
                'bank' => $request->bank[$i] ?? '',
                'jumlah_pembayaran' => $request->jumlah_pembayaran[$i] ?? 0,
                'bukti_pembayaran' => $request->bukti_pembayaran[$i] ?? '',
                'metode_pembayaran_2' => $request->metode_pembayaran_2[$i] ? $request->metode_pembayaran_2[$i] : "",
                'bank_2' => $request->bank_2[$i] ? $request->bank_2[$i] : "",
                'jumlah_pembayaran_2' => $request->jumlah_pembayaran_2[$i] ? $request->jumlah_pembayaran_2[$i] : 0,
                'bukti_pembayaran_2' => $request->bukti_pembayaran_2[$i] ? $request->bukti_pembayaran_2[$i] : "",
                'jenis_pengiriman' => $request->jenis_pengiriman[$i],
                'bawa_sendiri' => $request->bawa_sendiri[$i],
                'status_pengiriman' => $request->status_pengiriman[$i],
                'status_kirim_wa' => strtolower($request->status_kirim_wa[$i]) == 'ya' ? 1 : 0,
                'keterangan' => $request->keterangan[$i] != '' ? $request->keterangan[$i] : '-',
                'input_by' => $request->input_by[$i],
            ]);
        }
    
        return redirect()->route('data-pengiriman')->with('success', 'Data Pengiriman Berhasil Disimpan');
    }

    public function download_resi()
    {
        return Excel::download(new StatusPengirimanExport, 'StatusPengiriman.xlsx');
    }
}

// 13:34