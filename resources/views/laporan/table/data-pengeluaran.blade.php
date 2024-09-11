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
        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#pengeluaranModal">
            <i class="fa fa-check-square"></i> Export
        </button>

        @include('laporan.modal-export.pengeluaran-modal')
    </div>

    <div class="table-responsive">
        <div class="row py-3">
            <div class="col">
                <label class="form-label" for="">Pembayar</label>
                <input class="form-control" type="text" name="pembayar" id="search-pembayar" placeholder="Masukan Yang Melakukan Pembayaran"/>
            </div>
            <div class="col">
                <label class="form-label" for="">Penerima</label>
                <input class="form-control" type="text" name="penerima" id="search-penerima" placeholder="Masukan Yang Menerima Pembayaran"/>
            </div>
            <div class="col">
                <label class="form-label" for="">Metode Pembayaran</label>
                <select name="search-metode-pengeluaran" id="search-metode-pengeluaran" class="form-control js-example-basic-single">
                    <option value="">- Pilih Metode Pembayaran -</option>
                    @foreach ($metodePembayaran as $metode)
                        <option value="{{ $metode->metode }}">{{ $metode->metode }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <table class="display" id="{{ $tableId }}">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Pengeluaran</th>
                    <th>Keterangan</th>
                    <th>Jumlah Pembayaran</th>
                    <th>Yang Melakukan Pembayaran</th>
                    <th>Yang Menerima Pembayaran</th>
                    <th>Metode Pembayaran</th>
                    <th>Status Pengeluaran</th>
                    <th>Jenis Pengeluaran</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->tgl_pengeluaran }}</td>
                    <td>{{ $item->keterangan }}</td>
                    <td>{{ number_format($item->jumlah_pembayaran, 0, ',', '.') }}</td>
                    <td>{{ $item->yang_membayar }}</td>
                    <td>{{ $item->yang_menerima }}</td>
                    <td>{{ $item->metode_pembayaran }}</td>
                    <td>{{ $item->status_pengeluaran == 1 ? 'Disetujui' : 'Pending' }}</td>
                    <td>{{ $item->kategori }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
