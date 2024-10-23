<?php

namespace App\Exports;

use App\Models\PembelianPerlengkapan;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PembelianPerlengkapanExport implements FromView, WithStyles
{
    /**
    * @return \Illuminate\Support\View
    */
    public function view(): View
    {
        $data['data'] = PembelianPerlengkapan::select(
                        'pembelian_perlengkapans.id', 
                        'pembelian_perlengkapans.tanggal_pembelian', 
                        'perlengkapans.nama_perlengkapan', 
                        'suppliers.nama_supplier', 
                        'pembelian_perlengkapans.harga', 
                        'pembelian_perlengkapans.jumlah', 
                    )
                    ->leftjoin('perlengkapans', 'pembelian_perlengkapans.id_perlengkapan', '=', 'perlengkapans.id')
                    ->leftjoin('suppliers', 'pembelian_perlengkapans.id_supplier', '=', 'suppliers.id')
                    ->orderBy('pembelian_perlengkapans.id', 'desc')
                    ->get();

        return view('export-layout.pembelian-excel', $data);
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
         $sheet->getStyle('A6:F6')->applyFromArray($styleBody);

         // Calculate the last row with data
         $lastRow = $sheet->getHighestDataRow('K');
 
         // Apply the style to the body (A6:K{lastRow})
         $sheet->getStyle('A6:F' . $lastRow)->applyFromArray($styleBody);

         for ($col = 'B'; $col <= 'K'; $col++) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }
}
