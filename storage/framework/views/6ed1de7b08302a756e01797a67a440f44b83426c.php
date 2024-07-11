<div class="card-body">
    <div class="table-responsive">
        <div class="table-responsive">
            <table class="display" id=<?php echo e($tableId); ?>>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>No Invoice</th>
                        <th>Tanggal Cetak</th>
                        <th>Kode Customer</th>
                        <th>Nama Customer</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $invoice; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($data->invoice_no); ?></td>
                            <td><?php echo e(formatTanggalIndonesia($data->created_at)); ?></td>
                            <td><?php echo e($data->kode_customer); ?></td>
                            <td><?php echo e($data->nama); ?></td>
                            <td>
                                <form method="GET" action="<?php echo e(route('invoices.generate')); ?>">
                                    <button class="btn btn-warning" type="submit" name="customer" value="<?php echo e($data->id); ?>">Detail</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center">
                            <p class="fw-semibold">Belum Ada Data Invoice</p>
                        </td>
                    </tr>
                    <?php endif; ?> 
                </tbody>
            </table>
        </div>
        
    </div>
</div><?php /**PATH /Users/munawarahmad/Documents/Applications/projectku/project-expedisi/resources/views/customers/component/invoice.blade.php ENDPATH**/ ?>