<div class="modal fade" id="lepasModal<?php echo e($data->id); ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Daftar Armada</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form theme-form" method="POST" action="<?php echo e(route('obd-disconnect-car')); ?>">
            <?php echo csrf_field(); ?>
            <input type="text" name="id" value="<?php echo e($data->id); ?>" hidden>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="">Armada</label>
                                <select name="car_id" id="status" class="form-control <?php $__errorArgs = ['car_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="">
                                        <?php echo e($data->cars_merk); ?> (<?php echo e($data->nopol); ?>)
                                    </option>
                                </select>
                                <?php $__errorArgs = ['car_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="text-danger">
                                    <?php echo e($message); ?>

                                </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary text-white" type="submit">Lepaskan</button>
                    <button class="btn btn-light  text-white" type="button" data-bs-dismiss="modal">Kembali</button>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH /www/apps/paket1/frontend/resources/views/obd-tracker/component/form-lepaskan.blade.php ENDPATH**/ ?>