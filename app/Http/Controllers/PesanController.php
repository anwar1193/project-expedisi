<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    public function index()
    {
        $pesan = Pesan::orderBy('id')->get();

        return view('pesan.index', compact('pesan'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $validatedData = $request->validate([
            'kode_pesan' => 'required',
            'judul' => 'required',
            'isi_pesan' => 'required',
        ]);

        $pesan = Pesan::findOrFail($id);

        $pesan->update($request->all());

        return back()->with("success", "Format Pesan Berhasil Di Update");
    }
}
