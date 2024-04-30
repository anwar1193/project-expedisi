<?php

namespace App\Exports;

use App\Models\SurveilanceCar;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SurveilanceCarExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SurveilanceCar::select('id', 'nopol', 'warna', 'merk', 'kapasitas', 'transmisi', 'bahan_bakar', 'status', 'kondisi')->get();
    }

    public function headings() : array
    {
        return ['ID', 'Nopol', 'Warna', 'Merk', 'Kapasitas', 'Transmisi', 'Bahan Bakar', 'Status', 'Kondisi'];
    }
}
