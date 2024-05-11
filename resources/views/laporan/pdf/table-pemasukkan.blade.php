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
        <h2>Data Pemasukkan</h2>
        <em>Dicetak Pada : {{ $waktuCetak }}</em>
    </div>

    <div style="text-align: start">
        <p>Periode: {{ \Carbon\Carbon::parse($start)->translatedFormat('d F Y') }} s/d {{ \Carbon\Carbon::parse($end_date)->translatedFormat('d F Y') }}</p>
    </div>
    
    <table id="emp" style="margin-top:20px">
        <thead>
            <tr>
                <th>No</th>
                <th>Kategori</th>
                <th>Customer</th>
                <th>Harga</th>
                <th>Tanggal Transaksi</th>
                <th>Komisi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pemasukkan as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->kategori }}</td>
                <td>{{ $item->nama_customer }}</td>
                <td>Rp. {{ number_format($item->harga, 0, ',', '.') }}</td>
                <td>{{ $item->tanggal_transaksi }}</td>
                <td>Rp. {{ number_format($item->komisi, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>