<?php

namespace App\Http\Controllers;

use App\Exports\DataPengeluaranExport;
use App\Helpers\Helper;
use App\Models\DaftarPengeluaran;
use App\Models\JenisPengeluaran;
use App\Models\SettingWa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class DaftarPengeluaranController extends Controller
{
    private function saveBase64Image($image)
    {
        $folderPath = "public/daftar-pengeluaran/";
        $image_parts = explode(";base64,", $image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = uniqid() . '.png';
        $file = $folderPath . $fileName;

        return ['file' => $file, 'fileName' => $fileName, 'image_base64' => $image_base64];
    }
    public  function index()
    {
        $kategori = request('kategori');
        $owner = isOwner();
        $datas = DaftarPengeluaran::select('daftar_pengeluarans.id', 'daftar_pengeluarans.tgl_pengeluaran', 'daftar_pengeluarans.keterangan', 'daftar_pengeluarans.jumlah_pembayaran', 'daftar_pengeluarans.yang_membayar', 'daftar_pengeluarans.yang_menerima', 'daftar_pengeluarans.metode_pembayaran', 'daftar_pengeluarans.bukti_pembayaran', 'daftar_pengeluarans.status_pengeluaran', 'jenis_pengeluarans.jenis_pengeluaran')
                ->leftJoin('jenis_pengeluarans', 'jenis_pengeluarans.id', '=', 'daftar_pengeluarans.jenis_pengeluaran')
                ->when($kategori, function ($query, $kategori) {
                    return $query->where('daftar_pengeluarans.jenis_pengeluaran', $kategori);
                })->when($owner, function ($query) {
                    $pending = 2;
                    return $query->where('daftar_pengeluarans.status_pengeluaran', $pending);
                })
                ->orderBy('daftar_pengeluarans.id', 'DESC')->get();

        $data['jenis_pengeluaran'] = JenisPengeluaran::all();

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
        $today = date('Y-m-d');
        $validateData = $request->validate([
            'tgl_pengeluaran' => 'required|date',
            'keterangan' => 'required',
            'jumlah_pembayaran' => 'required',
            'yang_menerima' => 'required',
            'metode_pembayaran' => 'required',
            'jenis_pengeluaran' => 'required'
        ]);

        $foto = $request->file('bukti_pembayaran');
        $img = $request->image;      
        $link_img = $request->link;

        if($foto != ''){
            // Set Up Untuk Penyimopnan Image ke GDrive
            $namafile = 'daftar-pengeluaran/'.$foto->hashName();
            $path = public_path('storage/daftar-pengeluaran/' . $foto->hashName());

            // Proses Simoan Storage
            $foto->storeAs('public/daftar-pengeluaran', $foto->hashName());

            // Proses Simpan GDrive
            Storage::disk('google')->put($namafile, File::get($path));

            $validateData['bukti_pembayaran'] = $foto->hashName();
        } elseif (($img != '') && ($request->takeImage == 'on')) {
            // Proses Image Base64
            $imageData = $this->saveBase64Image($img);
            $file = $imageData['file'];
            $fileName = $imageData['fileName'];
            $fileNamePath = 'daftar-pengeluaran/'.$imageData['fileName'];
            $image_base64 = $imageData['image_base64'];
            $path = public_path('storage/daftar-pengeluaran/' . $fileName);

            // Proses Simpan Storage
            Storage::disk('local')->put($file, $image_base64);

            // Proses Simpan GDrive
            Storage::disk('google')->put($fileNamePath, File::get($path));

            $validateData['bukti_pembayaran'] = $fileName;
        } elseif (($link_img != '') && ($request->addLink == 'on')) {
            $validateData['bukti_pembayaran'] = $link_img;
        }

        $validateData['yang_membayar'] = Session::get('nama');
        $validateData['status_pengeluaran'] = DaftarPengeluaran::STATUS_PENDING;
        $validateData['keterangan_tambahan'] = $request->keterangan_tambahan;

        DaftarPengeluaran::create($validateData);

        $data = DaftarPengeluaran::orderBy('id', 'DESC')->first();
        $url = SettingWa::select('url_message AS url')->latest()->first();
        $no_hp = Helper::dataOwner()->nomor_telepon;
        $nama_owner = Helper::dataOwner()->nama;
        $kategori = Helper::daftar_pengeluaran($validateData['jenis_pengeluaran'])->jenis_pengeluaran;
        $message = 'Telah terjadi pengeluaran kategori '. $kategori .' sejumlah Rp '. $validateData['jumlah_pembayaran'] .' ditanggal '. $validateData['tgl_pengeluaran'] .', diterima oleh '. $nama_owner .'. Silahkan Klik Link Berikut Untuk Approve : ' . URL::to('/').'/owner/approve/'.($data->id).'?link=owner';

        $dataSending = sendWaText($no_hp, $message);
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($url->url, $dataSending);

        Helper::logActivity('Simpan daftar pengeluaran');

        return redirect()->route('daftar-pengeluaran')->with('success', 'Data Pengeluaran Berhasil Ditambahkan');

    }
    
    public function edit($id)
    {
        $datas = DaftarPengeluaran::find($id);
        $jenis_pengeluaran = JenisPengeluaran::all();
        $data['datas'] = $datas;
        $data['jenis_pengeluaran'] = $jenis_pengeluaran;

        return $datas->status_pengeluaran == 1 ?  back()->with('error', 'Data Yang Telah Di Approve Tidak Bisa Diedit Kembali') : view('daftar-pengeluaran.edit', $data);
    }

    public function update($id, Request $request)
    {
        $validateData = $request->validate([
            'tgl_pengeluaran' => 'required|date',
            'keterangan' => 'required',
            'jumlah_pembayaran' => 'required',
            'yang_menerima' => 'required',
            'metode_pembayaran' => 'required',
            'jenis_pengeluaran' => 'required'
        ]);

        $foto = $request->file('bukti_pembayaran');
        $img = $request->image;
        $link_img = $request->link;

        $getImage = DaftarPengeluaran::find($id);

        if ($getImage->status_pengeluaran == DaftarPengeluaran::STATUS_APPROVE) {
            return back()->with('error', 'Data Yang Telah Di Approve Tidak Bisa Diedit Kembali');
        }

        if($foto != ''){
            // Proses Simoan Storage
            Storage::delete('public/daftar-pengeluaran/'.$getImage->foto);
            $foto->storeAs('public/daftar-pengeluaran', $foto->hashName());

            // Set Up Untuk Penyimopnan Image ke GDrive
            $namafile = 'daftar-pengeluaran/'.$foto->hashName();
            $path = public_path('storage/daftar-pengeluaran/' . $foto->hashName());

            // Proses Simoan GDrive
            Gdrive::delete('daftar-pengeluaran/'.$getImage->bukti_pembayaran);
            Storage::disk('google')->put($namafile, File::get($path));
            $buktiPembayaran = $foto->hashName();
        } elseif (($img != '') && ($request->takeImage == 'on')) {
            // Proses Image Base64
            $imageData = $this->saveBase64Image($img);
            $file = $imageData['file'];
            $fileName = $imageData['fileName'];
            $image_base64 = $imageData['image_base64'];

            // Proses Simoan Storage
            Storage::delete('public/daftar-pengeluaran/'.$getImage->foto);
            Storage::disk('local')->put($file, $image_base64);

            // Set Up Untuk Penyimopnan Image ke GDrive
            $namafile = 'daftar-pengeluaran/'.$fileName;
            $path = public_path('storage/daftar-pengeluaran/' . $fileName);

            // Proses Simoan Storage
            Gdrive::delete('daftar-pengeluaran/'.$getImage->bukti_pembayaran);
            Storage::disk('google')->put($namafile, File::get($path));

            $buktiPembayaran = $fileName;
        } elseif (($link_img != '') && ($request->addLink == 'on')) {
            $buktiPembayaran = $link_img;
        }

        DaftarPengeluaran::where('id', '=', $id)->update([
            'tgl_pengeluaran' => $request->tgl_pengeluaran,
            'keterangan' => $request->keterangan,
            'jumlah_pembayaran' => $request->jumlah_pembayaran,
            'yang_menerima' => $request->yang_menerima,
            'metode_pembayaran' => $request->metode_pembayaran,
            'jenis_pengeluaran' => $request->jenis_pengeluaran,
            'bukti_pembayaran' => ($foto || $img || $link_img ? $buktiPembayaran : $getImage->bukti_pembayaran),
            'keterangan_tambahan' => $request->keterangan_tambahan
        ]);

        $url = SettingWa::select('url_message AS url')->latest()->first();
        $no_hp = Helper::dataOwner()->nomor_telepon;
        $nama_owner = Helper::dataOwner()->nama;
        $kategori = Helper::daftar_pengeluaran($validateData['jenis_pengeluaran'])->jenis_pengeluaran;
        $message = 'Terdapat perubahan data pengeluaran pada data yang belum diapprove. Silahkan Klik Link Berikut Untuk Approve : ' . URL::to('/').'/owner/approve/'.($id).'?link=owner';

        $dataSending = sendWaText($no_hp, $message);
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($url->url, $dataSending);

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

    public function approve($id)
    {
        $link = request('link');
        $data = DaftarPengeluaran::find($id);

        if($link && $data->status_pengeluaran == DaftarPengeluaran::STATUS_APPROVE){
            return redirect()->route('error-page1')->with('error', 'Data Pengeluaran Telah Di Approve');
        }

        if($link && !$data){
            return redirect()->route('error-page1')->with('error', 'Data Pengeluaran Tidak Ditemukan');
        }
        $proses = DaftarPengeluaran::find($id)->update([
            'status_pengeluaran' => DaftarPengeluaran::STATUS_APPROVE
        ]);

        if($link) return redirect()->route('data-pengeluaran.approved', ['id' => $id])->with('success', 'Data Pengeluaran Telah Di Approve');

        return back()->with('success', 'Data Pengeluaran Telah Di Approve');
    }

    public function approveSelected(Request $request)
    {
        $id_pengeluaran = $request->id_pengeluaran;

        if($id_pengeluaran == NULL){
            return back()->with('error', 'Belum Ada Data Dipilih');
        }

        for($i=0; $i<sizeof($id_pengeluaran); $i++){
            DaftarPengeluaran::find($id_pengeluaran[$i])->update([
                'status_pengeluaran' => DaftarPengeluaran::STATUS_APPROVE
            ]);
        }

        return back()->with('success', 'Data Pengeluaran Telah Di Approve');
    }
    
    public function cancelApprove($id)
    {
        $proses = DaftarPengeluaran::find($id)->update([
            'status_pengeluaran' => DaftarPengeluaran::STATUS_PENDING
        ]);

        return back()->with('success', 'Approval Data Pengeluaran Telah Dibatalkan');
    }

    public function cancelApproveSelected(Request $request)
    {
        $id_pengeluaran = $request->id_pengeluaran;

        if($id_pengeluaran == NULL){
            return back()->with('error', 'Belum Ada Data Dipilih');
        }

        for($i=0; $i<sizeof($id_pengeluaran); $i++){
            DaftarPengeluaran::find($id_pengeluaran[$i])->update([
                'status_pengeluaran' => DaftarPengeluaran::STATUS_PENDING
            ]);
        }

        return back()->with('success', 'Approval Data Pengeluaran Telah Dibatalkan');
    }

    public function linkApprove($id) 
    {
        $data['data'] = DaftarPengeluaran::select('daftar_pengeluarans.*', 'jenis_pengeluarans.jenis_pengeluaran AS jenisPengeluaran')
                    ->where('daftar_pengeluarans.id', $id)
                    ->join('jenis_pengeluarans', 'jenis_pengeluarans.id', '=', 'daftar_pengeluarans.jenis_pengeluaran')
                    ->first();

        return view('approve.data-pengeluaran', $data);
    }

    public function export()
    {
        if (request('format') === 'pdf') {
            $data['data'] = DaftarPengeluaran::orderBy('id', 'DESC')->get();;

            $pdf = Pdf::loadView('daftar-pengeluaran.export-pdf', $data)->setPaper('a4', 'landscape');
            return $pdf->stream('Data-Pengeluaran.pdf');
        } elseif (request('format') === 'excel') {
            return Excel::download(new DataPengeluaranExport, 'Data-Pengeluaran.xlsx');      
        }
    }
}
