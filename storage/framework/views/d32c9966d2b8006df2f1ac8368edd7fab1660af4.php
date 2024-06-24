<div class="modal fade modal-bookmark" id="modalMerchandise<?php echo e($data->id); ?>" tabindex="-1" role="dialog"
    aria-labelledby="modalMerchandiseLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content justify-content-start">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Merchandise</h5>
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
                                        <div class="col-6">Nama Merchandise</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4 text-capitalize"><?php echo e($data->nama); ?></div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Nilai</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e(number_format($data->nilai, 0, '.', ',')); ?></div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Gambar</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4">
                                            <img src="<?php echo e(asset('storage/merchandise/'.$data->gambar)); ?>" alt="" width="200px" class="img-fluid mt-2">
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
</div><?php /**PATH /Users/munawarahmad/Documents/Applications/projectku/frontend/resources/views/merchandise/detail.blade.php ENDPATH**/ ?>