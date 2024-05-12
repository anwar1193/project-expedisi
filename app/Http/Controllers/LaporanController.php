<?php

namespace App\Http\Controllers;

use App\Models\DaftarPengeluaran;
use App\Models\DataPengiriman;
use App\Models\PemasukanLainnya;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function laba_rugi(Request $request)
    {
        $start = $request->start ?? date('Y-m-d');
        $end_date = $request->end ?? date('Y-m-d');
        $end = $request->end ?? date('Y-m-d', strtotime('+1 day'));

        if ($request->end == date('Y-m-d')) {
            $end = date('Y-m-d', strtotime('+1 day'));
        }

        $jumlah_pengiriman = DataPengiriman::selectRaw('SUM(ongkir + komisi) AS totalPengiriman')
            ->whereBetween('created_at', [$start, $end])
            ->first();

        $jumlah_pemasukkan = PemasukanLainnya::selectRaw('SUM(harga + komisi) AS totalPemasukan')
            ->whereBetween('created_at', [$start, $end])
            ->first();

        $jumlah_pengeluaran = DaftarPengeluaran::selectRaw('SUM(jumlah_pembayaran) AS totalPengeluaran')->where('jenis_pengeluaran', '=', 1)
            ->whereBetween('created_at', [$start, $end])
            ->first();

        return view('laporan.laba-rugi', compact('jumlah_pengiriman', 'jumlah_pemasukkan', 'jumlah_pengeluaran', 'start', 'end_date'));
    }

    public function laba_rugi_pdf(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");
        $start = $request->start ?? date('Y-m-d');
        $end_date = $request->end ?? date('Y-m-d');
        $end = $request->end ?? date('Y-m-d', strtotime('+1 day'));

        $jumlah_pengiriman = DataPengiriman::selectRaw('SUM(ongkir + komisi) AS totalPengiriman')
            ->whereBetween('created_at', [$start, $end])
            ->first();

        $jumlah_pemasukkan = PemasukanLainnya::selectRaw('SUM(harga + komisi) AS totalPemasukan')
            ->whereBetween('created_at', [$start, $end])
            ->first();

        $jumlah_pengeluaran = DaftarPengeluaran::selectRaw('SUM(jumlah_pembayaran) AS totalPengeluaran')->where('jenis_pengeluaran', '=', 1)
            ->whereBetween('created_at', [$start, $end])
            ->first();

        $waktuCetak = date('d-m-Y H:i:s');

        $pdf = Pdf::loadView('laporan.pdf.laba-rugi', compact('jumlah_pengiriman', 'jumlah_pemasukkan', 'jumlah_pengeluaran', 'start', 'end_date', 'waktuCetak'));
        return $pdf->download('Laporan-Laba-Rugi.pdf');
    }

    public function transaksi_harian(Request $request)
    {
        $start = $request->start ?? date('Y-m-d');
        $end_date = $request->end ?? date('Y-m-d');
        $end = $request->end ?? date('Y-m-d', strtotime('+1 day'));

        if ($request->end == date('Y-m-d')) {
            $end = date('Y-m-d', strtotime('+1 day'));
        }

        $pengiriman = DataPengiriman::orderBy('id', 'desc')->whereBetween('created_at', [$start, $end])->get();
        $pemasukkan = PemasukanLainnya::orderBy('id', 'desc')->whereBetween('created_at', [$start, $end])->get();
        $pengeluaran = DaftarPengeluaran::join('jenis_pengeluarans', 'jenis_pengeluarans.id', '=', 'daftar_pengeluarans.jenis_pengeluaran')->orderBy('daftar_pengeluarans.id', 'desc')->whereBetween('daftar_pengeluarans.created_at', [$start, $end])->get();

        return view('laporan.transaksi-harian', compact('pengiriman', 'pemasukkan', 'pengeluaran', 'start', 'end_date'));
    }

    public function data_pengiriman_pdf(Request $request)
    {
        $start = $request->start ?? date('Y-m-d');
        $end_date = $request->end ?? date('Y-m-d');
        $end = $request->end ?? date('Y-m-d', strtotime('+1 day'));


        $pengiriman = DataPengiriman::orderBy('id', 'desc')->whereBetween('created_at', [$start, $end])->get();

        $waktuCetak = date('d-m-Y H:i:s');

        $pdf = Pdf::loadView('laporan.pdf.table-pengiriman', compact('pengiriman', 'start', 'end_date', 'waktuCetak'))->setPaper('a4', 'landscape');
        return $pdf->download('Laporan-Transaksi-Harian-Pengiriman.pdf');
    }

    public function data_pemasukkan_pdf(Request $request)
    {
        $start = $request->start ?? date('Y-m-d');
        $end_date = $request->end ?? date('Y-m-d');
        $end = $request->end ?? date('Y-m-d', strtotime('+1 day'));

        $pemasukkan = PemasukanLainnya::orderBy('id', 'desc')->whereBetween('created_at', [$start, $end])->get();

        $waktuCetak = date('d-m-Y H:i:s');

        $pdf = Pdf::loadView('laporan.pdf.table-pemasukkan', compact('pemasukkan', 'start', 'end_date', 'waktuCetak'));
        return $pdf->download('Laporan-Transaksi-Harian-Pemasukkan.pdf');
    }

    public function data_pengeluaran_pdf(Request $request)
    {
        $start = $request->start ?? date('Y-m-d');
        $end_date = $request->end ?? date('Y-m-d');
        $end = $request->end ?? date('Y-m-d', strtotime('+1 day'));

        $pengeluaran = DaftarPengeluaran::join('jenis_pengeluarans', 'jenis_pengeluarans.id', '=', 'daftar_pengeluarans.jenis_pengeluaran')->orderBy('daftar_pengeluarans.id', 'desc')->whereBetween('daftar_pengeluarans.created_at', [$start, $end])->get();

        $waktuCetak = date('d-m-Y H:i:s');

        $pdf = Pdf::loadView('laporan.pdf.table-pengeluaran', compact('pengeluaran', 'start', 'end_date', 'waktuCetak'))
            ->setPaper('a4', 'landscape');
        return $pdf->download('Laporan-Transaksi-Harian-Pengeluaran.pdf');
    }
}
