<!DOCTYPE html>
<html>
    <head>
        <title>Data Pembelian Perlengkapan</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <style type="text/css">
            .center{
                line-height: 100%;
                text-align: center;
            }

            .left{
                line-height: 100%;
                text-align: left;
            }
            
            .full{
                width : 100%;
            }
            .wrapper{
                padding-left:30px;
                padding-right: 30px;
            }
            .kanan{
                float:right;
                display:block;
                width:200px;
            }
            .kiri{
                float:left;
                display:block;
                width:200px;
            }
        </style>
    </head>
    <body>
        <table class="table">
            <tr>
                <td colspan="12" rowspan="2">
                    <h2><b>Data Pembelian Perlengkapan</b></h2>
                </td>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
            </tr> 
            <tr>
                <td></td>
                <td></td>
            </tr>
        </table>
        <table class="table table-bordered">
            <tr>
                <th class="center"><b>No</b></th>
                <th class="center"><b>Tanggal Pembelian</b></th>
                <th class="center"><b>Nama Perlengkapan</b></th>
                <th class="center"><b>Nama Supplier</b></th>
                <th class="center"><b>Harga</b></th>
                <th class="center"><b>Jumlah</b></th>
            </tr>
            @forelse($data as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->tanggal_pembelian }}</td>
                <td>{{ $row->nama_perlengkapan }}</td>
                <td>{{ $row->nama_supplier }}</td>
                <td>{{ number_format($row->harga, 0, '.', ',') }}</td>
                <td>{{ $row->jumlah }}</td>	
            </tr>
            @empty
            <tr>
                <td colspan="3">Tidak Ada Data</td>
            </tr>
            @endforelse
        </table>
    </body>
</html>