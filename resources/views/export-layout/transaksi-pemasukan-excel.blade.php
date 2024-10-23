<!DOCTYPE html>
<html>
    <head>
        <title>Transaksi Harian Pemasukan</title>
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
                <td colspan="8" rowspan="2">
                    <h2><b>Transaksi Harian Pemasukan</b></h2>
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
            <thead>
                <tr>
                    <th class="text-center"><b>No</b></th>
                    <th class="text-center"><b>Tanggal Pemasukan</b></th>
                    <th class="text-center"><b>Barang/Jasa</b></th>
                    <th class="text-center"><b>Keterangan</b></th>
                    <th class="text-center"><b>Sumber Pemasukan</b></th>
                    <th class="text-center"><b>Jumlah Pemasukan</b></th>
                    <th class="text-center"><b>Metode Pembayaran</b></th>
                    <th class="text-center"><b>Diterima Oleh</b></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->tgl_pemasukkan }}</td>
                        <td>
                            @if ($row->kategori == 'barang')
                                {{ HApp::namaBarang($row->barang_jasa) }}
                            @else
                                {{ HApp::namaJasa($row->barang_jasa) }}
                            @endif
                        </td>
                        <td>{{ $row->keterangan }}</td>
                        <td>{{ $row->sumber_pemasukkan }}</td>
                        <td>{{ 'Rp '.number_format($row->jumlah_pemasukkan, 0, '.', '.') }} </td>
                        <td>{{ $row->metode_pembayaran }} {{ $row->metode_pembayaran2 ? '-' : '' }} {{ $row->metode_pembayaran2 }} </td>
                        <td>{{ $row->diterima_oleh }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">
                            <center>TIdak Ada Data</center>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </body>
</html>