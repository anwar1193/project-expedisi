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
        <div class="row py-3">
            <div class="col">
                <label class="form-label" for="">Metode Pembayaran</label>
                <select name="search-metode" id="search-metode" class="form-control js-example-basic-single">
                    <option value="">- Pilih Metode Pembayaran -</option>
                    @foreach ($metodePembayaran as $metode)
                        <option value="{{ $metode->metode }}">{{ $metode->metode }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label class="form-label" for="">Status Pembayaran</label>
                <select name="search-pembayaran" id="search-pembayaran" class="form-control js-example-basic-single">
                    <option value="">- Pilih Status Pembayaran -</option>
                    @foreach ($statusPembayaran as $status)
                        <option value="{{ $status['name'] }}">{{ $status['name'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label class="form-label" for="">Status Pengiriman</label>
                <select name="search-pengiriman" id="search-pengiriman" class="form-control js-example-basic-single">
                    <option value="">- Pilih Status Pengiriman -</option>
                    @foreach ($statusPengiriman as $status)
                        <option value="{{ $status->status_pengiriman }}">{{ $status->status_pengiriman }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col">
                <label class="form-label" for="">Customer</label>
                <select name="search-customer" id="search-customer" class="form-control js-example-basic-single">
                    <option value="">- Pilih Customer -</option>
                    @foreach ($customer as $customer)
                        <option value="{{ $customer->nama }}">{{ $customer->nama }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <table class="display" id="{{ $tableId }}">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Resi</th>
                    <th>Tanggal Transaksi</th>
                    <th>Customer</th>
                    <th>Nama Penerima</th>
                    <th>Kota Tujuan</th>
                    <th>Metode Pembayaran</th>
                    <th>Status Pembayaran</th>
                    <th style="display: none">Status Pengiriman</th>
                    <th>Ongkir</th>
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
                    <td>{{ $item->nama ?? '-' }}</td>
                    <td>{{ $item->nama_penerima }}</td>
                    <td>{{ $item->kota_tujuan }}</td>
                    <td>{{ $item->metode_pembayaran }}</td>

                    <td>
                        <span class="badge {{ $item->status_pembayaran == 1 ? 'badge-primary' : 'badge-warning' }}">
                            <i class="fa {{ $item->status_pembayaran == 1 ? 'fa-check' : 'fa-warning' }}"></i>
                            {{ $item->status_pembayaran == 1 ? 'Lunas' : 'Pending'; }}
                        </span>
                    </td>

                    <td style="display: none">{{ $item->status_pengiriman }}</td>
                    <td>{{ number_format($item->ongkir, 0, '.', ',') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
