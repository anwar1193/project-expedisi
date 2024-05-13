<div class="modal fade modal-bookmark" id="modalDataPengiriman<?php echo e($data->id); ?>" tabindex="-1" role="dialog"
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
                                        <div class="col-6">Status Pembayaran</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">
                                            <span class="badge <?php echo e($data->status_pembayaran == 1 ? 'badge-primary' : 'badge-warning'); ?>">
                                                <i class="fa <?php echo e($data->status_pembayaran == 1 ? 'fa-check' : 'fa-warning'); ?>"></i>
                                                <?php echo e($data->status_pembayaran == 1 ? 'Lunas' : 'Pending'); ?>

                                            </span>
                                        </div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Metode Pembayaran</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4 text-capitalize"><?php echo e($data->metode_pembayaran); ?> <?php echo e($data->bank); ?></div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">No Resi</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e($data->no_resi); ?></div>
                                    </div>
                                    <div class="row text-start d-flex justify-content-start">
                                        <div class="col-6">Tanggal Transaksi</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e($data->tgl_transaksi); ?></div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Nama Pengirim</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e($data->nama_pengirim); ?></div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Nama Penerima</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e($data->nama_penerima); ?></div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Kota Tujuan</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e($data->kota_tujuan); ?></div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">No HP Pengirim</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e($data->no_hp_pengirim); ?></div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">No HP Penerima</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e($data->no_hp_penerima); ?></div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Berat Barang</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e($data->berat_barang); ?></div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Ongkir</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e(number_format($data->ongkir, 0, '.', ',')); ?></div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Komisi</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e(number_format($data->komisi, 0, '.', ',')); ?></div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Jenis Pengiriman</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e($data->jenis_pengiriman); ?></div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Bawa Sendiri</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e($data->bawa_sendiri); ?></div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Status Pengiriman</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e($data->status_pengiriman); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /Users/munawarahmad/Documents/Applications/projectku/frontend/resources/views/data-pengiriman/detail.blade.php ENDPATH**/ ?>