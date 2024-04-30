<?php

namespace App\Exports;

use App\Models\LogActivity;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LogActivityExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LogActivity::all();
    }

    public function headings() : array
    {
        return ['ID', 'Username', 'Log Time', 'Activity', 'Created At', 'Updated At', 'IP Address', 'Browser'];
    }
}
