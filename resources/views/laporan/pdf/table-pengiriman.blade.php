<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Pengiriman | {{ $title }}</title>

    <style>
        #emp{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10px;
            border-collapse: collapse;
            width: 100%;
        }

        #emp td, #emp th{
            border: 1px solid #ddd;
            padding: 5px;
        }

        /* #emp tr:nth-child(even){
            background-color: aqua;
        } */

        #emp th{
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: aquamarine;
            color: #000;
        }
    </style>
</head>
<body>
    <div style="text-align: center;">
        <h2>Data Pengiriman</h2>
        <em>Dicetak Pada : {{ $waktuCetak }}</em>
    </div>
    
    <div style="text-align: start">
        <p>Periode: {{ \Carbon\Carbon::parse($start)->translatedFormat('d F Y') }} s/d {{ \Carbon\Carbon::parse($end_date)->translatedFormat('d F Y') }}</p>
    </div>
    <table id="emp" style="margin-top:20px">
        <thead>
            <tr>
                <th width="2%">No</th>
                <th>No Resi</th>
                <th>Tanggal Transaksi</th>
                <th>Nama Pengirim</th>
                <th>Nama Penerima</th>
                <th>No HP Pengirim</th>
                <th>No HP Penerima</th>
                <th>Kota Tujuan</th>
                <th>Berat Barang</th>
                <th>Ongkir</th>
                <th>Komisi</th>
                <th>Status Pembayaran</th>
                <th>Metode Pembayaran</th>
                <th>Jenis Pengiriman</th>
                <th>Status Pengiriman</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengiriman as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->no_resi }}</td>
                <td>{{ $item->tgl_transaksi }}</td>
                <td>{{ $item->nama_pengirim }}</td>
                <td>{{ $item->nama_penerima }}</td>
                <td>{{ $item->no_hp_pengirim }}</td>
                <td>{{ $item->no_hp_penerima }}</td>
                <td>{{ $item->kota_tujuan }}</td>
                <td>{{ $item->berat_barang }}</td>
                <td>Rp. {{ number_format($item->ongkir, 0, ',', '.') }}</td>
                <td>Rp. {{ number_format($item->komisi, 0, ',', '.') }}</td>
                <td>{{ $item->status_pembayaran == 1 ? 'Lunas' : 'Pending' }}</td>
                <td>{{ $item->metode_pembayaran }}</td>
                <td>{{ $item->jenis_pengiriman }}</td>
                <td>{{ $item->status_pengiriman }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>