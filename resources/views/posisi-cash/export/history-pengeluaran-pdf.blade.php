<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>History Pengeluaran Cash {{ $title }}</title>

    <style>
        #emp{
            font-family: Arial, Helvetica, sans-serif;
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
            background-color: #dc3545;
        }
    </style>
</head>
<body>
    <div style="text-align: center;">
        <h2>History Pengeluaran Cash</h2>
    </div>

    <table id="emp" style="margin-top:20px">
        <thead>
            <tr>
                <th>No</th>
                <th>Jumlah Saldo</th>
                <th>Tanggal</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($pengeluaran as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ 'Rp '.number_format($row->jumlah, 0, '.', '.') }} </td>
                    <td>{{ $row->tanggal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>