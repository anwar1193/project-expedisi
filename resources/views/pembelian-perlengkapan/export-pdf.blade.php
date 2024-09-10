<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pembelian Perlengkapan {{ $title }}</title>

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
        <h2>Pembelian Perlengkapan</h2>
    </div>

    <table id="emp" style="margin-top:20px">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pembelian</th>
                <th>Nama Perlengkapan</th>
                <th>Nama Supplier</th>
                <th>Harga</th>
                <th>Jumlah</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($data as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->tanggal_pembelian }}</td>
                    <td>{{ $row->nama_perlengkapan }}</td>
                    <td>{{ $row->nama_supplier }}</td>
                    <td>{{ number_format($row->harga, 0, '.', ',') }}</td>
                    <td>{{ $row->jumlah }}</td>	
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>