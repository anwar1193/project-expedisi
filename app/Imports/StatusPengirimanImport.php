<?php

namespace App\Imports;

use Carbon\Carbon;
use App\Models\DataPengiriman;
use App\Models\StatusPengiriman;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
Use PhpOffice\PhpSpreadsheet\Shared\Date;

class StatusPengirimanImport implements ToModel, WithValidation, WithHeadingRow
{
    private $errors = [];
    
    /**
    * @param Collection $collection
    */
    public function model(array $row)
    {
        $statusValid = StatusPengiriman::where('status_pengiriman', $row['status_pengiriman'])->exists();

        if (!$statusValid) {
            $this->errors[] = 'Status pengiriman yang diiput untuk no resi: ' . $row['no_resi'] .' tidak sesuai';
            return null;
        }

        DataPengiriman::where('no_resi', $row['no_resi'])->update([
            'status_pengiriman' => $row['status_pengiriman']
        ]);

        return null;
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function rules(): array
    {
        return [
            'no_resi' => 'required',
            'status_pengiriman' => 'required'
        ];
    }

    public function customValidationMessages()
    {       
        return [
            'no_resi.required' => ':attribute Tidak Boleh Kosong',
            'status_pengiriman.required' => ':attribute Tidak Boleh Kosong',
        ];
    }
    

    public function customValidationAttributes()
    {
        return [
            'no_resi' => 'Nomor Resi',
            'status_pengiriman' => 'Status Pengiriman'
        ];
    }
}
