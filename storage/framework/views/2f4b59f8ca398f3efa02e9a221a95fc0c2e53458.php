<div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="modalImportLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Data Pengiriman</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form theme-form" enctype="multipart/form-data" method="POST" action="<?php echo e(route('data-pengiriman.konfimasi-excel')); ?>">
            <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <div class="form-group">
                                    <input type="file" name="file" id="file" required>
                                </div>

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
                    <button class="btn btn-light  text-white" type="button" data-bs-dismiss="modal">Kembali</button>
                    
                    <a href="excel_format/DataPengiriman.xlsx" class="btn btn-warning">Download Format</a>
                    <button class="btn btn-primary text-white" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div><?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/data-pengiriman/modal-import.blade.php ENDPATH**/ ?>