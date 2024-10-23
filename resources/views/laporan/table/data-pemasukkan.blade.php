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

    <div class="tombol-export mb-3">
        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#pemasukanModal">
            <i class="fa fa-check-square"></i> Export
        </button>

        @include('laporan.modal-export.pemasukan-modal')
    </div>

    <div class="table-responsive">
        <table class="display" id="{{ $tableId }}">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Pemasukan</th>
                    <th>Barang/Jasa</th>
                    <th>Keterangan</th>
                    <th>Sumber Pemasukan</th>
                    <th>Jumlah Pemasukan</th>
                    <th>Metode Pembayaran</th>
                    <th>Diterima Oleh</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $row)
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
                @endforeach
            </tbody>
        </table>
    </div>
</div>
