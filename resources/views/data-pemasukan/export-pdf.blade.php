<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Pemasukan {{ $title }}</title>

    <style>
        #emp{
            font-family: Arial, Helvetica, sans-serif;
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
        <h2>Data Pemasukan</h2>
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
                <th>No Resi Pengiriman</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($data as $row)
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
                    <td>{{ $row->no_resi_pengiriman }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>