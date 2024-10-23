<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Pengiriman {{ $title }}</title>

    <style>
        #emp{
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #emp td, #emp th{
            border: 1px solid #ddd;
            padding: 5px;
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
        <h2>Data Pengiriman</h2>
    </div>

    <table id="emp" style="margin-top:20px">
        <thead>
            <tr>
                <th>No</th>
                <th>No Resi</th>
                <th>Tanggal Transaksi</th>
                <th>Customer</th>
                <th>Metode Pembayaran</th>
                <th>Pengirim</th>
                <th>Penerima</th>
                <th>Kota Tujuan</th>
                <th>Bawa Sendiri</th>
                <th>Status Pengiriman</th>
                <th>Ongkir</th>
                <th>Diinput Oleh</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->no_resi }}</td>
                    <td>{{ $row->tgl_transaksi }}</td>
                    <td>
                        @if ($row->kode_customer == "General")
                            {{ $row->kode_customer }}
                        @else
                            {{ $row->kode_customer }} - {{ $row->nama }}
                        @endif
                    </td>
                    <td>{{ $row->metode_pembayaran }} {{ $row->metode_pembayaran_2 ? '-' : '' }} {{ $row->metode_pembayaran_2 }} </td>
                    <td>{{ $row->nama_pengirim }}</td>
                    <td>{{ $row->nama_penerima }}</td>
                    <td>{{ $row->kota_tujuan }}</td>
                    <td>{{ $row->bawa_sendiri }}</td>
                    <td>{{ $row->status_pengiriman }}</td>
                    <td>{{ 'Rp '.number_format($row->ongkir, 0, '.', '.') }} </td>
                    <td>{{ $row->input_by }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>