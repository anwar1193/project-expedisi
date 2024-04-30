<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UserExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('id', 'nama', 'nip', 'kode_satker', 'nama_satker', 'email', 'nomor_telepon', 'username')->get();
    }

    public function headings() : array
    {
        return ['ID', 'Nama', 'NIP', 'Kode Satker', 'Nama Satker', 'Email', 'Nomor Telepon', 'Username'];
    }
}
