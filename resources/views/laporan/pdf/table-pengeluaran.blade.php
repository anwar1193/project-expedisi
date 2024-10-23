<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Pengeluaran | {{ $title }}</title>

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
        <h2>Data Pengeluaran</h2>
        {{-- <em>Dicetak Pada : {{ $waktuCetak }}</em> --}}
    </div>

    <div style="text-align: start">
        <p>Periode: {{ \Carbon\Carbon::parse($start)->translatedFormat('d F Y') }} s/d {{ \Carbon\Carbon::parse($end_date)->translatedFormat('d F Y') }}</p>
    </div>
    
    <table id="emp" style="margin-top:20px">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pengeluaran</th>
                <th>Keterangan</th>
                <th>Jumlah Pembayaran</th>
                <th>Yang Melakukan Pembayaran</th>
                <th>Yang Menerima Pembayaran</th>
                <th>Metode Pembayaran</th>
                <th>Status Pengeluaran</th>
                <th>Jenis Pengeluaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengeluaran as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->tgl_pengeluaran }}</td>
                <td>{{ $item->keterangan }}</td>
                <td>Rp {{ number_format($item->jumlah_pembayaran, 0, ',', '.') }}</td>
                <td>{{ $item->yang_membayar }}</td>
                <td>{{ $item->yang_menerima }}</td>
                <td>{{ $item->metode_pembayaran }}</td>
                <td>{{ $item->status_pengeluaran == 1 ? 'Disetujui' : 'Pending' }}</td>
                <td>{{ $item->jenis_pengeluaran }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>