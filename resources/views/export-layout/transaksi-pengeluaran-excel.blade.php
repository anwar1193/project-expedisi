<!DOCTYPE html>
<html>
    <head>
        <title>Transaksi Harian Pengeluaran</title>
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
                <td colspan="7" rowspan="2">
                    <h2><b>Transaksi Harian Pengeluaran</b></h2>
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
                <th class="text-center"><b>No</b></th>
                <th class="text-center"><b>Tanggal Pengeluaran</b></th>
                <th class="text-center"><b>Keterangan</b></th>
                <th class="text-center"><b>Jumlah Pembayaran</b></th>
                <th class="text-center"><b>Yang Melakukan Pembayaran</b></th>
                <th class="text-center"><b>Yang Menerima Pembayaran</b></th>
                <th class="text-center"><b>Metode Pembayaran</b></th>
                <th class="text-center"><b>Status Pemgeluaran</b></th>
                <th class="text-center"><b>Jenis Pengeluaran</b></th>
            </tr>
            @forelse($data as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->tgl_pengeluaran }}</td>
                <td>{{ $row->keterangan }}</td>
                <td>{{ 'Rp '.number_format($row->jumlah_pembayaran, 0, '.', '.') }} </td>
                <td>{{ $row->yang_membayar }}</td>
                <td>{{ $row->yang_menerima }}</td>
                <td>{{ $row->metode_pembayaran }}</td>
                <td>{{ $row->status_pengeluaran == 1 ? 'Disetuju' : 'Pending' }}</td>
                <td>{{ $row->jenis_pengeluaran }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3">Tidak Ada Data</td>
            </tr>
            @endforelse
        </table>
    </body>
</html>