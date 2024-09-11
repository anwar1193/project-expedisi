<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities. laravel/framework: ^8.40">
    <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <title>Tanda Terima {{ $title }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 8px
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .table-header h4, .table-header p, .table-header h3 {
            margin: 0;
        }

        .table-header {
            text-align: start;
        }

        .table-header h3 {
            text-align: end;
        }

        .table-header p {
            text-align: end;
        }

    </style>
    <!-- Google font-->
  </head>
  <body>
    <div style="border: 1px solid; padding: 2px 5px">
        <div style="border: 1px solid; padding: 5px">
            <div>
                <table>
                    <tbody>
                        <tr>
                            <td class="table-header" style="text-align: center">
                                <img src="{{  $picture }}" alt="Lion Parcel" style="width: 150px; height: 60px;" />
                                <h3 style="color: red; padding-left: 5px; padding-right: 10px; font-weight: bold">D Angel Express</h3>
                            </td>
                            <td style="font-weight: bold">
                                 <p>JI. Onta Baru No 51, Makassar 90135 - Sulawesi Selatan</p>
                                 <p>Telp : 0821 1007 1565</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="margin-top: 15px">
                <table>
                    <thead>
                        <th width="30%"></th>
                        <th width="5%"></th>
                        <th></th>
                    </thead>
                    <tbody>
                        <tr style="font-weight: bold; border-bottom: 1px solid">
                            <td style="padding: 5px;">Telah Diterima Dari</td>
                            <td style="padding: 5px;">:</td>
                            <td style="text-align: center; text-decoration: underline">{{ $data->sumber_pemasukkan }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px;">Uang Sejumlah</td>
                            <td style="padding: 10px;">:</td>
                            <td style="padding: 10px;">{{ terbilang($data->jumlah_pemasukkan) }} RUPIAH</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px;">Uang Pembayaran</td>
                            <td style="padding: 10px;">:</td>
                            <td style="padding: 10px;">{{ $data->keterangan }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 10px;">Terbilang</td>
                            <td style="padding: 10px;">:</td>
                            <td style="font-weight: bold; padding: 10px;">RP. {{ number_format($data->jumlah_pemasukkan, 0, '.', '.') }}-</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="margin-top: -10px">
                <table>
                    <tbody>
                        <tr>
                            <td width="30%"></td>
                            <td style="padding-left: 10px">Makassar, {{ formatTanggalIndonesia($data->tgl_pemasukkan) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>