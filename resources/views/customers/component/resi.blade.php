<div class="card-body"></div>
<div class="row ps-3">
    <div class="col">
        <div class="card d-flex justify-content-center">
            <div class="card-header pb-0 text-center">
                <h6 class="card-title mb-0">Masukan Nomor Resi Anda</h6>
                <div class="card-options">
                    <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body text-center">
                <form id="search-form" class="form theme-form" method="GET" action="{{ route('dashboard.customer') }}">
                    <div class="d-flex justify-content-center">
                        <div class="px-2">
                            <input class="col-12" type="text" name="no_resi" id="no_resi">
                        </div>
                        <div class="ps-2">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <div id="resi-result" class="card-footer px-5">
                @if ($data)
                    <div class="text-center mb-3">
                        <h5>Hasil Pencarian</h5>
                    </div>
                    <div class="row d-flex py-1 text-start justify-content-center">
                        <div class="col-6">No Resi</div>
                        <div class="col-2">:</div>
                        <div class="col-4">{{ $data->no_resi }}</div>
                    </div>
                    <div class="row text-start d-flex justify-content-end">
                        <div class="col-6">Tanggal Transaksi</div>
                        <div class="col-2">:</div>
                        <div class="col-4">{{ $data->tgl_transaksi }}</div>
                    </div>
                    <div class="row d-flex py-1 text-start justify-content-center">
                        <div class="col-6">Nama Pengirim</div>
                        <div class="col-2">:</div>
                        <div class="col-4">{{ $data->nama_pengirim }}</div>
                    </div>
                    <div class="row d-flex py-1 text-start justify-content-center">
                        <div class="col-6">Nama Penerima</div>
                        <div class="col-2">:</div>
                        <div class="col-4">{{ $data->nama_penerima }}</div>
                    </div>
                    <div class="row d-flex py-1 text-start justify-content-center">
                        <div class="col-6">Status Pengiriman</div>
                        <div class="col-2">:</div>
                        <div class="col-4">{{ $data->status_pengiriman }} - {{ $data->keterangan_pengiriman }}</div>
                    </div>
                    <div class="text-center mb-3">
                        <a href="{{ route('dashboard.customer') }}" class="btn btn-md btn-secondary" title="Reset"><i class="fa fa-refresh"></i> Reset</a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>