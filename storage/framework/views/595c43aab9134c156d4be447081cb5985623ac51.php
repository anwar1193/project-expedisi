<div class="modal fade modal-bookmark" id="modalDataPengiriman<?php echo e($data->id); ?>" tabindex="-1" role="dialog"
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
                                        <div class="col-6">Keterangan</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e($data->keterangan); ?></div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Bukti Pembayaran</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">
                                            <img src="<?php echo e(asset('storage/daftar-pengeluaran/'.$data->bukti_pembayaran)); ?>" alt="" width="200px" class="img-fluid mt-2">
                                        </div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Status Pengeluaran</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">
                                            <span class="badge <?php echo e($data->status_pengeluaran == 1 ? 'badge-primary' : 'badge-warning'); ?>">
                                                <i class="fa <?php echo e($data->status_pengeluaran == 1 ? 'fa-check' : 'fa-warning'); ?>"></i>
                                                <?php echo e($data->status_pengeluaran == 1 ? 'Disetujui' : 'Pending'); ?>

                                            </span>
                                        </div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Yang Melakukan Pembayaran</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4 text-capitalize"><?php echo e($data->yang_membayar); ?></div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Metode Pembayaran</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4 text-capitalize"><?php echo e($data->metode_pembayaran); ?></div>
                                    </div>
                                    <div class="row text-start d-flex justify-content-start">
                                        <div class="col-6">Tanggal Pengeluaran</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e($data->tgl_pengeluaran); ?></div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Jumlah Pembayaran</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e(number_format($data->jumlah_pembayaran, 0, '.', ',')); ?></div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Yang Menerima Pembayaran</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e($data->yang_menerima); ?></div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Jenis Pengeluaran</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e($data->jenis_pengeluaran); ?></div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Keterangan Tambahan</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e($data->keterangan_tambahan); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /Users/munawarahmad/Documents/Applications/projectku/frontend/resources/views/daftar-pengeluaran/detail.blade.php ENDPATH**/ ?>