<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Barang;
use App\Models\Customer;
use App\Models\Jasa;
use App\Models\PemasukanLainnya;
use App\Models\DataPengiriman;
use App\Models\MetodePembayaran;
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
        $resi = DataPengiriman::all();
        $metode = MetodePembayaran::all();

        return view('data-pemasukan.create', compact('customer', 'barangs', 'jasas', 'resi', 'metode'));
    }

    public function store(Request $request)
    { 
        $today = date('Y-m-d');
        $validateData = $request->validate([
            'no_resi_pengiriman' => 'required',
            'kategori' => 'required',
            'modal' => 'required',
            'keterangan' => 'required',
            'jumlah_pemasukkan' => 'required',
            'sumber_pemasukkan' => 'required_without:customer',
            'customer' => 'required_without:sumber_pemasukkan',
            'metode_pembayaran' => 'required',
            'bukti_pembayaran' => 'required_without:image',
            'metode_pembayaran2' => 'nullable',
            'image' => 'required_without:bukti_pembayaran', 
            'keterangan_tambahan' => 'required',
        ]);

        $foto = $request->file('bukti_pembayaran'); // take picture
        $img = $request->image;      
        $foto2 = $request->file('bukti_pembayaran2'); // take picture
        $img2 = $request->image2;     

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
        
        if($foto2 != ''){
            // Proses Simoan Storage
            $namafile = 'data-pemasukkan/'.$foto2->hashName();

            // Proses Simpan GDrive
            // Storage::disk('google')->put($namafile, File::get($path));

            $foto2->storeAs('public/data-pemasukkan', $foto2->hashName());
            $validateData['bukti_pembayaran2'] = $foto2->hashName();
        } elseif (($img2 != '') && ($request->takeImage2 == 'on')) {
            // Proses Image Base64
            // Pembayaran 2
            $imageData2 = $this->saveBase64Image($img2);
            $file2 = $imageData2['file'];
            $fileName2 = $imageData2['fileName'];
            $fileNamePath = 'data-pemasukkan/'.$imageData2['fileName'];
            $image_base64_2 = $imageData2['image_base64'];
            $path = public_path('storage/data-pemasukkan/' . $fileName2);

            Storage::disk('local')->put($file2, $image_base64_2);
            $validateData['bukti_pembayaran2'] = $fileName2;
        }

        $barang = $request->barang;
        $jasa = $request->jasa;
        $jumlah_barang = $request->jumlah_barang;

        if ($validateData['metode_pembayaran2'] != '' && $validateData['bukti_pembayaran2'] == '') {
            return back()->with('error', 'Bukti Pembayaran 2 Wajib Diisi Jika Pilih Multi Pembayaran');
        }
        $validateData['barang_jasa'] = $barang != '' ? $barang : $jasa;
        $validateData['jumlah_barang'] = $barang != '' ? $jumlah_barang : 0;
        $validateData['diterima_oleh'] = Session::get('nama');
        $validateData['tgl_pemasukkan'] = $today;
        $validateData['sumber_pemasukkan'] = !$request->dataCustomer ? $request->sumber_pemasukkan : $request->customer;
        $validateData['keterangan_tambahan'] = $request->keterangan_tambahan;

        PemasukanLainnya::create($validateData);

        // Jika barang, stok barang berkurang
        if($barang != ''){
            $data_barang = Barang::where('id', '=', $request->barang)->first();
            $stok_lama = $data_barang->stok;
            $stok_baru = $stok_lama - 1;

            Barang::where('id' ,'=' ,$request->barang)->update([
                'stok' => $stok_baru
            ]);
        }

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
        $data['metode'] = MetodePembayaran::all();

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
            'metode_pembayaran2' => 'nullable',
            'keterangan_tambahan' => 'required',
        ]);

        $foto = $request->file('bukti_pembayaran');
        $img = $request->image;
        $foto2 = $request->file('bukti_pembayaran2');
        $img2 = $request->image2;

        $getImage = PemasukanLainnya::find($id);

        if($foto != ''){
            // Proses Simoan Storage
            Storage::delete('public/data-pemasukkan/'.$getImage->bukti_pembayaran);
            $foto->storeAs('public/data-pemasukkan', $foto->hashName());

            // Set Up Untuk Penyimopnan Image ke GDrive
            $namafile = 'data-pemasukkan/'.$foto->hashName();
            $path = public_path('storage/data-pemasukkan/' . $foto->hashName());

            // Proses Simoan GDrive
            // Gdrive::delete('data-pemasukkan/'.$getImage->bukti_pembayaran);
            // Storage::disk('google')->put($namafile, File::get($path));
            $buktiPembayaran = $foto->hashName();
        } elseif (($img != '') && ($request->takeImage == 'on')) {
            // Proses Image Base64
            $imageData = $this->saveBase64Image($img);
            $file = $imageData['file'];
            $fileName = $imageData['fileName'];
            $image_base64 = $imageData['image_base64'];

            // Proses Simoan Storage
            Storage::delete('public/data-pemasukkan/'.$getImage->bukti_pembayaran);
            Storage::disk('local')->put($file, $image_base64);

            // Set Up Untuk Penyimopnan Image ke GDrive
            $namafile = 'data-pemasukkan/'.$fileName;
            $path = public_path('storage/data-pemasukkan/' . $fileName);

            // Proses Simoan GDrive
            // Gdrive::delete('data-pemasukkan/'.$getImage->bukti_pembayaran);
            // Storage::disk('google')->put($namafile, File::get($path));

            $buktiPembayaran = $fileName;
        }
        
        if($foto2 != ''){
            // Proses Simoan Storage
            Storage::delete('public/data-pemasukkan/'.$getImage->bukti_pembayaran2);
            $foto2->storeAs('public/data-pemasukkan', $foto2->hashName());

            // Set Up Untuk Penyimopnan Image ke GDrive
            $namafile = 'data-pemasukkan/'.$foto2->hashName();
            $path = public_path('storage/data-pemasukkan/' . $foto2->hashName());

            // Proses Simoan GDrive
            // Gdrive::delete('data-pemasukkan/'.$getImage->bukti_pembayaran);
            // Storage::disk('google')->put($namafile, File::get($path));
            $buktiPembayaran2 = $foto2->hashName();
        } elseif (($img2 != '') && ($request->takeImage2 == 'on')) {
            // Proses Image Base64
            $imageData2 = $this->saveBase64Image($img2);
            $file2 = $imageData2['file'];
            $fileName2 = $imageData2['fileName'];
            $image_base64_2 = $imageData2['image_base64'];

            // Proses Simoan Storage
            Storage::delete('public/data-pemasukkan/'.$getImage->bukti_pembayaran2);
            Storage::disk('local')->put($file2, $image_base64_2);

            // Set Up Untuk Penyimopnan Image ke GDrive
            $namafile = 'data-pemasukkan/'.$fileName2;
            $path = public_path('storage/data-pemasukkan/' . $fileName2);

            // Proses Simoan GDrive
            // Gdrive::delete('data-pemasukkan/'.$getImage->bukti_pembayaran);
            // Storage::disk('google')->put($namafile, File::get($path));

            $buktiPembayaran2 = $fileName2;
        }

        $sumber_pemasukkan = !$request->dataCustomer ? $request->sumber_pemasukkan : $request->customer;
        $barang_jasa = $request->barang ? $request->barang : $request->jasa;
        $jumlah_barang = $request->jumlah_barang;

        PemasukanLainnya::where('id', '=', $id)->update([
            'kategori' => $request->keterangan,
            'barang_jasa' => $barang_jasa,
            'jumlah_barang' => $jumlah_barang,
            'modal' => $request->modal,
            'jumlah_pemasukkan' => $request->jumlah_pemasukkan,
            'sumber_pemasukkan' => $sumber_pemasukkan,
            'metode_pembayaran' => $request->metode_pembayaran,
            'bukti_pembayaran' => ($foto || $img ? $buktiPembayaran : $getImage->bukti_pembayaran),
            'metode_pembayaran2' => $request->metode_pembayaran2,
            'bukti_pembayaran2' => ($foto2 || $img2 ? $buktiPembayaran2 : $getImage->bukti_pembayaran2),
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

        if(Storage::exists('public/data-pemasukkan/'. $getImage->bukti_pembayaran2)){
            Storage::delete('public/data-pemasukkan/'. $getImage->bukti_pembayaran2);
        }

        // Gdrive::delete('data-pemasukkan/'.$getImage->bukti_pembayaran);
        // Gdrive::delete('data-pemasukkan/'.$getImage->bukti_pembayaran);
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
