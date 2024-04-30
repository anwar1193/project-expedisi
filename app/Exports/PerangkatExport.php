<?php

namespace App\Exports;

use App\Models\Perangkat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PerangkatExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Perangkat::select('id', 'kode_perangkat', 'nama_perangkat', 'jenis_perangkat', 'serial_number', 'kondisi_perangkat')->get();
    }

    public function headings() : array
    {
        return ['ID', 'Kode Perangkat', 'Nama Perangkat', 'Jenis Perangkat', 'Serial Number', 'Kondisi Perangkat'];
    }
}
