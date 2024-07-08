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
        return view('bank.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'bank' => 'required',
            'nomor_rekening' => 'required',
            'atas_nama' => 'required',
            'cabang' => 'required',
        ]);

        Bank::create($validatedData);

        Helper::logActivity('success', 'Bank berhasil ditambahkan');

        return redirect()->route('bank')->with('success', 'Bank berhasil ditambahkan');
    }

    public function edit($id)
    {
        $bank = Bank::findOrFail($id);
        return view('bank.edit', compact('bank'));
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $validatedData = $request->validate([
            'bank' => 'required',
            'nomor_rekening' => 'required',
            'atas_nama' => 'required',
            'cabang' => 'required',
        ]);

        $bank = Bank::findOrFail($id);

        $bank->update($request->all());

        Helper::logActivity('success', 'Bank berhasil diupdate');

        return redirect()->route('bank')->with('success', 'Bank berhasil diupdate');
    }

    public function delete($id)
    {
        if(isAdmin()) {
            $bank = Bank::findOrFail($id);
            $bank->delete();

            Helper::logActivity('success', 'Bank berhasil dihapus');

            return redirect()->route('bank')->with('success', 'Bank berhasil dihapus');
        } else {
            return redirect()->route('bank')->with('error', 'Anda tidak memiliki akses untuk melakukan ini');
        }
    }
}
