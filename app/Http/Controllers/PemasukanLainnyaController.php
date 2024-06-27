<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Barang;
use App\Models\Customer;
use App\Models\Jasa;
use App\Models\PemasukanLainnya;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class PemasukanLainnyaController extends Controller
{
    private function saveBase64Image($image)
    {
        $folderPath = "public/data-pemasukkan/";
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
        $datas = PemasukanLainnya::orderBy('id', 'DESC')->get();

        $data['datas'] = $datas;

        return view('data-pemasukan.index', $data);
    }

    public function create()
    {
        $customer = Customer::orderBy('kode_customer', 'ASC')->get();
        $barangs = Barang::all();
        $jasas = Jasa::all();

        return view('data-pemasukan.create', compact('customer', 'barangs', 'jasas'));
    }

    public function store(Request $request)
    { 
        $today = date('Y-m-d');
        $validateData = $request->validate([
            'kategori' => 'required',
            'modal' => 'required',
            'keterangan' => 'required',
            'jumlah_pemasukkan' => 'required',
            'sumber_pemasukkan' => 'required_without:customer',
            'customer' => 'required_without:sumber_pemasukkan',
            'metode_pembayaran' => 'required',
            'bukti_pembayaran' => 'required_without:image',
            'image' => 'required_without:bukti_pembayaran', 
            'keterangan_tambahan' => 'required',
        ]);

        $foto = $request->file('bukti_pembayaran');
        $img = $request->image;      

        if($foto != ''){
            // Set Up Untuk Penyimopnan Image ke GDrive
            $namafile = 'data-pemasukkan/'.$foto->hashName();
            $path = public_path('storage/data-pemasukkan/' . $foto->hashName());

            // Proses Simoan Storage
            $foto->storeAs('public/data-pemasukkan', $foto->hashName());

            // Proses Simpan GDrive
            // Storage::disk('google')->put($namafile, File::get($path));

            $validateData['bukti_pembayaran'] = $foto->hashName();
        } elseif (($img != '') && ($request->takeImage == 'on')) {
            // Proses Image Base64
            $imageData = $this->saveBase64Image($img);
            $file = $imageData['file'];
            $fileName = $imageData['fileName'];
            $fileNamePath = 'data-pemasukkan/'.$imageData['fileName'];
            $image_base64 = $imageData['image_base64'];
            $path = public_path('storage/data-pemasukkan/' . $fileName);

            // Proses Simpan Storage
            Storage::disk('local')->put($file, $image_base64);

            // Proses Simpan GDrive
            // Storage::disk('google')->put($fileNamePath, File::get($path));

            $validateData['bukti_pembayaran'] = $fileName;
        }

        $barang = $request->barang;
        $jasa = $request->jasa;

        $validateData['barang_jasa'] = $barang != '' ? $barang : $jasa;
        $validateData['diterima_oleh'] = Session::get('nama');
        $validateData['tgl_pemasukkan'] = $today;
        $validateData['sumber_pemasukkan'] = !$request->dataCustomer ? $request->sumber_pemasukkan : $request->customer;
        $validateData['keterangan_tambahan'] = $request->keterangan_tambahan;

        PemasukanLainnya::create($validateData);

        Helper::logActivity('Simpan data pemasukan');

        return redirect()->route('data-pemasukan')->with('success', 'Data Berhasil Disimpan');

    }

    public function edit($id)
    {
        $datas = PemasukanLainnya::find($id);
        $data['customerSelected'] = Customer::where('nama', $datas->sumber_pemasukkan)->first();
        $data['customer'] = Customer::orderBy('kode_customer', 'ASC')->get();
        $data['barang'] = Barang::orderBy('id', 'ASC')->get();
        $data['jasa'] = Jasa::orderBy('id', 'ASC')->get();
        $data['datas'] = $datas;

        return view('data-pemasukan.edit', $data);
    }

    public function update($id, Request $request)
    {
        $validateData = $request->validate([
            'kategori' => 'required',
            'modal' => 'required',
            'keterangan' => 'required',
            'jumlah_pemasukkan' => 'required',
            'sumber_pemasukkan' => 'required_without:customer',
            'customer' => 'required_without:sumber_pemasukkan',
            'metode_pembayaran' => 'required',
            'keterangan_tambahan' => 'required',
        ]);

        $foto = $request->file('bukti_pembayaran');
        $img = $request->image;

        $getImage = PemasukanLainnya::find($id);

        if($foto != ''){
            // Proses Simoan Storage
            Storage::delete('public/data-pemasukkan/'.$getImage->foto);
            $foto->storeAs('public/data-pemasukkan', $foto->hashName());

            // Set Up Untuk Penyimopnan Image ke GDrive
            $namafile = 'data-pemasukkan/'.$foto->hashName();
            $path = public_path('storage/data-pemasukkan/' . $foto->hashName());

            // Proses Simoan GDrive
            Gdrive::delete('data-pemasukkan/'.$getImage->bukti_pembayaran);
            Storage::disk('google')->put($namafile, File::get($path));
            $buktiPembayaran = $foto->hashName();
        } elseif (($img != '') && ($request->takeImage == 'on')) {
            // Proses Image Base64
            $imageData = $this->saveBase64Image($img);
            $file = $imageData['file'];
            $fileName = $imageData['fileName'];
            $image_base64 = $imageData['image_base64'];

            // Proses Simoan Storage
            Storage::delete('public/data-pemasukkan/'.$getImage->foto);
            Storage::disk('local')->put($file, $image_base64);

            // Set Up Untuk Penyimopnan Image ke GDrive
            $namafile = 'data-pemasukkan/'.$fileName;
            $path = public_path('storage/data-pemasukkan/' . $fileName);

            // Proses Simoan Storage
            Gdrive::delete('data-pemasukkan/'.$getImage->bukti_pembayaran);
            Storage::disk('google')->put($namafile, File::get($path));

            $buktiPembayaran = $fileName;
        }

        $sumber_pemasukkan = !$request->dataCustomer ? $request->sumber_pemasukkan : $request->customer;
        $barang_jasa = $request->barang ? $request->barang : $request->jasa;

        PemasukanLainnya::where('id', '=', $id)->update([
            'kategori' => $request->keterangan,
            'barang_jasa' => $barang_jasa,
            'modal' => $request->modal,
            'jumlah_pemasukkan' => $request->jumlah_pemasukkan,
            'sumber_pemasukkan' => $sumber_pemasukkan,
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_pembayaran' => ($foto || $img ? $buktiPembayaran : $getImage->bukti_pembayaran),
            'keterangan_tambahan' => $request->keterangan_tambahan,
        ]);

        Helper::logActivity('Update data pemasukan dengan id: '.$id);

        return redirect()->route('data-pemasukan')->with('success', 'Data Berhasil Diupdate');
    }
    
    public function delete($id)
    {
        $getImage = PemasukanLainnya::find($id);

        if(Storage::exists('public/data-pemasukkan/'. $getImage->bukti_pembayaran)){
            Storage::delete('public/data-pemasukkan/'. $getImage->bukti_pembayaran);
        }

        Gdrive::delete('data-pemasukkan/'.$getImage->bukti_pembayaran);
        PemasukanLainnya::where('id', $id)->delete();
        Helper::logActivity('Hapus data pemasukan dengan id : '.$id);

        return redirect()->route('data-pemasukan')->with('delete', 'Data pemasukan berhasil dihapus');
    }

    public function tanda_terima_pdf($id)
    {
        $picture = public_path('assets/lionparcel.png');
        $data = $datas = PemasukanLainnya::where('id', $id)->first();
        $customPaper = array(0, 0, 350, 700);
        $pdf = Pdf::loadView('data-pemasukan.tanda-terima-pdf', compact('picture', 'data'))->setPaper($customPaper, 'landscape');
        return $pdf->stream('Tanda-Terima.pdf');
    }
}
