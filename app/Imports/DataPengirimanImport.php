<?php

namespace App\Imports;

use DateTime;
use Carbon\Carbon;
use App\Models\Bank;
use App\Models\Customer;
use App\Models\DataPengiriman;
use App\Models\KonversiPoint;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToArray;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
Use PhpOffice\PhpSpreadsheet\Shared\Date;

class DataPengirimanImport implements ToArray, WithValidation, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function array(array $row)
    {
        // if (!$this->firstRowSkipped) {
        //     $this->firstRowSkipped = true;
        //     return null;
        // }

        // $tgl_transaksi = Date::excelToDateTimeObject($row['tgl_transaksi'])->format('Y-m-d');

        // $konversi_point = KonversiPoint::where('id', 1)->first();

        // $customer = Customer::where('kode_customer', $row['kode_customer']);
        // $rcustomer = $customer->first();

        // if($rcustomer != NULL){
        //     $pointOld = $rcustomer->point;
        //     $kreditOld = $rcustomer->limit_credit;
            
        //     // Update Point & Credit
        //     $customer->update([
        //         'point' => $pointOld + ($row['ongkir'] / $konversi_point->nominal),
        //         'limit_credit' => $kreditOld - $row['ongkir']
        //     ]);
        // }

        $formattedData = [];

        foreach ($row as $row) {
            $formattedData[] = [
                'no_resi' => $row['no_resi'],
                'tgl_transaksi' => Date::excelToDateTimeObject($row['tgl_transaksi'])->format('Y-m-d H:i'), // Assuming tgl_transaksi is in the row data
                'diinput_oleh' => $row['diinput_oleh'],
                'kode_customer' => $row['kode_customer'],
                'nama_pengirim' => $row['nama_pengirim'],
                'nama_penerima' => $row['nama_penerima'],
                'kota_tujuan' => $row['kota_tujuan'],
                'no_hp_pengirim' => $row['no_hp_pengirim'],
                'no_hp_penerima' => $row['no_hp_penerima'],
                'berat_barang' => $row['berat_barang'],
                'ongkir' => $row['ongkir'],
                'komisi' => $row['komisi'],
                'status_pembayaran' => $row['metode_pembayaran'] == "Tunai" ? 1 : 2,
                'metode_pembayaran' => $row['metode_pembayaran'],
                'bank' => $row['bank'],
                'bukti_pembayaran' => $row['bukti_pembayaran'] ?? "",
                'jenis_pengiriman' => $row['jenis_pengiriman'],
                'bawa_sendiri' => $row['bawa_sendiri'],
                'status_pengiriman' => $row['status_pengiriman'],
                'status_kirim_wa' => $row['status_kirim_wa'],
                'keterangan' => $row['keterangan'] != '' ? $row['keterangan'] : '-',
            ];
        }

        return $formattedData;
    }

    public function rules(): array
    {
        return [
            'no_resi' => 'required|unique:data_pengirimen',
            'tgl_transaksi' => 'required',
            'nama_pengirim' => 'required',
            'nama_penerima' => 'required',
            'kota_tujuan' => 'required',
            'no_hp_pengirim' => 'required',
            'no_hp_penerima' => 'required',
            'berat_barang' => 'required',
            'ongkir' => 'required',
            'komisi' => 'required',

            'metode_pembayaran' => function($attribute, $value, $onFailure) {
                if($value !== NULL){
                    if ($value !== 'Transfer' && $value !== 'Tunai' && $value !== 'Kredit') {
                        $onFailure('Metode Pembayaran Harus Transfer, Tunai, Kredit, atau Dikosongkan');
                   }
                }
            },

            'jenis_pengiriman' => 'required',
            'bawa_sendiri' => 'required',
            'status_pengiriman' => 'required',
        ];
    }

    // Validasi Custom
    public function withValidator($validator){
        $validator->after(function ($validator) {
            foreach($validator->getData() as $key=>$data){
                
                // Jika Metode Pembayaran = Transfer, Bank Wajib Diisi
                if($data['metode_pembayaran'] == 'Transfer' && $data['bank'] == ''){
                    $validator->errors()->add($key,'Bank Wajib Diisi Ketika Metode Pembayaran = Transfer');
                }

                // Jika Metode Pembayaran != Transfer, Bank Wajib Kosong
                if($data['metode_pembayaran'] != 'Transfer' && $data['bank'] != ''){
                    $validator->errors()->add($key,'Kolom Bank Harus Dikosongkan Ketika Metode Pembayaran Bukan Transfer');
                }

                // Jika Metode Pembayaran = Transfer
                if($data['metode_pembayaran'] == 'Transfer'){

                    // Bukti pembayaran wajib diisi
                    if($data['bukti_pembayaran'] == ''){
                        $validator->errors()->add($key,'Bukti Pembayaran Wajib Diisi Ketika Metode Pembayaran = Transfer');
                    }

                    // Cek apakah bank tersedia di sistem
                    $bankTerdaftar = Bank::where('bank', $data['bank'])->exists();
                    if (!$bankTerdaftar) {
                        $validator->errors()->add($key,'Bank yang anda input tidak tersedia di sistem!');
                    }
                }

                // Jika Metode Pembayaran Bukan Transfer, Bukti Pembayaran Wajib Kosong
                if($data['metode_pembayaran'] != 'Transfer' && $data['bukti_pembayaran'] != ''){
                    $validator->errors()->add($key,'Kolom Bukti Pembayaran Harus Dikosongkan Ketika Metode Pembayaran Bukan Transfer');
                }

                // Jika Metode Pembayaran = Kredit, maka harus customer yang sudah terdaftar di sistem
                if($data['metode_pembayaran'] == 'Kredit'){
                    $customerTerdaftar = Customer::where('kode_customer', $data['kode_customer'])->exists();

                    if (!$customerTerdaftar) {
                        $validator->errors()->add($key,'Metode pembayaran kredit hanya berlaku untuk customer terdaftar!');
                    }
                }
                
                // Validasi Tanggal Tidak Boleh mundur lebih dari 7 Hari
                $tanggalSekarang = date('Y-m-d');
                $tanggalTransaksi = Date::excelToDateTimeObject($data['tgl_transaksi'])->format('Y-m-d');

                $diff = strtotime($tanggalSekarang) - strtotime($tanggalTransaksi);
                $jarakHari = abs(round($diff / 86400));

                if($jarakHari > 7){
                    $validator->errors()->add($key, 'Tanggal transaksi tidak boleh mundur lebih dari 7 hari!');
                }
    
            }
            
        });
    }

    public function customValidationMessages()
    {       
        return [
            'no_resi.required' => ':attribute Tidak Boleh Kosong',
            'no_resi.unique' => ':attribute Tidak Boleh Duplikat',
            'tgl_transaksi.required' => ':attribute Tidak Boleh Kosong',
            'nama_pengirim.required' => ':attribute Tidak Boleh Kosong',
            'nama_penerima.required' => ':attribute Tidak Boleh Kosong',
            'kota_tujuan.required' => ':attribute Tidak Boleh Kosong',
            'no_hp_pengirim.required' => ':attribute Tidak Boleh Kosong',
            'no_hp_penerima.required' => ':attribute Tidak Boleh Kosong',
            'berat_barang.required' => ':attribute Tidak Boleh Kosong',
            'ongkir.required' => ':attribute Tidak Boleh Kosong',
            'komisi.required' => ':attribute Tidak Boleh Kosong',
            'jenis_pengiriman.required' => ':attribute Tidak Boleh Kosong',
            'bawa_sendiri.required' => ':attribute Tidak Boleh Kosong',
            'status_pengiriman.required' => ':attribute Tidak Boleh Kosong',
        ];
    }
    

    public function customValidationAttributes()
    {
        return [
            'no_resi' => 'Nomor Resi',
            'tgl_transaksi' => 'Tanggal Transaksi',
            'nama_pengirim' => 'Nama Pengirim',
            'nama_penerima' => 'Nama Penerima',
            'kota_tujuan' => 'Kota Tujuan',
            'no_hp_pengirim' => 'Nomor HP Pengirim',
            'no_hp_penerima' => 'Nomor HP Penerima',
            'berat_barang' => 'Berat Barang',
            'ongkir' => 'Ongkos Kirim',
            'komisi' => 'Komisi',
            'jenis_pengiriman' => 'Jenis Pengiriman',
            'bawa_sendiri' => 'Bawa Sendiri',
            'status_pengiriman' => 'Status Pengiriman',
        ];
    }
}