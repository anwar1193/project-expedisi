<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OBD {{ $title }}</title>

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
    </style>
</head>
<body>
    <div style="text-align: center;">
        <h2>Data OBD</h2>
        <em>Dicetak Pada : {{ $waktu_cetak }}</em>
    </div>
    
    <table id="emp" style="margin-top:20px">
        <thead>
            <tr>
                <th>No</th>
                <th>Merk</th>
                <th>Tipe</th>
                <th>Serial Number</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($obd as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->merk }}</td>
                    <td>{{ $row->type }}</td>
                    <td>{{ $row->serial_number }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>