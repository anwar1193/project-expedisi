<div class="modal fade" id="switchModal<?php echo e($data->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form theme-form" method="POST" action="<?php echo e(route('obd-switch-engine')); ?>">
                <?php echo csrf_field(); ?>
                <input type="text" name="car_id" value="<?php echo e($data->car_id); ?>" hidden>
                <div class="modal-body">
                    <p>Apakah Anda Yakin Ingin <?php echo e($data->engine_status == 0 ? "Menghidupkan" : "Mematikan"); ?> Mesin Mobil <?php echo e($data->cars_merk); ?> Dengan Nopol <?php echo e($data->nopol); ?></p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary text-white" type="submit" >Ya</button>
                    <button class="btn btn-light text-white" type="button" data-bs-dismiss="modal">Tidak</button>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH /Users/munawarahmad/Documents/Applications/projectku/frontend/resources/views/obd-tracker/component/modal-switch.blade.php ENDPATH**/ ?>