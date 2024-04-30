<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SurveilanceCar;
use Illuminate\Support\Facades\Storage;
use App\Helpers\Helper;
use PDF;
use App\Exports\SurveilanceCarExport;
use Maatwebsite\Excel\Facades\Excel;

class SurveilanceCarController extends Controller
{
    public function index()
    {
       $surveilance_cars = SurveilanceCar::orderBy('id', 'DESC')->get();
       $data['surveilance_cars'] = $surveilance_cars;
       return view('surveilance-car.index', $data);
    }

    public function create(Request $request)
    {
        return isAdmin() ? view('surveilance-car.create') : back()->with('error', 'Anda Tidak Memiliki Akses');   
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'nopol' => 'required',
            'warna' => 'required',
            'merk' => 'required',
            'kapasitas' => 'required',
            'transmisi' => 'required',
            'bahan_bakar' => 'required',
            'status' => 'required',
            'kondisi' => 'required',
            'foto' => 'required',
        ]);

        $foto = $request->file('foto');

        if($foto != ''){
            $foto->storeAs('public/surveilance-car', $foto->hashName());
        }

        $validateData['foto'] = ($foto != '' ? $foto->hashName() : '');

        SurveilanceCar::create($validateData);

        Helper::logActivity('Simpan data surveilance-car dengan nopol : '.$request->nopol);

        return redirect()->route('surveilance-car')->with('success', 'Data Berhasil Disimpan');
    }

    public function delete($id)
    {
        $getImage = SurveilanceCar::find($id);

        if (isAdmin()) {
            if(Storage::exists('public/surveilance-car/'. $getImage->foto)){
                Storage::delete('public/surveilance-car/'. $getImage->foto);
            }
    
            Helper::logActivity('Hapus data surveilance car dengan nopol : '.$getImage->nopol);
    
            SurveilanceCar::where('id', $id)->delete();
    
            return redirect()->route('surveilance-car')->with('delete', 'Data surveilance car berhasil dihapus');
        } else {
            return back()->with('error', 'Anda Tidak Memiliki Akses'); 
        }
    }

    public function edit($id)
    {
        $surveilance_car = SurveilanceCar::find($id);
        $data['surveilance_car'] = $surveilance_car;
        return isAdmin() ? view('surveilance-car.edit', $data) : back()->with('error', 'Anda Tidak Memiliki Akses'); 
    }

    public function update(Request $request)
    {
        $validateData = $request->validate([
            'nopol' => 'required',
            'warna' => 'required',
            'merk' => 'required',
            'kapasitas' => 'required',
            'transmisi' => 'required',
            'bahan_bakar' => 'required',
            'status' => 'required',
            'kondisi' => 'required'
        ]);

        $foto = $request->file('foto');

        $getImage = SurveilanceCar::find($request->id);

        if($foto != ''){
            Storage::delete('public/surveilance-car/', $getImage->foto);
            $foto->storeAs('public/surveilance-car', $foto->hashName());
        }

        $validateData['foto'] = ($foto != '' ? $foto->hashName() : '');

        SurveilanceCar::where('id', '=', $request->id)->update([
            'nopol' => $request->nopol,
            'warna' => $request->warna,
            'merk' => $request->merk,
            'kapasitas' => $request->kapasitas,
            'transmisi' => $request->transmisi,
            'bahan_bakar' => $request->bahan_bakar,
            'status' => $request->status,
            'kondisi' => $request->kondisi,
            'foto' => ($foto != '' ? $foto->hashName() : $request->old_foto)
        ]);

        Helper::logActivity('Update data surveilance-car dengan nopol : '.$request->nopol);

        return redirect()->route('surveilance-car')->with('success', 'Data Berhasil Diupdate');
    }

    public function detail($id)
    {
        $surveilance_car = SurveilanceCar::find($id);
        $data['surveilance_car'] = $surveilance_car;
        return view('surveilance-car.detail', $data);
    }

    public function export_pdf()
    {
        date_default_timezone_set("Asia/Jakarta");
        $surveilance_cars = SurveilanceCar::orderBy('id', 'DESC')->get();
        $waktuCetak = date('d-m-Y H:i:s');

        $data['surveilance_cars'] = $surveilance_cars;
        $data['waktu_cetak'] = $waktuCetak;

        $pdf = PDF::loadView('surveilance-car.pdf', $data);
        return $pdf->download('Surveilance-Car.pdf');
    }

    public function export_excel()
    {
        return Excel::download(new SurveilanceCarExport, 'surveilance_car.xlsx');
    }
}

