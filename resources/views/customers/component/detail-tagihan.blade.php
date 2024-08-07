<div class="modal fade modal-bookmark" id="modalDataPengiriman{{ $data->id }}" tabindex="-1" role="dialog"
    aria-labelledby="modalDataPengirimanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content justify-content-start">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Data Pengiriman</h5>
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
                                        <div class="col-4">Status Approve</div>
                                        <div class="col-2">:</div>
                                        <div class="col-6">
                                            <span class="badge {{ $data->status_pembayaran == 1 ? 'badge-primary' : 'badge-warning' }}">
                                                <i class="fa {{ $data->status_pembayaran == 1 ? 'fa-check' : 'fa-warning' }}"></i>
                                                {{ $data->status_pembayaran == 1 ? 'Approve' : 'Pending'; }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-4">Metode Pembayaran</div>
                                        <div class="col-2">:</div>
                                        <div class="col-6 text-capitalize">{{ $data->metode_pembayaran }} {{ $data->bank }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-4">No Resi</div>
                                        <div class="col-2">:</div>
                                        <div class="col-6">{{ $data->no_resi }}</div>
                                    </div>
                                    <div class="row text-start d-flex justify-content-start">
                                        <div class="col-4">Tanggal Transaksi</div>
                                        <div class="col-2">:</div>
                                        <div class="col-6">{{ $data->tgl_transaksi }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-4">Nama Pengirim</div>
                                        <div class="col-2">:</div>
                                        <div class="col-6">{{ $data->nama_pengirim }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-4">Nama Penerima</div>
                                        <div class="col-2">:</div>
                                        <div class="col-6">{{ $data->nama_penerima }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-4">Kota Tujuan</div>
                                        <div class="col-2">:</div>
                                        <div class="col-6">{{ $data->kota_tujuan }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-4">No HP Pengirim</div>
                                        <div class="col-2">:</div>
                                        <div class="col-6">{{ $data->no_hp_pengirim }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-4">No HP Penerima</div>
                                        <div class="col-2">:</div>
                                        <div class="col-6">{{ $data->no_hp_penerima }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-4">Berat Barang</div>
                                        <div class="col-2">:</div>
                                        <div class="col-6">{{ $data->berat_barang }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-4">Ongkir</div>
                                        <div class="col-2">:</div>
                                        <div class="col-6">{{ number_format($data->ongkir, 0, '.', ',') }}</div>
                                    </div>
                                    @if (!isCustomer())
                                        <div class="row d-flex py-1 text-start justify-content-start">
                                            <div class="col-4">Komisi</div>
                                            <div class="col-2">:</div>
                                            <div class="col-6">{{ number_format($data->komisi, 0, '.', ',') }}</div>
                                        </div>                                    
                                    @endif
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-4">Jenis Pengiriman</div>
                                        <div class="col-2">:</div>
                                        <div class="col-6">{{ $data->jenis_pengiriman }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-4">Bawa Sendiri</div>
                                        <div class="col-2">:</div>
                                        <div class="col-6">{{ $data->bawa_sendiri }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-4">Status Pengiriman</div>
                                        <div class="col-2">:</div>
                                        <div class="col-6">{{ $data->status_pengiriman }}</div>
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