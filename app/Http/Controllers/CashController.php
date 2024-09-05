<?php

namespace App\Http\Controllers;

use App\Models\DaftarPengeluaran;
use App\Models\PemasukanCash;
use App\Models\PemasukanLainnya;
use App\Models\PengeluaranCash;
use App\Models\SaldoCash;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class CashController extends Controller
{
    protected $yesterday;
    protected $lastSaldo;

    public function __construct()
    {
        $this->yesterday = date('Y-m-d', strtotime('-1 day'));
        $this->lastSaldo = SaldoCash::where('is_approve', SaldoCash::STATUS_PENDING)->orderBy('id', 'DESC')->first();
    }

    private function checkSaldoYesterday() 
    {
        $pemasukan = PemasukanLainnya::where('tgl_pemasukkan', $this->yesterday)
                            ->where('metode_pembayaran', 'LIKE', PemasukanLainnya::TUNAI)
                            ->orWhere('metode_pembayaran2', 'LIKE', PemasukanLainnya::TUNAI)
                            ->sum('jumlah_pemasukkan');

        $pengeluaran = DaftarPengeluaran::where('tgl_pengeluaran', $this->yesterday)
                            ->where('metode_pembayaran', 'LIKE', PemasukanLainnya::TUNAI)
                            ->sum('jumlah_pembayaran');

        $saldo = round($pemasukan - $pengeluaran);

        return $saldo;
    }

    public function index() 
    {
        $data['tanggal'] = request('tanggal') ?? date('Y-m-d');
        $data['pemasukan'] = PemasukanLainnya::selectRaw('SUM(jumlah_pemasukkan) AS total')
                            ->where('tgl_pemasukkan', $data['tanggal'])
                            ->where('metode_pembayaran', 'LIKE', PemasukanLainnya::TUNAI)
                            ->orWhere('metode_pembayaran2', 'LIKE', PemasukanLainnya::TUNAI)
                            ->first();

        $data['pengeluaran'] = DaftarPengeluaran::selectRaw('SUM(jumlah_pembayaran) AS total')
                            ->where('tgl_pengeluaran', $data['tanggal'])
                            ->where('metode_pembayaran', 'LIKE', PemasukanLainnya::TUNAI)
                            ->first();
        
        $todaySaldo = SaldoCash::where('tanggal', $data['tanggal'])->orderBy('id', 'DESC')->first();
        $yesterdaySaldo = SaldoCash::where('tanggal', $this->yesterday)->orderBy('id', 'DESC')->first();
        
        if ($this->lastSaldo) {
            $data['saldo'] = $this->lastSaldo->saldo;
        } elseif (!$yesterdaySaldo) {
            $data['saldo'] = ($this->checkSaldoYesterday() + $data['pemasukan']->total - $data['pengeluaran']->total);
        } elseif ($todaySaldo) {
            $data['saldo'] = $todaySaldo->saldo;
        } else {
            $data['saldo'] = round($data['pemasukan']->total - $data['pengeluaran']->total);
        }

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

        if ($this->lastSaldo) {
            return back()->with('error', 'Jumlah Saldo Sudah Diclosing Dan Sedang Menunggu Approval Owner');
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
