<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Pemasukkan | {{ $title }}</title>

    <style>
        #emp{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            border-collapse: collapse;
            width: 100%;
        }

        #emp td, #emp th{
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 12px
        }

        /* #emp tr:nth-child(even){
            background-color: aqua;
        } */

        #emp th{
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #d22d3d;
            color: #fff;
            text-align: center
        }
    </style>
</head>
<body>
    <div style="text-align: center;">
        <h2>Data Pemasukkan</h2>
        {{-- <em>Dicetak Pada : {{ $waktuCetak }}</em> --}}
    </div>

    <div style="text-align: start">
        <p>Periode: {{ \Carbon\Carbon::parse($start)->translatedFormat('d F Y') }} s/d {{ \Carbon\Carbon::parse($end_date)->translatedFormat('d F Y') }}</p>
    </div>
    
    <table id="emp" style="margin-top:20px">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pemasukan</th>
                <th>Barang/Jasa</th>
                <th>Keterangan</th>
                <th>Sumber Pemasukan</th>
                <th>Jumlah Pemasukan</th>
                <th>Metode Pembayaran</th>
                <th>Diterima Oleh</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($pemasukkan as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->tgl_pemasukkan }}</td>
                    <td>
                        @if ($row->kategori == 'barang')
                            {{ HApp::namaBarang($row->barang_jasa) }}
                        @else
                            {{ HApp::namaJasa($row->barang_jasa) }}
                        @endif
                    </td>
                    <td>{{ $row->keterangan }}</td>
                    <td>{{ $row->sumber_pemasukkan }}</td>
                    <td>{{ 'Rp '.number_format($row->jumlah_pemasukkan, 0, '.', '.') }} </td>
                    <td>{{ $row->metode_pembayaran }} {{ $row->metode_pembayaran2 ? '-' : '' }} {{ $row->metode_pembayaran2 }} </td>
                    <td>{{ $row->diterima_oleh }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>