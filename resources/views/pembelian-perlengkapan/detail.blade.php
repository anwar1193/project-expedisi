<div class="modal fade modal-bookmark" id="pembelianPerlengkapan{{ $data->id }}" tabindex="-1" role="dialog"
    aria-labelledby="modalpembelianPerlengkapanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content justify-content-start">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Pembelian Perlengkapan</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-xl-12 xl-20 col-md-7 box-col-12">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane contact-tab-0 tab-content-child fade show active" id="v-pills-user"
                            role="tabpanel" aria-labelledby="v-pills-user-tab">
                            <div class="profile-mail">
                                <div class="email-general mb-2">
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Tanggal Pembelian</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">{{ $data->tanggal_pembelian }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Nama Perlengkapan</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4 text-capitalize">{{ $data->nama_perlengkapan }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Nama Supplier</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">{{ $data->nama_supplier }}</div>
                                    </div>
                                    <div class="row text-start d-flex justify-content-start">
                                        <div class="col-6">Harga</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">{{ number_format($data->harga, 0, '.', ',') }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Jumlah</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">{{ $data->jumlah }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Keterangan</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">{{ $data->keterangan ?? '-' }}</div>
                                    </div>
                                    {{-- <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-4">Nota Pembelian</div>
                                        <div class="col-1">:</div>
                                        <div class="col-6">{!!   $data->nota ? '<a class="btn btn-outline-primary" href="' . $data->nota . '" target="_blank">Link</a>' : '-' !!}</div>
                                    </div> --}}

                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Nota Pembelian</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">
                                            <a href="{{ $data->nota }}" target="_blank">
                                                <i data-feather="link"></i> Link
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>