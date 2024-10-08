<div class="modal fade modal-bookmark" id="modalDataPemasukkan{{ $data->id }}" tabindex="-1" role="dialog"
    aria-labelledby="modalDataPengirimanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content justify-content-start">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Data Pembayaran</h5>
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
                                        <div class="col-6">Tanggal Pemasukkan</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">{{ $data->tgl_pemasukkan }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Kategori</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">{{ $data->kategori }}</div>
                                    </div>
                                    @if ($data->kategori == 'barang')
                                        <div class="row d-flex py-1 text-start justify-content-start">
                                            <div class="col-6">Jumlah Barang</div>
                                            <div class="col-2">:</div>
                                            <div class="col-4">{{ $data->jumlah_barang }}</div>
                                        </div>
                                    @endif
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Modal</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">{{ $data->modal }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Bukti Pembayaran</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">
                                            <img src="{{ asset('storage/data-pemasukkan/'.$data->bukti_pembayaran) }}" alt="" width="200px" class="img-fluid mt-2">
                                        </div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Sumber Pembayaran</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4 text-capitalize">{{ $data->sumber_pembayaran }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Metode Pembayaran</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4 text-capitalize">{{ $data->metode_pembayaran }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Jumlah Pemasukan</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">{{ number_format($data->jumlah_pemasukkan, 0, '.', ',') }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Diterima Oleh</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">{{ $data->diterima_oleh }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Keterangan Tambahan</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">{{ $data->keterangan_tambahan }}</div>
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