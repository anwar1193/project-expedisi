<!-- resources/views/components/modal.blade.php -->

<div class="modal fade modal-bookmark" id="exampleModal<?php echo e($item->id); ?>" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content justify-content-center">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Armada</h5>
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
                                        src="<?php echo e(asset('storage/surveilance-car/'.$item->foto)); ?>"
                                        alt="<?php echo e($item->merk); ?>" width="200px"/>
                                </div>
                                <div class="email-general mt-3">
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-4">Merk</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e($item->merk); ?></div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-4">Nomor Polisi</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e($item->nopol); ?></div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-4">Warna</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e($item->warna); ?></div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-4">Kapasitas</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e($item->kapasitas); ?></div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-4">Status</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e($item->status); ?></div>
                                    </div>
                                    <div class="row d-flex justify-content-center">
                                        <div class="col-4">Kondisi</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e($item->kondisi); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /www/apps/paket1/frontend/resources/views/components/modal.blade.php ENDPATH**/ ?>