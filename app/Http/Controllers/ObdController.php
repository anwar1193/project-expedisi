<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obd;
use Illuminate\Support\Facades\Storage;
use App\Exports\ObdExport;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

use App\Helpers\Helper;

class ObdController extends Controller
{
    public function index()
    {
       $obd = Obd::orderBy('id', 'DESC')->get();
       $data['obd'] = $obd;

       return view('obd.index', $data);
    }

    public function create(Request $request)
    {
        return isAdmin() ? view('obd.create') : back()->with('error', 'Anda Tidak Memiliki Akses'); 
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'merk' => 'required',
            'type' => 'required',
            'serial_number' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            if ($request->hasFile('foto')) { 
                $foto = $request->file('foto');
                $fotoName = $foto->hashName();

                $foto->storeAs('public/obd', $fotoName); 
                $validatedData['foto'] = $fotoName; 
            }

            $obd = new Obd;
            $obd->merk = $request->merk;
            $obd->type = $request->type;
            $obd->serial_number = $request->serial_number;
            $obd->foto = $fotoName;
            $obd->save();

            Helper::logActivity('Simpan data OBD dengan SN : '.$validatedData['serial_number']); 

            return redirect()->route('obd')->with('success', 'Data Berhasil Disimpan'); 
        } catch (\Throwable $th) {
            if (isset($fotoName)) {
                Storage::delete('public/obd/' . $fotoName);
            }

            return back()->with('error', 'Data Gagal Disimpan'); // Redirect back with error message
        }
    }

    public function delete($id)
    {
        $getImage = Obd::find($id);

        if (isAdmin()) {
            if(Storage::exists('public/obd/'. $getImage->foto)){
                Storage::delete('public/obd/'. $getImage->foto);
            }
    
            Obd::where('id', $id)->delete();
    
            Helper::logActivity('Hapus data OBD dengan SN : '.$getImage->serial_number);
    
            return back()->with('delete', 'Data OBD berhasil dihapus');
        } else {
            return back()->with('error', 'Anda Tidak Memiliki Akses'); 
        }
    }

    public function edit($id)
    {
        $obd = Obd::find($id);
        $data['obd'] = $obd;

        return isAdmin() ? view('obd.edit', $data) : back()->with('error', 'Anda Tidak Memiliki Akses'); 
    }

    public function update(Request $request)
    {
        try {
            $validateData = $request->validate([
                'merk' => 'required',
                'type' => 'required',
                'serial_number' => 'required',
                'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);

            $foto = $request->file('foto');

            $getImage = Obd::find($request->id);

            if($foto != ''){
                Storage::delete('public/obd/', $getImage->foto);
                $foto->storeAs('public/obd', $foto->hashName());
            }

            $validateData['foto'] = ($foto != '' ? $foto->hashName() : '');

            Obd::where('id', '=', $request->id)->update([
                'merk' => $request->merk,
                'type' => $request->type,
                'serial_number' => $request->serial_number,
                'foto' => ($foto != '' ? $foto->hashName() : $getImage->foto)
            ]);

            Helper::logActivity('Update data OBD dengan SN : '.$request->serial_number);

            return redirect()->route('obd')->with('success', 'Data Berhasil Diupdate');
        } catch (\Throwable $th) {
            if (isset($fotoName)) {
                Storage::delete('public/obd/' . $fotoName);
            }

            return back()->with('error', 'Data Gagal Diupdate');
        }
    }

    public function detail($id)
    {
        $obd = OBD::find($id);
        $data['obd'] = $obd;
        return view('obd.detail', $data);
    }

    public function export_pdf()
    {
        date_default_timezone_set("Asia/Jakarta");
        $obd = Obd::orderBy('id', 'DESC')->get();
        $waktuCetak = date('d-m-Y H:i:s');

        $data['obd'] = $obd;
        $data['waktu_cetak'] = $waktuCetak;

        $pdf = PDF::loadView('obd.pdf', $data);
        return $pdf->download('obd.pdf');
    }

    public function export_excel()
    {
        return Excel::download(new ObdExport, 'obd.xlsx');
    }
}
