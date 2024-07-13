<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\MetodePembayaran;

class MetodePembayaranController extends Controller
{
    public function index()
    {
        $metode_pembayaran = MetodePembayaran::orderBy('id', 'DESC')->get();
        return view('metode_pembayaran.index', compact('metode_pembayaran'));
    }

    public function create()
    {
        return view('metode_pembayaran.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'metode' => 'required',
        ]);

        $validatedData['keterangan'] = $request->keterangan;

        MetodePembayaran::create($validatedData);

        Helper::logActivity('success', 'Metode Pembayaran berhasil ditambahkan');

        return redirect()->route('metode_pembayaran')->with('success', 'Metode Pembayaran berhasil ditambahkan');
    }

    public function edit($id)
    {
        $metode_pembayaran = MetodePembayaran::findOrFail($id);
        return view('metode_pembayaran.edit', compact('metode_pembayaran'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $validatedData = $request->validate([
            'metode' => 'required',
        ]);

        $validatedData['keterangan'] = $request->keterangan;

        $metode_pembayaran = MetodePembayaran::findOrFail($id);

        $metode_pembayaran->update($request->all());

        Helper::logActivity('success', 'Metode Pembayaran berhasil diupdate');

        return redirect()->route('metode_pembayaran')->with('success', 'Metode Pembayaran Berhasil Diupdate');
    }

    public function delete($id)
    {
        if(isAdmin()) {
            $metode_pembayaran = MetodePembayaran::findOrFail($id);
            $metode_pembayaran->delete();

            Helper::logActivity('success', 'Metode pembayaran berhasil dihapus');

            return redirect()->route('metode_pembayaran')->with('success', 'Metode pembayaran berhasil dihapus');
        } else {
            return redirect()->route('metode_pembayaran')->with('error', 'Anda tidak memiliki akses untuk melakukan ini');
        }
    }
}
