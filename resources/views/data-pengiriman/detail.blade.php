<div class="modal fade modal-bookmark" id="modalDataPengiriman{{ $data->id }}" tabindex="-1" role="dialog"
    aria-labelledby="modalDataPengirimanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content justify-content-center">
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
                                <div class="media d-flex justify-content-center">
                                    <img class="img-fluid rounded m-r-20 update_img_0"
                                        src="{{ asset('storage/surveilance-car/'.$data->foto) }}"
                                        alt="{{$data->merk}}" width="200px"/>
                                </div>
                                <div class="email-general mt-3">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-6">No Resi</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">{{ $data->no_resi }}</div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-6">Tanggal Transaksi</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">{{ $data->tgl_transaksi }}</div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-6">Nama Pengirim</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">{{ $data->nama_pengirim }}</div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-6">Kota Tujuan</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">{{ $data->kota_tujuan }}</div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-6">No HP Pengirim</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">{{ $data->no_hp_pengirim }}</div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-6">No HP Penerima</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">{{ $data->no_hp_penerima }}</div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-6">Berat Barang</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">{{ $data->berat_barang }}</div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-6">Ongkir</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">{{ $data->ongkir }}</div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-6">Komisi</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">{{ $data->komisi }}</div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-6">Status Pembayaran</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">{{ $data->status_pembayaran }}</div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-6">Metode Pembayaran</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4 text-capitalize">{{ $data->metode_pembayaran }}</div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-6">Bukti Pembayaran</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">{{ $data->bukti_pembayaran }}</div>
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