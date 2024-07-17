<?php

namespace App\Exports;

use App\Models\DataPengiriman;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StatusPengirimanExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {   
        $data = DataPengiriman::select('no_resi', 'status_pengiriman')
                ->where('status_pengiriman', '!=', 'POD')
                ->get();

        return $data;
    }

    public function headings() : array
    {
        return ['no_resi', 'status_pengiriman'];
    }
}
