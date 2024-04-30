<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisPerangkat;
use App\Models\Perangkat;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Helper;
use PDF;
use App\Exports\PerangkatExport;
use Maatwebsite\Excel\Facades\Excel;

class PerangkatController extends Controller
{
    public function index()
    {
        // $perangkats = Perangkat::orderBy('id', 'DESC')->get();
        $perangkats = Perangkat::select('perangkats.*', 'jenis_perangkats.jenis AS nama_jenis')
                ->join('jenis_perangkats', 'jenis_perangkats.kode_jenis', '=', 'perangkats.jenis_perangkat')
                ->orderBy('perangkats.id', 'DESC')
                ->get();
        $data['perangkats'] = $perangkats;
        return view('perangkat.index', $data);
    }

    public function create()
    {
        $jenis_perangkat = JenisPerangkat::orderBy('id')->get();
        $data['jenis_perangkat'] = $jenis_perangkat;
        return isAdmin() ? view('perangkat.create', $data) : back()->with('error', 'Anda Tidak Memiliki Akses');  
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'kode_perangkat' => 'required',
            'nama_perangkat' => 'required',
            'jenis_perangkat' => 'required',
            'serial_number' => 'required',
            'kondisi_perangkat' => 'required',
            'foto' => 'required',
        ]);

        $foto = $request->file('foto');

        if($foto != ''){
            $foto->storeAs('public/perangkat', $foto->hashName());
        }

        $validateData['foto'] = ($foto != '' ? $foto->hashName() : '');

        Perangkat::create($validateData);

        Helper::logActivity('Simpan data perangkat dengan kode : '.$request->kode_perangkat);

        return redirect()->route('perangkat')->with('success', 'Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $jenis_perangkat = JenisPerangkat::orderBy('id')->get();
        $perangkat = Perangkat::find($id);

        $data['jenis_perangkat'] = $jenis_perangkat;
        $data['perangkat'] = $perangkat;

        return isAdmin() ? view('perangkat.edit', $data) : back()->with('error', 'Anda Tidak Memiliki Akses');  
    }

    public function update(Request $request)
    {
        $validateData = $request->validate([
            'kode_perangkat' => 'required',
            'nama_perangkat' => 'required',
            'jenis_perangkat' => 'required',
            'serial_number' => 'required',
            'kondisi_perangkat' => 'required',
        ]);

        $foto = $request->file('foto');

        $getImage = Perangkat::find($request->id);

        if($foto != ''){
            Storage::delete('public/perangkat/', $getImage->foto);
            $foto->storeAs('public/perangkat', $foto->hashName());
        }

        $validateData['foto'] = ($foto != '' ? $foto->hashName() : '');

        Perangkat::where('id', '=', $request->id)->update([
            'kode_perangkat' => $request->kode_perangkat,
            'nama_perangkat' => $request->nama_perangkat,
            'jenis_perangkat' => $request->jenis_perangkat,
            'serial_number' => $request->serial_number,
            'kondisi_perangkat' => $request->kondisi_perangkat,
            'foto' => ($foto != '' ? $foto->hashName() : $request->old_foto)
        ]);

        Helper::logActivity('Update data perangkat dengan kode : '.$request->kode_perangkat);

        return redirect()->route('perangkat')->with('success', 'Data Berhasil Diupdate');
    }

    public function delete($id)
    {
        $getImage = Perangkat::find($id);

        if (isAdmin()) {
            if(Storage::exists('public/perangkat/'. $getImage->foto)){
                Storage::delete('public/perangkat/'. $getImage->foto);
            }
    
            Helper::logActivity('Hapus data perangkat dengan kode : '.$getImage->kode_perangkat);
    
            Perangkat::where('id', $id)->delete();
    
            return redirect()->route('perangkat')->with('delete', 'Data perangkat berhasil dihapus');
        } else {
            return back()->with('error', 'Anda Tidak Memiliki Akses');  
        }
    }

    public function detail($id)
    {
        // $perangkat = Perangkat::find($id);
        $perangkat = Perangkat::select('perangkats.*', 'jenis_perangkats.jenis AS nama_jenis')
                ->join('jenis_perangkats', 'jenis_perangkats.kode_jenis', '=', 'perangkats.jenis_perangkat')
                ->where('perangkats.id', '=', $id)
                ->orderBy('perangkats.id', 'DESC')
                ->first();
        $data['perangkat'] = $perangkat;

        return view('perangkat.detail', $data);
    }

    public function export_pdf()
    {
        date_default_timezone_set("Asia/Jakarta");
        $perangkats = Perangkat::select('perangkats.*', 'jenis_perangkats.jenis AS nama_jenis')
                    ->join('jenis_perangkats', 'jenis_perangkats.kode_jenis', '=', 'perangkats.jenis_perangkat')
                    ->orderBy('perangkats.id', 'DESC')
                    ->get();

        $waktuCetak = date('d-m-Y H:i:s');

        $data['perangkats'] = $perangkats;
        $data['waktu_cetak'] = $waktuCetak;

        $pdf = PDF::loadView('perangkat.pdf', $data);
        return $pdf->download('DataPerangkat.pdf');
    }

    public function export_excel()
    {
        return Excel::download(new PerangkatExport, 'perangkat.xlsx');
    }

}
