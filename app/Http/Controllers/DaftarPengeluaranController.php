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
        $datas = DaftarPengeluaran::select('daftar_pengeluarans.id', 'daftar_pengeluarans.tgl_pengeluaran', 'daftar_pengeluarans.keterangan', 'daftar_pengeluarans.jumlah_pembayaran', 'daftar_pengeluarans.yang_membayar', 'daftar_pengeluarans.yang_menerima', 'daftar_pengeluarans.metode_pembayaran', 'daftar_pengeluarans.bukti_pembayaran', 'daftar_pengeluarans.status_pengeluaran', 'jenis_pengeluarans.jenis_pengeluaran')
                ->leftJoin('jenis_pengeluarans', 'jenis_pengeluarans.id', '=', 'daftar_pengeluarans.jenis_pengeluaran')
                ->when($kategori, function ($query, $kategori) {
                    return $query->where('daftar_pengeluarans.jenis_pengeluaran', $kategori);
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
            'keterangan' => 'required',
            'jumlah_pembayaran' => 'required',
            'yang_menerima' => 'required',
            'metode_pembayaran' => 'required',
            'jenis_pengeluaran' => 'required'
        ]);

        $foto = $request->file('bukti_pembayaran');
        $img = $request->image;      

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
        }

        $validateData['yang_membayar'] = Session::get('nama');
        $validateData['tgl_pengeluaran'] = $today;
        $validateData['status_pengeluaran'] = DaftarPengeluaran::STATUS_PENDING;
        $validateData['keterangan_tambahan'] = $request->keterangan_tambahan;

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

        return $datas->status_pengeluaran == 1 ?  back()->with('error', 'Data Yang Telah Di Approve Tidak Bisa Diedit Kembali') : view('daftar-pengeluaran.edit', $data);
    }

    public function update($id, Request $request)
    {
        $validateData = $request->validate([
            'keterangan' => 'required',
            'jumlah_pembayaran' => 'required',
            'yang_menerima' => 'required',
            'metode_pembayaran' => 'required',
            'jenis_pengeluaran' => 'required'
        ]);

        $foto = $request->file('bukti_pembayaran');
        $img = $request->image;

        $getImage = DaftarPengeluaran::find($id);

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
        }

        DaftarPengeluaran::where('id', '=', $id)->update([
            'keterangan' => $request->keterangan,
            'jumlah_pembayaran' => $request->jumlah_pembayaran,
            'yang_menerima' => $request->yang_menerima,
            'metode_pembayaran' => $request->metode_pembayaran,
            'jenis_pengeluaran' => $request->jenis_pengeluaran,
            'bukti_pembayaran' => ($foto || $img ? $buktiPembayaran : $getImage->bukti_pembayaran),
            'keterangan_tambahan' => $request->keterangan_tambahan
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

    public function approve($id)
    {
        $proses = DaftarPengeluaran::find($id)->update([
            'status_pengeluaran' => 1
        ]);

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
                'status_pengeluaran' => 1
            ]);
        }

        return back()->with('success', 'Data Pengeluaran Telah Di Approve');
    }
}
