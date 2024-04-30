<?php

namespace App\Exports;

use App\Models\Obd;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ObdExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Obd::select('id', 'merk', 'type', 'serial_number')->get();
    }

    public function headings() : array
    {
        return ['ID', 'Merk', 'Tipe', 'Serial Number'];
    }
}
