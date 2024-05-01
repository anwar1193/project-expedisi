<?php

namespace App\Imports;

use App\Models\DataPengiriman;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
Use PhpOffice\PhpSpreadsheet\Shared\Date;

class DataPengirimanImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $tgl_transaksi = Date::excelToDateTimeObject($row[2])->format('Y-m-d');

        return new DataPengiriman([
            'no_resi' => $row[1],
            'tgl_transaksi' => $tgl_transaksi,
            'nama_pengirim' => $row[3],
            'nama_penerima' => $row[4],
            'kota_tujuan' => $row[5],
            'no_hp_pengirim' => '0'.$row[6],
            'no_hp_penerima' => '0'.$row[7],
            'berat_barang' => $row[8],
            'ongkir' => $row[9],
            'komisi' => $row[10],
            'status_pembayaran' => $row[11] == "Lunas" ? 1 : 2,
            'metode_pembayaran' => $row[12],
            'bukti_pembayaran' => $row[13] ?? "Belum Ada Gambar",
        ]);
    }
}
