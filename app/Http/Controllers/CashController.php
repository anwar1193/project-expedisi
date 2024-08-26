<?php

namespace App\Http\Controllers;

use App\Models\PemasukanCash;
use App\Models\PengeluaranCash;
use App\Models\SaldoCash;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CashController extends Controller
{
    public function index() 
    {
        $data['tanggal'] = request('tanggal') ?? date('Y-m-d');
        $data['pemasukan'] = PemasukanCash::selectRaw('SUM(jumlah) AS total')
                            ->where('tanggal', $data['tanggal'])
                            ->first();
        $data['pengeluaran'] = PengeluaranCash::selectRaw('SUM(jumlah) AS total')
                            ->where('tanggal', $data['tanggal'])
                            ->first();

        $data['saldoToday'] = SaldoCash::where('tanggal', $data['tanggal'])
                                ->first();
        $data['saldo'] = round($data['pemasukan']->total - $data['pengeluaran']->total);

        return view('posisi-cash.index', $data);
    }

    public function truncate()
    {
        PemasukanCash::truncate();
        PengeluaranCash::truncate();
        SaldoCash::truncate();
        return back()->with('success', 'Truncate Success');
    }

    public function pemasukan_cash(Request $request)
    {
        $this->validate($request, [
            'jumlah' => 'required|numeric',
            'tanggal' => 'required'
        ]);

        $saldo_hari_ini = SaldoCash::where('tanggal', $request->tanggal);

        if($saldo_hari_ini->count() > 0){
            $saldo_lama = $saldo_hari_ini->first()->saldo;
            SaldoCash::where('tanggal', $request->tanggal)->update([
                'saldo' => $saldo_lama + $request->jumlah
            ]);
        }else{
            SaldoCash::create([
                'saldo' => $request->jumlah,
                'tanggal' => $request->tanggal
            ]);
        }

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

        $saldo_hari_ini = SaldoCash::where('tanggal', $request->tanggal);

        if($saldo_hari_ini->count() > 0){
            $saldo_lama = $saldo_hari_ini->first()->saldo;
            SaldoCash::where('tanggal', $request->tanggal)->update([
                'saldo' => $saldo_lama - $request->jumlah
            ]);
        }else{
            return redirect()->route('posisi-cash')->with('error', 'Saldo hari ini belum Ter-Generate');
        }

        PengeluaranCash::create([
            'jumlah' => $request->jumlah,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('posisi-cash')->with('success', 'Pengeluaran cash berhasil ditambahkan');
    }

    public function closing_cash(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");

        $request->validate([
            'saldo' => 'required|numeric'
        ]);

        $today = date('Y-m-d');
        $inputSaldo = $request->saldo;
        $saldo = SaldoCash::orderBy('id', 'DESC')->first();
        
        if ($request->tanggal != $today) {
            return back()->with('error', 'Tanggal Closing Saldo Harus Sama Dengan Tanggal Hari ini');
        }

        if (($saldo && $saldo->tanggal == $today)) {
            $saldo->saldo = $inputSaldo;
            $saldo->save();

            return redirect()->route('posisi-cash')->with('success', 'Saldo cash berhasil ditutup');
        } else {
            SaldoCash::create([
                'saldo' => $inputSaldo,
                'tanggal' => $today
            ]);

            return redirect()->route('posisi-cash')->with('success', 'Saldo cash berhasil ditambahkan');
        }
    }

    public function approve($id)
    {
        PengeluaranCash::find($id)->update([
            'status' => 1
        ]);

        return back()->with('success', 'Pengeluaran Cash Telah Di Approve');
    }

    public function approveSelected(Request $request)
    {
        $id_pengeluaran = $request->id_pengeluaran;

        if($id_pengeluaran == NULL){
            return back()->with('error', 'Belum Ada Data Dipilih');
        }

        for($i=0; $i<sizeof($id_pengeluaran); $i++){
            PengeluaranCash::find($id_pengeluaran[$i])->update([
                'status' => 1
            ]);
        }

        return back()->with('success', 'Pengeluaran Cash Telah Di Approve');
    }

    public function data_pengeluaran_cash()
    {
        $data['pengeluaran'] = PengeluaranCash::where('status', false)->orderBy('id', 'DESC')->get();

        return view('posisi-cash.pengeluaran-cash', $data);
    }
    
    public function history_pengeluaran()
    {
        $data['pengeluaran'] = PengeluaranCash::orderBy('id', 'DESC')->get();

        return view('posisi-cash.history-pengeluaran', $data);
    }

    public function history_pemasukan()
    {
        $data['pemasukan'] = PemasukanCash::orderBy('id', 'DESC')->get();

        return view('posisi-cash.history-pemasukan', $data);
    }

    public function history_saldo()
    {
        $data['saldo'] = SaldoCash::orderBy('id', 'DESC')->get();

        return view('posisi-cash.history-saldo', $data);
    }

    public function export_pengeluaran()
    {
        $data['pengeluaran'] = PengeluaranCash::orderBy('id', 'DESC')->get();;

        $pdf = Pdf::loadView('posisi-cash.export.history-pengeluaran-pdf', $data);
        return $pdf->download('History-Pengeluaran-Cash.pdf');
    }
    
    public function export_pemasukan()
    {
        $data['pemasukan'] = PemasukanCash::orderBy('id', 'DESC')->get();;

        $pdf = Pdf::loadView('posisi-cash.export.history-pemasukan-pdf', $data);
        return $pdf->download('History-Pemasukan-Cash.pdf');
    }
    
    public function export_saldo()
    {
        $data['saldo'] = SaldoCash::orderBy('id', 'DESC')->get();;

        $pdf = Pdf::loadView('posisi-cash.export.history-saldo-pdf', $data);
        return $pdf->download('History-Saldo-Cash.pdf');
    }
}
