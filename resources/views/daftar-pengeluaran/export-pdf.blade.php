<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Pengeluaran {{ $title }}</title>

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
        <h2>Data Pengeluaran</h2>
    </div>

    <table id="emp" style="margin-top:20px">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pengeluaran</th>
                <th>Keterangan</th>
                <th>Jumlah Pembayaran</th>
                <th>Yang Menerima Pembayaran</th>
                <th>Metode Pembayaran</th>
                <th>Yang Melakukan Pembayaran</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->tgl_pengeluaran }}</td>
                    <td>{{ $row->keterangan }}</td>
                    <td>{{ 'Rp '.number_format($row->jumlah_pembayaran, 0, '.', '.') }} </td>
                    <td>{{ $row->yang_menerima }}</td>
                    <td>{{ $row->metode_pembayaran }}</td>
                    <td>{{ $row->yang_membayar }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>