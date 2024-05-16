<?php

namespace App\Http\Controllers;

use App\Models\KonversiPoint;
use Illuminate\Http\Request;

class KonversiPointController extends Controller
{
    public function index()
    {
        $konversiPoints = KonversiPoint::orderBy('point', 'desc')->first();

        return view('konversi-point.index', compact('konversiPoints'));
    }

    public function update(Request $request)
    {
        $id = $request->id;

        $konversiPoint = KonversiPoint::findOrFail($id);

        $konversiPoint->update($request->all());

        return redirect()->route('konversi-point')->with('success', 'Data Konversi Point berhasil diupdate');
    }
}
