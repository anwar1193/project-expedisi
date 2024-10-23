<!DOCTYPE html>
<html>
    <head>
        <title>Transaksi Harian Pengiriman</title>
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
                    <h2><b>Transaksi Harian Pengiriman</b></h2>
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
                <th class="center"><b>No Resi</b></th>
                <th class="center"><b>Tanggal Transaksi</b></th>
                <th class="center"><b>Kode Customer</b></th>
                <th class="center"><b>Nama Penerima</b></th>
                <th class="center"><b>Kota Tujuan</b></th>
                <th class="center"><b>Bawa Sendiri</b></th>
                <th class="center"><b>Status Pengiriman</b></th>
                <th class="center"><b>Ongkir</b></th>
                <th class="center"><b>Metode Pembayaran</b></th>
            </tr>
            @forelse($data as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->no_resi }}</td>
                <td>{{ $row->tgl_transaksi }}</td>
                <td>
                    @if ($row->kode_customer == "General")
                        {{ $row->kode_customer }}
                    @else
                        {{ $row->kode_customer }} - {{ $row->nama }}
                    @endif
                </td>
                <td>{{ $row->nama_penerima }}</td>
                <td>{{ $row->kota_tujuan }}</td>
                <td>{{ $row->bawa_sendiri }}</td>
                <td>{{ $row->status_pengiriman }}</td>
                <td>{{ 'Rp '.number_format($row->ongkir, 0, '.', '.') }} </td>
                <td>{{ $row->metode_pembayaran }} {{ $row->metode_pembayaran_2 ? '-' : '' }} {{ $row->metode_pembayaran_2 }} </td>
            </tr>
            @empty
            <tr>
                <td colspan="3">Tidak Ada Data</td>
            </tr>
            @endforelse
        </table>
    </body>
</html>