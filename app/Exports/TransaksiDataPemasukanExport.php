<?php

namespace App\Exports;

use App\Helpers\Helper;
use App\Models\PemasukanLainnya;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransaksiDataPemasukanExport implements FromView, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        date_default_timezone_set('Asia/Jakarta');
        $start = date('Y-m-d');
        $end = date('Y-m-d');

        $data['data'] = PemasukanLainnya::select('id', 'tgl_pemasukkan', 'barang_jasa', 'keterangan', 'sumber_pemasukkan', 'jumlah_pemasukkan', 'metode_pembayaran', 'diterima_oleh')
                ->orderBy('id', 'desc')->whereBetween('tgl_pemasukkan', [$start, $end])
                ->get();

        return view('export-layout.transaksi-pemasukan-excel', $data);
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
         $sheet->getStyle('A6:H6')->applyFromArray($styleBody);

         // Calculate the last row with data
         $lastRow = $sheet->getHighestDataRow('K');
 
         // Apply the style to the body (A6:K{lastRow})
         $sheet->getStyle('A6:H' . $lastRow)->applyFromArray($styleBody);

         for ($col = 'B'; $col <= 'K'; $col++) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }
}
