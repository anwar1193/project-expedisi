<?php

namespace App\Exports;

use App\Models\DataPengiriman;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataPengirimanExport implements FromView, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $data['data'] = DataPengiriman::select('data_pengirimen.id', 'no_resi', 'tgl_transaksi', 'data_pengirimen.kode_customer', 'metode_pembayaran', 'nama_pengirim', 'nama_penerima', 'kota_tujuan', 'bawa_sendiri', 'status_pengiriman', 'ongkir', 'input_by')
                        ->leftJoin('customers', 'customers.kode_customer', '=', 'data_pengirimen.kode_customer')
                        ->orderBy('data_pengirimen.id', 'DESC')->get();

        return view('export-layout.pengiriman-excel', $data);
    }
    

    public function styles(Worksheet $sheet)
    {
        // Define a style for cell borders
        $styleHeaderTitle= [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
            ],
        ];

        $styleBody= [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
        ];

        // Apply the style to the Title (A1)
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
        $sheet->getStyle('A1')->getFont()->setSize(15);

         // Apply the style to the body header (A6:K6)
         $sheet->getStyle('A6:L6')->applyFromArray($styleBody);

         // Calculate the last row with data
         $lastRow = $sheet->getHighestDataRow('K');
 
         // Apply the style to the body (A6:K{lastRow})
         $sheet->getStyle('A6:L' . $lastRow)->applyFromArray($styleBody);

         for ($col = 'B'; $col <= 'K'; $col++) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }
}
