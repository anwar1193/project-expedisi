<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Helper;
use App\Models\Bank;

class BankController extends Controller
{
    public function index()
    {
        $banks = Bank::orderBy('id', 'DESC')->get();
        return view('bank.index', compact('banks'));
    }

    public function create()
    {
        return view('perlengkapan.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_perlengkapan' => 'required',
            'keterangan' => 'required',
        ]);

        Perlengkapan::create($validatedData);

        Helper::logActivity('success', 'Perlengkapan berhasil ditambahkan');

        return redirect()->route('perlengkapan')->with('success', 'Perlengkapan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $perlengkapan = Perlengkapan::findOrFail($id);
        return view('perlengkapan.edit', compact('perlengkapan'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $validateData = $request->validate([
            'nama_perlengkapan' => 'required',
            'keterangan' => 'required'
        ]);

        $perlengkapan = Perlengkapan::findOrFail($id);

        $perlengkapan->update($request->all());

        Helper::logActivity('success', 'Perlengkapan berhasil diupdate');

        return redirect()->route('perlengkapan')->with('success', 'Perlengkapan berhasil diupdate');
    }

    public function delete($id)
    {
        if(isAdmin()) {
            $perlengkapan = Perlengkapan::findOrFail($id);
            $perlengkapan->delete();

            Helper::logActivity('success', 'Perlengkapan berhasil dihapus');

            return redirect()->route('perlengkapan')->with('success', 'Perlengkapan berhasil dihapus');
        } else {
            return redirect()->route('perlengkapan')->with('error', 'Anda tidak memiliki akses untuk melakukan ini');
        }
    }
}
