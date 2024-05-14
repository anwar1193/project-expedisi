<div class="card-body">
    @if (session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil <i class="fa fa-info-circle"></i></strong>
        {{ session('success') }}
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session()->has('delete'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Berhasil <i class="fa fa-info-circle"></i></strong>
        {{ session('delete') }}
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if (session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Gagal <i class="fa fa-info-circle"></i></strong>
        {{ session('error') }}
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        @foreach ($errors->all() as $error)
        <strong>Failed <i class="fa fa-info-circle"></i></strong>
        {{ $error }}
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        <br>
        @endforeach
    </div>
    @endif

    {{-- <div class="tombol-export mb-3">
        <a href="{{ route('laporan.pengiriman.export-pdf', ['start' => request('start'), 'end' => request('end')]) }}" class="btn btn-danger" data-bs-toggle="tooltip"
            data-bs-placement="top" title="Cetak PDF">
            <i class="fa fa-file-pdf-o"></i> Cetak PDF
        </a>
    </div> --}}

    <div class="table-responsive">
        <table class="display" id="{{ $tableId }}">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Resi</th>
                    <th>Tanggal Transaksi</th>
                    <th>Nama Penerima</th>
                    <th>Kota Tujuan</th>
                    <th>Metode Pembayaran</th>
                    <th>Status Pembayaran</th>
                    <th>Ongkir</th>
                    <th>Komisi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    
                    <td>
                        <span class="badge badge-danger">
                            {{ $item->no_resi }}
                        </span>
                    </td>

                    <td>{{ $item->tgl_transaksi }}</td>
                    <td>{{ $item->nama_penerima }}</td>
                    <td>{{ $item->kota_tujuan }}</td>
                    <td>{{ $item->metode_pembayaran }}</td>

                    <td>
                        <span class="badge {{ $item->status_pembayaran == 1 ? 'badge-primary' : 'badge-warning' }}">
                            <i class="fa {{ $item->status_pembayaran == 1 ? 'fa-check' : 'fa-warning' }}"></i>
                            {{ $item->status_pembayaran == 1 ? 'Lunas' : 'Pending'; }}
                        </span>
                    </td>

                    <td>{{ number_format($item->ongkir, 0, '.', ',') }}</td>
                    <td>{{ number_format($item->komisi, 0, '.', ',') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>