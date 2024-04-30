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
    </style>
</head>
<body>
    <div style="text-align: center;">
        <h2>Data Log Aktifitas</h2>
        <em>Dicetak Pada : {{ $waktu_cetak }}</em>
    </div>
    
    <table id="emp" style="margin-top:20px">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Log Time</th>
                <th>Activity</th>
                <th>IP Address</th>
                <th>Browser</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($log_activities as $row)
                <tr style="font-size: 10px">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->username }}</td>
                    <td>{{ $row->log_time }}</td>
                    <td>{{ $row->activity }}</td>
                    <td>{{ $row->ip_address }}</td>
                    <td>{{ $row->browser }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>