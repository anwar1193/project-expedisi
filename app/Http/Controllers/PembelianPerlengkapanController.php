<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\PembelianPerlengkapan;
use App\Models\Perlengkapan;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PembelianPerlengkapanController extends Controller
{
    public function index()
    {
        $datas = PembelianPerlengkapan::leftjoin('perlengkapans', 'pembelian_perlengkapans.id_perlengkapan', '=', 'perlengkapans.id')
            ->leftjoin('suppliers', 'pembelian_perlengkapans.id_supplier', '=', 'suppliers.id')
            ->select(
                'pembelian_perlengkapans.id', 
                'pembelian_perlengkapans.tanggal_pembelian', 
                'perlengkapans.nama_perlengkapan', 
                'suppliers.nama_supplier', 
                'pembelian_perlengkapans.harga', 
                'pembelian_perlengkapans.jumlah', 
                'pembelian_perlengkapans.keterangan', 
                'pembelian_perlengkapans.nota')
            ->orderBy('pembelian_perlengkapans.id', 'DESC')->get();
        return view('pembelian-perlengkapan.index', compact('datas'));
    }

    public function create()
    {
        $perlengkapans = Perlengkapan::orderBy('id', 'DESC')->get();
        $suppliers = Supplier::orderBy('id', 'DESC')->get();

        if ($perlengkapans->count() == 0) {
            return redirect()->route('perlengkapan.create')->with('error', 'Silahkan tambahkan perlengkapan terlebih dahulu');
        }

        if ($suppliers->count() == 0) {
            return redirect()->route('supplier.create')->with('error', 'Silahkan tambahkan supplier terlebih dahulu');
        }

        return view('pembelian-perlengkapan.create', compact('perlengkapans', 'suppliers'));
    }

    public function store(Request $request)
    {
        $validateData = $request->validate([
            'id_perlengkapan' => 'required',
            'id_supplier' => 'required',
            'harga' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'max:255',
        ]);

        $validateData['tanggal_pembelian'] = date('Y-m-d');
        $validateData['nota'] = $request->nota ?? NULL;
        PembelianPerlengkapan::create($validateData);

        Helper::logActivity('Pembelian Perlengkapan', 'Ditambahkan');

        return redirect()->route('pembelian-perlengkapan')->with('success', 'Pembelian Perlengkapan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pembelian = PembelianPerlengkapan::findOrFail($id);
        $explode = explode("/", $pembelian->nota);
        $bukti_pembayaran_view = 'https://'.$explode[2].'/thumbnail?id='.$explode[5];
        $pembelian->view_nota = $bukti_pembayaran_view;
        $perlengkapans = Perlengkapan::orderBy('id', 'DESC')->get();
        $suppliers = Supplier::orderBy('id', 'DESC')->get();

        return view('pembelian-perlengkapan.edit', compact('pembelian', 'perlengkapans', 'suppliers'));
    }

    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'id_perlengkapan' => 'required',
            'id_supplier' => 'required',
            'harga' => 'required',
            'jumlah' => 'required',
            'keterangan' => 'max:255',
        ]);

        $pembelian = PembelianPerlengkapan::findOrFail($id);
        $pembelian->update($request->all());

        Helper::logActivity('Pembelian Perlengkapan', 'Diubah');

        return redirect()->route('pembelian-perlengkapan')->with('success', 'Pembelian Perlengkapan berhasil diubah');
    }

    public function delete($id)
    {
        $pembelian = PembelianPerlengkapan::findOrFail($id);
        $pembelian->delete();

        Helper::logActivity('Pembelian Perlengkapan', 'Dihapus');

        return redirect()->route('pembelian-perlengkapan')->with('success', 'Pembelian Perlengkapan berhasil dihapus');
    }
}
