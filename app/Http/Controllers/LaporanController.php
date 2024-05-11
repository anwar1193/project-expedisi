<?php

namespace App\Http\Controllers;

use App\Models\DaftarPengeluaran;
use App\Models\DataPengiriman;
use App\Models\PemasukanLainnya;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function laba_rugi(Request $request)
    {
        $start = $request->start ?? date('Y-m-d');
        $end = $request->end ?? date('Y-m-d');

        $jumlah_pengiriman = DataPengiriman::selectRaw('SUM(ongkir + komisi) AS totalPengiriman')
            ->whereBetween('created_at', [$start, $end])
            ->first();

        $jumlah_pemasukkan = PemasukanLainnya::selectRaw('SUM(harga + komisi) AS totalPemasukan')
            ->whereBetween('created_at', [$start, $end])
            ->first();

        $jumlah_pengeluaran = DaftarPengeluaran::selectRaw('SUM(jumlah_pembayaran) AS totalPengeluaran')->where('jenis_pengeluaran', '=', 1)
            ->whereBetween('created_at', [$start, $end])
            ->first();

        return view('laporan.laba-rugi', compact('jumlah_pengiriman', 'jumlah_pemasukkan', 'jumlah_pengeluaran', 'start', 'end'));
    }

    public function transaksi_harian(Request $request)
    {
        $start = $request->start ?? date('Y-m-d');
        $end = $request->end ?? date('Y-m-d');

        $pengiriman = DataPengiriman::orderBy('id', 'desc')->whereBetween('created_at', [$start, $end])->get();
        $pemasukkan = PemasukanLainnya::orderBy('id', 'desc')->whereBetween('created_at', [$start, $end])->get();
        $pengeluaran = DaftarPengeluaran::orderBy('id', 'desc')->whereBetween('created_at', [$start, $end])->get();

        return view('laporan.transaksi-harian', compact('pengiriman', 'pemasukkan', 'pengeluaran', 'start', 'end'));
    }
}
