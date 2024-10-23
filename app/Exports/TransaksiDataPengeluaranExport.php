<?php

namespace App\Exports;

use App\Models\DaftarPengeluaran;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransaksiDataPengeluaranExport implements FromView, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $data['data'] = DaftarPengeluaran::select('daftar_pengeluarans.id', 'tgl_pengeluaran', 'daftar_pengeluarans.keterangan', 'jumlah_pembayaran', 'yang_membayar', 'yang_menerima', 'metode_pembayaran', 'status_pengeluaran', 'jenis_pengeluarans.jenis_pengeluaran')
                        ->leftjoin('jenis_pengeluarans', 'jenis_pengeluarans.id', '=', 'daftar_pengeluarans.jenis_pengeluaran')
                        ->orderBy('daftar_pengeluarans.id', 'desc')
                        ->get();

        return view('export-layout.transaksi-pengeluaran-excel', $data);
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
         $sheet->getStyle('A6:I6')->applyFromArray($styleBody);

         // Calculate the last row with data
         $lastRow = $sheet->getHighestDataRow('I');
 
         // Apply the style to the body (A6:I{lastRow})
         $sheet->getStyle('A6:I' . $lastRow)->applyFromArray($styleBody);

         for ($col = 'B'; $col <= 'I'; $col++) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }
    }
}
