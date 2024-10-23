<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiDataPemasukanExport;
use App\Exports\TransaksiDataPengeluaranExport;
use App\Exports\TransaksiDataPengirimanExport;
use App\Models\Customer;
use App\Models\DaftarPengeluaran;
use App\Models\DataPengiriman;
use App\Models\MetodePembayaran;
use App\Models\PemasukanLainnya;
use App\Models\StatusPengiriman;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class LaporanController extends Controller
{
    public function laba_rugi(Request $request)
    {
        $filter = $request->filter;
        $periode = $request->periode;
        if ($filter == 'range') {
            $periode = null;
        } 
        $start = $periode ?? $request->start ?? date('Y-m-d');
        $end_date = $request->end ?? date('Y-m-d');
        $end = $request->end ?? date('Y-m-d', strtotime('+1 day'));

        if ($request->end == date('Y-m-d')) {
            $end = date('Y-m-d', strtotime('+1 day'));
        }

        $omset_pengiriman = DataPengiriman::selectRaw('SUM(ongkir) AS omsetPengiriman')
            // ->where('status_pembayaran', 1)
            ->whereBetween('tgl_transaksi', [$start, $end])
            ->first();

        $jumlah_pengiriman = DataPengiriman::selectRaw('SUM(komisi) AS komisiPengiriman')
            // ->where('status_pembayaran', 1)
            ->whereBetween('tgl_transaksi', [$start, $end])
            ->first();

        $jumlah_pemasukkan = PemasukanLainnya::selectRaw('SUM(jumlah_pemasukkan) AS totalPemasukan')
            ->whereBetween('tgl_pemasukkan', [$start, $end])
            ->first();

        $jumlah_pengeluaran = DaftarPengeluaran::selectRaw('SUM(jumlah_pembayaran) AS totalPengeluaran')
            ->where('jenis_pengeluaran', '=', 1)
            ->where('status_pengeluaran', '=', 1)
            ->whereBetween('created_at', [$start, $end])
            ->first();

        return view('laporan.laba-rugi', compact('omset_pengiriman', 'jumlah_pengiriman', 'jumlah_pemasukkan', 'jumlah_pengeluaran', 'start', 'end_date', 'periode', 'filter'));
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
        $filter = $request->filter;
        $periode = $request->periode;
        if ($filter == 'range') {
            $periode = null;
        } 
        $start = $periode ?? $request->start ?? date('Y-m-d');
        $end_date = $request->end ?? date('Y-m-d');
        $end = $request->end ?? date('Y-m-d', strtotime('+1 day'));
        $periode = $request->periode ?? null;

        if ($request->end == date('Y-m-d')) {
            $end = date('Y-m-d', strtotime('+1 day'));
        }

        $pengiriman = DataPengiriman::select('data_pengirimen.*', 'customers.nama')
            ->leftjoin('customers', 'customers.kode_customer', '=', 'data_pengirimen.kode_customer')
            ->whereBetween('data_pengirimen.tgl_transaksi', [$start, $end])
            ->orderBy('id', 'desc')
            ->get();

        $pemasukkan = PemasukanLainnya::orderBy('id', 'desc')
            ->whereBetween('tgl_pemasukkan', [$start, $end])
            ->get();

        $pengeluaran = DaftarPengeluaran::join('jenis_pengeluarans', 'jenis_pengeluarans.id', '=', 'daftar_pengeluarans.jenis_pengeluaran')
            ->orderBy('daftar_pengeluarans.id', 'desc')
            ->whereBetween('daftar_pengeluarans.tgl_pengeluaran', [$start, $end])
            ->get();

        $customer = Customer::all();
        $statusPengiriman = StatusPengiriman::all();
        $metodePembayaran = MetodePembayaran::all();
        $statusPembayaran = [
            ['id' => 1, 'name' => 'Lunas'],
            ['id' => 2, 'name' => 'Pending'],
            ['id' => 3, 'name' => 'Lunas Sebagian'],
        ];

        return view('laporan.transaksi-harian', compact('pengiriman', 'pemasukkan', 'pengeluaran', 'start', 'end_date', 'periode', 'filter', 'customer', 'statusPengiriman', 'metodePembayaran', 'statusPembayaran'));
    }

    public function data_pengiriman(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");
        if (request('format') === 'pdf') {
            $start = $request->start ?? date('Y-m-d');
            $end_date = $request->end ?? date('Y-m-d');
            $end = $request->end ?? date('Y-m-d', strtotime('+1 day'));

            $pengiriman = DataPengiriman::leftjoin('customers', 'customers.kode_customer', '=', 'data_pengirimen.kode_customer')
                        ->select('data_pengirimen.*', 'customers.nama')
                        ->orderBy('id', 'desc')->whereBetween('tgl_transaksi', [$start, $end])->get();

            $waktuCetak = date('d-m-Y H:i:s');

            $pdf = Pdf::loadView('laporan.pdf.table-pengiriman', compact('pengiriman', 'start', 'end_date', 'waktuCetak'))->setPaper('a4', 'landscape');
            return $pdf->stream('Laporan-Transaksi-Harian-Pengiriman.pdf');
        } elseif (request('format') === 'excel') {
            return Excel::download(new TransaksiDataPengirimanExport, 'Transaksi-Harian-Pengiriman.xlsx');
        }
    }

    public function data_pemasukan(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");
        if (request('format') === 'pdf') {
            $start = $request->start ?? date('Y-m-d');
            $end_date = $request->end ?? date('Y-m-d');
            $end = $request->end ?? date('Y-m-d', strtotime('+1 day'));

            $pemasukkan = PemasukanLainnya::orderBy('id', 'desc')->whereBetween('tgl_pemasukkan', [$start, $end])->get();

            $waktuCetak = date('d-m-Y H:i:s');

            $pdf = Pdf::loadView('laporan.pdf.table-pemasukkan', compact('pemasukkan', 'start', 'end_date', 'waktuCetak'));
            return $pdf->stream('Laporan-Transaksi-Harian-Pemasukkan.pdf');
        } elseif (request('format') === 'excel') {
            return Excel::download(new TransaksiDataPemasukanExport, 'Transaksi-Harian-Pemasukan.xlsx');
        }
    }

    public function data_pengeluaran(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");
        if (request('format') === 'pdf') {
            $start = $request->start ?? date('Y-m-d');
            $end_date = $request->end ?? date('Y-m-d');
            $end = $request->end ?? date('Y-m-d', strtotime('+1 day'));

            $pengeluaran = DaftarPengeluaran::select('daftar_pengeluarans.*', 'jenis_pengeluarans.jenis_pengeluaran AS kategori')
                            ->join('jenis_pengeluarans', 'jenis_pengeluarans.id', '=', 'daftar_pengeluarans.jenis_pengeluaran')
                            ->orderBy('daftar_pengeluarans.id', 'desc')
                            ->whereBetween('daftar_pengeluarans.tgl_pengeluaran', [$start, $end])
                            ->get();

            $waktuCetak = date('d-m-Y H:i:s');

            $pdf = Pdf::loadView('laporan.pdf.table-pengeluaran', compact('pengeluaran', 'start', 'end_date', 'waktuCetak'))
                ->setPaper('a4', 'landscape');
            return $pdf->stream('Laporan-Transaksi-Harian-Pengeluaran.pdf');
        } elseif (request('format') === 'excel') {
            return Excel::download(new TransaksiDataPengeluaranExport, 'Transaksi-Harian-Pengeluaran.xlsx');
        }
    }
}
