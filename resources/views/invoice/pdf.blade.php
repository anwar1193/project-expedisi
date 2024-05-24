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

        .col-sm-6 {
            flex: 0 0 48%;
        }

        .media {
            display: flex;
            align-items: center;
        }

        .card {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .card-body {
            padding: 20px;
        }

        .invo-header, .invo-profile, .invoice-table, .total-section {
            margin-bottom: 20px;
        }

        .media {
            display: flex;
            align-items: center;
        }

        .media-left {
            margin-right: 20px;
        }

        .img-60 {
            width: 60px;
            height: 60px;
        }

        .media-heading {
            margin: 0;
        }

        .digits {
            font-weight: bold;
        }

        .invo-header {
            display: flex;
            justify-content: space-between;
        }

        .invo-header .text-md-start {
            text-align: left;
        }
        
        .invo-header .text-md-end {
            text-align: right;
        }

        .text-xs-center {
            text-align: center;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-bordered {
            border: 1px solid #ddd;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }

        .total-section .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .card-footer {
            padding: 10px;
            background: #f1f1f1;
            border-top: 1px solid #ddd;
        }

        .card-footer .btn {
            background: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .card-footer .btn:hover {
            background: #0056b3;
        }

        .total-section {
            float: right;
            padding-top: 3px;
            margin-top: 3px;
        }

        .total-section .row {
            padding: 2px;
        }

        .total-section .col-4 {
            width: 100%;
        }

        .total-section .col {
            width: 100%;
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
    <div class="card">
        <div class="card-body">
            <div>
                <table>
                    <tbody>
                        <tr>
                            <td width="20%" class="table-header">
                                <h4>Lion Parcel</h4>
                                <p>
                                    help@thelionparcel.com<br />
                                    <span class="digits">+62-21-80820072</span>
                                </p>
                            </td>
                            <td></td>
                            <td class="table-header" style="text-align: end;">
                                <h3>Invoice #<span class="digits">1069</span></h3>
                                <p>
                                    Tanggal : 25 Mei 2024<br />
                                    Tanggal Jatuh Tempo : 25 Mei 2024
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                {{-- <div>
                    <div>
                        <h4">Lion Parcel</h4>
                        <p>
                            help@thelionparcel.com<br />
                            <span class="digits">+62-21-80820072</span>
                        </p>
                    </div>
                </div>
                <div>
                    <h3>Invoice #<span>1069</span></h3>
                    <p>
                        Tanggal : 25 Mei 2024<br />
                        Tanggal Jatuh Tempo : 25 Mei 2024
                    </p>
                </div> --}}
            </div>
            <div class="invo-profile py-2 my-2">
                <div class="col-xl-8">
                    <div class="text-xl-start" id="project">
                        <div>Tagihan Kepada</div>
                        <hr>
                        <div>Nama Customer : Adi Wijaya</div>
                        <div>Alamat Customer : Samarinda</div>
                        <div>No. Hp Customer : 085327654839</div>
                        <div>Email : adi.wijaya@mail.com</div>
                    </div>
                </div>
            </div>
            <div class="my-3 py-3">
                <div class="table-responsive invoice-table" id="table">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Deskripsi</th>
                                <th>Quantity</th>
                                <th>Berat</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <label>Lorem Ipsum</label>
                                    <p class="m-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                </td>
                                <td>5</td>
                                <td>3 Kg</td>
                                <td>Rp. 30000</td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Lorem Ipsum</label>
                                    <p class="m-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                </td>
                                <td>3</td>
                                <td>2 Kg</td>
                                <td>Rp. 22500</td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Lorem Ipsum</label>
                                    <p class="m-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                </td>
                                <td>10</td>
                                <td>1.5 Kg</td>
                                <td>Rp. 20000</td>
                            </tr>
                            <tr>
                                <td>
                                    <label>Lorem Ipsum</label>
                                    <p class="m-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                </td>
                                <td>10</td>
                                <td>1 Kg</td>
                                <td>Rp. 25000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="total-section float-end pt-3 mt-3">
                    <div class="row p-2">
                        <div class="col-4">Sub Total :</div>
                        <div class="col">Rp. 97500,00</div>
                    </div>
                    <div class="row p-2">
                        <div class="col-4">PPN :</div>
                        <div class="col">Rp. 9750,00</div>
                    </div>
                    <div class="row p-2">
                        <div class="col-4">Total :</div>
                        <div class="col">Rp. 117250,00</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>