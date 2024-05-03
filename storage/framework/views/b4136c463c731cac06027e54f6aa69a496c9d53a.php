<div class="modal fade modal-bookmark" id="modalSupplier<?php echo e($data->id); ?>" tabindex="-1" role="dialog"
    aria-labelledby="modalSupplierLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content justify-content-start">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Data Supplier</h5>
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
                                        <div class="col-6">Nama Supplier</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e($data->nama_supplier); ?></div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Keterangan Barang</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4 text-capitalize"><?php echo e($data->keterangan_barang); ?></div>
                                    </div>
                                    <div class="row text-start d-flex justify-content-start">
                                        <div class="col-6">Harga</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e($data->harga); ?></div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">Jumlah Barang</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e($data->jumlah_barang); ?></div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-6">No Hp</div>
                                        <div class="col-2">:</div>
                                        <div class="col-4"><?php echo e($data->nomor_hp); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/supplier/detail.blade.php ENDPATH**/ ?>