<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

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
            background-color: aquamarine;
            color: #000;
        }

        .small{
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div style="text-align: center;">
        <h2>Data User</h2>
        <em>Dicetak Pada : {{ $waktu_cetak }}</em>
    </div>
    
    <table id="emp" style="margin-top:20px">
        <thead>
            <tr class="small">
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Kode Satker</th>
                <th>Nama Satker</th>
                <th>Email</th>
                <th>No Telepon</th>
                <th>Username</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $row)
                <tr class="small">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->nama }}</td>
                    <td>{{ $row->nip }}</td>
                    <td>{{ $row->kode_satker }}</td>
                    <td>{{ $row->nama_satker }}</td>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->nomor_telepon }}</td>
                    <td>{{ $row->username }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>