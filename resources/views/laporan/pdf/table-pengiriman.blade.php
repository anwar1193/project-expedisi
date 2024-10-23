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
        <h2>Data Pengiriman</h2>
        {{-- <em>Dicetak Pada : {{ $waktuCetak }}</em> --}}
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
                <th>Customer</th>
                <th>Nama Penerima</th>
                <th>Kota Tujuan</th>
                <th>Metode Pembayaran</th>
                <th>Status Pembayaran</th>
                <th>Ongkir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengiriman as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->no_resi }}</td>
                <td>{{ $item->tgl_transaksi }}</td>
                <td>
                    @if ($item->kode_customer == "General")
                        {{ $item->kode_customer }}
                    @else
                        {{ $item->kode_customer }} - {{ $row->nama }}
                    @endif
                </td>
                <td>{{ $item->nama_penerima }}</td>
                <td>{{ $item->kota_tujuan }}</td>
                <td>{{ $item->metode_pembayaran }} {{ $item->metode_pembayaran_2 ? '-' : '' }} {{ $item->metode_pembayaran_2 }} </td>
                <td>{{ $item->status_pembayaran == 1 ? 'Approve' : 'Pending' }}</td>
                <td>Rp. {{ number_format($item->ongkir, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>