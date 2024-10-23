<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\DaftarPengeluaran;
use App\Models\DataPengiriman;
use App\Models\PemasukanCash;
use App\Models\PemasukanLainnya;
use App\Models\PengeluaranCash;
use App\Models\SaldoCash;
use App\Models\SettingWa;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;
use Google\Service\AdExchangeBuyerII\Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\URL;

class CashController extends Controller
{
    protected $yesterday;
    protected $lastSaldo;
    protected $saldoApproveYet;
    protected $tunai;

    public function __construct()
    {
        $this->yesterday = date('Y-m-d', strtotime('-1 day'));
        $this->lastSaldo = SaldoCash::orderBy('id', 'DESC')->first();
        $this->saldoApproveYet = SaldoCash::where('is_approve', SaldoCash::STATUS_PENDING)->orderBy('id', 'DESC')->first();
        $this->tunai = "tunai";
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
        date_default_timezone_set("Asia/Jakarta");
        $data['tanggal'] = date('Y-m-d');
        $startDate = new DateTime($this->lastSaldo->created_at);
        $startDate = $startDate->format('Y-m-d H:i:s');
        $startDateTime = new DateTime($this->lastSaldo->created_at);
        $startDateTime = $startDateTime->format('Y-m-d');
        $endDate = date('Y-m-d H:i:s');

        $totalPengiriman = DataPengiriman::selectRaw('SUM(ongkir) AS total')
                            ->whereBetween('tgl_transaksi', [$startDate, $endDate])
                            ->where(function($query) {
                                $query->where('metode_pembayaran', 'LIKE', 'tunai')
                                      ->orWhere('metode_pembayaran_2', 'LIKE', 'tunai');
                            })
                            ->first();

        $totalPemasukan = PemasukanLainnya::selectRaw('SUM(jumlah_pemasukkan) AS total')
                            ->whereBetween('tgl_pemasukkan', [$startDateTime, $data['tanggal']])
                            ->where(function($query) {
                                $query->where('metode_pembayaran', 'LIKE', 'tunai')
                                    ->orWhere('metode_pembayaran2', 'LIKE', 'tunai');
                            })
                            ->first();

        $data['pemasukan'] = $totalPengiriman->total + $totalPemasukan->total;

        $data['pengeluaran'] = DaftarPengeluaran::selectRaw('SUM(jumlah_pembayaran) AS total')
                            ->whereBetween('tgl_pengeluaran', [$startDateTime, $data['tanggal']])
                            ->where('metode_pembayaran', 'LIKE', PemasukanLainnya::TUNAI)
                            ->first();        

        $data['saldo'] = round($data['pemasukan'] - $data['pengeluaran']->total);

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
        $url = SettingWa::select('url_message AS url')->latest()->first();
        $no_hp = Helper::dataOwner()->nomor_telepon;
        $message = 'Terdapat Closing Saldo Baru Yang Membutuhkan Approval. Silahkan Klik Link Berikut Untuk Approve : ' . URL::to('/').'/owner/approve-saldo/'.($saldo->id).'?link=owner';

        $dataSending = sendWaText($no_hp, $message);
        
        if ($request->tanggal != $today) {
            return back()->with('error', 'Tanggal Closing Saldo Harus Sama Dengan Tanggal Hari ini');
        }

        if ($this->saldoApproveYet) {
            return back()->with('error', 'Jumlah Saldo Sudah Diclosing Dan Sedang Menunggu Approval Owner');
        }

        SaldoCash::create([
            'saldo' => $inputSaldo,
            'tanggal' => $today
        ]);

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post($url->url, $dataSending);

        return redirect()->route('posisi-cash')->with('success', 'Saldo cash berhasil ditambahkan');
    }

    public function approve($id)
    {
        $link = request('link');
        $saldo = SaldoCash::find($id);

        if($link && $saldo->is_approve == SaldoCash::STATUS_APPROVE){
            return redirect()->route('error-page1')->with('error', 'Closingan Saldo Cash Telah Di Approve');
        } 

        if($link && !$saldo) {
            return redirect()->route('error-page1')->with('error', 'Data Tidak Ditemukan');
        }
        
        SaldoCash::find($id)->update([
            'is_approve' => SaldoCash::STATUS_APPROVE
        ]);

        if($link) return redirect()->route('approved');

        return back()->with('success', 'Closingan Saldo Cash Telah Di Approve');
    }

    public function approveSelected(Request $request)
    {
        $id_pengeluaran = $request->id_pengeluaran;

        if($id_pengeluaran == NULL){
            return back()->with('error', 'Belum Ada Data Dipilih');
        }

        for($i=0; $i<sizeof($id_pengeluaran); $i++){
            PengeluaranCash::find($id_pengeluaran[$i])->update([
                'is_approve' => SaldoCash::STATUS_APPROVE
            ]);
        }

        return back()->with('success', 'Closingan Saldo Cash Telah Di Approve');
    }

    public function data_saldo_cash()
    {
        $data['saldo'] = SaldoCash::where('is_approve', false)->orderBy('id', 'DESC')->get();

        return view('posisi-cash.pengeluaran-cash', $data);
    }
    
    public function history_pengeluaran()
    {
        $startDate = new DateTime(rangeDate()[0]);
        $startDate = $startDate->format('Y-m-d');
        $endDate = new DateTime(rangeDate()[1]);
        $endDate = $endDate->format('Y-m-d');
        $data['pengeluaran'] = DaftarPengeluaran::where('metode_pembayaran', $this->tunai)
                            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                                return $query->whereBetween('tgl_pengeluaran', [$startDate, $endDate])
                                             ->orderBy('id', 'DESC');
                            })
                            ->orderBy('id', 'DESC')->get();

        return view('posisi-cash.history-pengeluaran', $data);
    }

    public function history_pemasukan()
    {
        $startDate = new DateTime(rangeDate()[0]);
        $startDate = $startDate->format('Y-m-d 00:00:00');
        $endDate = new DateTime(rangeDate()[1]);
        $endDate = $endDate->format('Y-m-d 23:59:59');

        $pemasukan = PemasukanLainnya::whereBetween('tgl_pemasukkan', [$startDate, $endDate])
                    ->where(function($query) {
                        $query->where('metode_pembayaran', 'LIKE', $this->tunai)
                            ->orWhere('metode_pembayaran2', 'LIKE', $this->tunai);
                    })
                    ->orderBy('id', 'DESC')
                    ->get();

        $pengiriman = DataPengiriman::whereBetween('tgl_transaksi', [$startDate, $endDate])
                        ->where(function($query) {
                            $query->where('metode_pembayaran', 'LIKE', $this->tunai)
                                ->orWhere('metode_pembayaran_2', 'LIKE', $this->tunai);
                        })
                        ->orderBy('id', 'DESC')->get()
                        ->map(function ($resi) {
                            $resi->tgl_transaksi = new DateTime($resi->tgl_transaksi);
                            $resi->tgl_transaksi = $resi->tgl_transaksi->format('Y-m-d');
                            return $resi;
                        });

        $data['transaksi'] = $pemasukan->merge($pengiriman)->sortByDesc('id');

        return view('posisi-cash.history-pemasukan', $data);
    }

    public function history_saldo()
    {
        $startDate = new DateTime(rangeDate()[0]);
        $startDate = $startDate->format('Y-m-d');
        $endDate = new DateTime(rangeDate()[1]);
        $endDate = $endDate->format('Y-m-d');
        $data['saldo'] = SaldoCash::whereBetween('tanggal', [$startDate, $endDate])->orderBy('id', 'DESC')->get();

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
