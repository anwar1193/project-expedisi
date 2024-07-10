<div class="modal fade fade bd-example-modal-lg" id="modalStatusPengiriman" tabindex="-1" role="dialog" aria-labelledby="statusPengirimanLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">List Status Pengiriman</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body d-flex justify-content-center">
                <div class="row">
                    <div class="col">
                        <div class="table-responsive table-bordered">
                            <table class="display">
                                <thead class="text-center">
                                    <tr>
                                        <th width="10%">No</th>
                                        <th width="30%">Status Pengiriman</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="p-2"><?php echo e($loop->iteration); ?></td>
                                            <td class="p-2"><?php echo e($data->status_pengiriman); ?></td>
                                            <td class="p-2"><?php echo e($data->keterangan_pengiriman); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH /Users/munawarahmad/Documents/Applications/projectku/project-expedisi/resources/views/data-pengiriman/status-pengiriman.blade.php ENDPATH**/ ?>