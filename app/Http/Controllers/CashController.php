<?php

namespace App\Http\Controllers;

use App\Models\PemasukanCash;
use App\Models\PengeluaranCash;
use Illuminate\Http\Request;

class CashController extends Controller
{
    public function index() 
    {
        $data['pemasukan'] = PemasukanCash::selectRaw('SUM(jumlah) AS total')->first();
        $data['pengeluaran'] = PengeluaranCash::selectRaw('SUM(jumlah) AS total')->first();
        $data['saldo'] = round($data['pemasukan']->total - $data['pengeluaran']->total);

        return view('posisi-cash.index', $data);
    }

    public function pemasukan_cash(Request $request)
    {
        $this->validate($request, [
            'jumlah' => 'required|numeric',
            'tanggal' => 'required'
        ]);

        PemasukanCash::create([
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('posisi-cash')->with('success', 'Pemasukan cash berhasil ditambahkan');
    }
    
    public function pengeluaran_cash(Request $request)
    {
        $this->validate($request, [
            'jumlah' => 'required|numeric',
            'tanggal' => 'required'
        ]);

        PengeluaranCash::create([
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('posisi-cash')->with('success', 'Pemasukan cash berhasil ditambahkan');
    }
}
