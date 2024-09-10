<?php

namespace App\Imports;

use App\Helpers\Helper;
use Carbon\Carbon;
use App\Models\data;
use App\Models\DataPengiriman;
use App\Models\Pesan;
use App\Models\SettingWa;
use App\Models\StatusPengiriman;
use Illuminate\Support\Facades\Http;
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
        $pesan = Pesan::find(Pesan::SP);
        $data = DataPengiriman::where('no_resi', $row['no_resi'])
                ->leftjoin('customers', 'data_pengirimen.kode_customer', '=', 'customers.kode_customer')
                ->first();

        if (!$statusValid) {
            $this->errors[] = 'Status pengiriman yang diiput untuk no resi: ' . $row['no_resi'] .' tidak sesuai';
            return null;
        }

        // $update = data::where('no_resi', $row['no_resi'])->update([
        //     'status_pengiriman' => $row['status_pengiriman']
        // ]);
        if ($data) {
            $data->update(['status_pengiriman' => $row['status_pengiriman']]);
            
            $statusUpdate = StatusPengiriman::where('status_pengiriman', $row['status_pengiriman'])->first();
            
            $timeOfDay = Helper::getTimeOfDay().' '.'*'.$data->nama_pengirim.'*';
            $tanggal = $data->tgl_transaksi;
            $noResi = $data->no_resi;
            $namaPenerima = $data->nama_penerima;
            $tujuan = $data->kota_tujuan;
            $status = $statusUpdate->keterangan_pengiriman;
            
            $message = str_replace(
                ['{timeof_day}', '{tanggal}', '{no_resi}', '{nama_penerima}', '{tujuan}', '{status}'],
                [$timeOfDay, '*'.$tanggal.'*', '*'.$noResi.'*', '*'.$namaPenerima.'*', '*'.$tujuan.'*', '*'.$status.'*'],
                $pesan->isi_pesan
            );
            
            $url = SettingWa::select('url_message AS url')->latest()->first();
            $dataSending = sendWaText($data->no_hp_pengirim, $message);
            
            if ($data->notif_wa && $data->notif_wa == DataPengiriman::STATUS_WA_AKTIF) {
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post($url->url, $dataSending);
            } elseif($data->notif_wa == '' && $data->status_kirim_wa == DataPengiriman::STATUS_WA_AKTIF) {
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post($url->url, $dataSending);
                // ])->post('https://api.watzap.id/v1/send_message', $dataSending);
            }
        }
//08172645362
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
