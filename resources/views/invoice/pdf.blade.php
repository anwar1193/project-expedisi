<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities. laravel/framework: ^8.40">
    <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <title>Invoice {{ $title }}</title>

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
    <div>
        <div>
            <div>
                <table>
                    <tbody>
                        <tr>
                            <td class="table-header">
                                <img src="{{  $picture }}" alt="Lion Parcel" style="width: 150px; height: 60px;" />
                                <h3 style="color: red; padding-right: 10px; font-weight: bold">D Angel Express</h3>
                            </td>
                            <td style="text-align: center; font-weight: bold"><h2>Invoice</h2></td>
                            <td style="display: flex; align-items: flex-end; padding-top: 45px; text-align: center;"><p>Jakarta, 30 Mei 2024</p></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="border: 1px solid black; width: 70%">
                <table style="padding: 10px 0px 0px 10px; font-size: 14px">
                    <tbody>
                        <tr>
                            <td>Invoice No</td>
                            <td>:</td>
                            <td>033/INV /LP/IV/2024</td>
                        </tr>
                        <tr>
                            <td>Customer Name</td>
                            <td>:</td>
                            <td>PT. Dion Farma Abadi</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td>Jl. Malengkeri Raya</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <p><small>Biaya Pengiriman</small>  PT. Dion Farma Abadi</p>
            </div>
            <div>
                <div>
                    <table id="data" style="border: 1px solid; width: 100%">
                        <thead>
                            <tr>
                                <th style="border: 1px solid">No</th>
                                <th style="border: 1px solid">No STT</th>
                                <th style="border: 1px solid">Tanggal</th>
                                <th style="border: 1px solid">Pengirim</th>
                                <th style="border: 1px solid">Penerima</th>
                                <th style="border: 1px solid">Tujuan</th>
                                <th style="border: 1px solid">Jumlah Pembayaran</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 14px">
                            <tr>
                                <td style="border: 1px solid; padding: 5px; text-align: center">1</td>
                                <td style="border: 1px solid; padding: 5px; text-align: center">11LP1714021194290</td>
                                <td style="border: 1px solid; padding: 5px; text-align: center">2024-04-25 11:59:53 +0000 +0000</td>
                                <td style="border: 1px solid; padding: 5px; text-align: center">APOTIK MEDICASTORE/ DION FARMA ABADI</td>
                                <td style="border: 1px solid; padding: 5px; text-align: center">DR ROMMY WIJAYA</td>
                                <td style="border: 1px solid; padding: 5px; text-align: center">DULOMO SELATAN, KOTA UTARA, GORONTALO</td>
                                <td style="border: 1px solid; padding: 5px; text-align: center">62,000</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid; padding: 5px; text-align: center">2</td>
                                <td style="border: 1px solid; padding: 5px; text-align: center">11LP1714020999725</td>
                                <td style="border: 1px solid; padding: 5px; text-align: center">2024-04-25 11:58:24 +0000 +0000</td>
                                <td style="border: 1px solid; padding: 5px; text-align: center">APOTIK MEDICASTORE/ DION FARMA ABADI</td>
                                <td style="border: 1px solid; padding: 5px; text-align: center">DR ASRIANI</td>
                                <td style="border: 1px solid; padding: 5px; text-align: center">DR ASRIANI</td>
                                <td style="border: 1px solid; padding: 5px; text-align: center">39,000</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid; padding: 5px; text-align: center">3</td>
                                <td style="border: 1px solid; padding: 5px; text-align: center">11LP1714020999725</td>
                                <td style="border: 1px solid; padding: 5px; text-align: center">2024-04-25 11:59:53 +0000 +0000</td>
                                <td style="border: 1px solid; padding: 5px; text-align: center">APOTIK MEDICASTORE/ DION FARMA ABADI</td>
                                <td style="border: 1px solid; padding: 5px; text-align: center">dr shinta n barnas</td>
                                <td style="border: 1px solid; padding: 5px; text-align: center">POASIA, KENDARI</td>
                                <td style="border: 1px solid; padding: 5px; text-align: center">67,000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div style="display: flex; justify-content: center; text-align: center; line-height: 0.6;">
                    <p style="text-transform: uppercase">Lion parcel - D Angel Express</p>
                    <p style="text-transform: capitalize">Jl. Onta Baru no 51, Kelurahan Mandala, Kecamatan Mamajang, Kota Makassar – 90135</p>
                    <p style="text-transform: capitalize">Sulawesi Selatan</p>
                    <p style="text-transform: capitalize">Telp : 0411 – 8918311 , 082110071565</p>
                    <p>Website : http://lionparcel.com/</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>