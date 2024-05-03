<div class="modal fade" id="statusPembayaran<?php echo e($data->id); ?>" tabindex="-1" role="dialog" aria-labelledby="statusPembayaranLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Status Pembayaran</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form theme-form" method="POST" action="<?php echo e(route('data-pengiriman.status')); ?>">
            <?php echo csrf_field(); ?>
            <input type="text" name="id" value="<?php echo e($data->id); ?>" hidden>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="">Status Pembayaran</label>
                                <select name="status_pembayaran" id="status_pembayaran" class="form-control <?php $__errorArgs = ['status_pembayaran'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                    <option value="1" <?php echo e($data->status_pembayaran == 1 ? 'selected' : NULL); ?>>Lunas</option>
                                    <option value="2" <?php echo e($data->status_pembayaran == 2 ? 'selected' : NULL); ?>>Pending</option>
                                </select>

                                <?php $__errorArgs = ['status_pembayaran'];
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
                    <button class="btn btn-primary text-white" type="submit">Simpan Perubahan</button>
                    <button class="btn btn-light  text-white" type="button" data-bs-dismiss="modal">Kembali</button>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/data-pengiriman/status-pembayaran.blade.php ENDPATH**/ ?>