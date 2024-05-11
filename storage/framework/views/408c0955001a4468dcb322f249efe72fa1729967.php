<div class="card-body">
    <?php if(session()->has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil <i class="fa fa-info-circle"></i></strong>
        <?php echo e(session('success')); ?>

        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <?php if(session()->has('delete')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Berhasil <i class="fa fa-info-circle"></i></strong>
        <?php echo e(session('delete')); ?>

        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <?php if(session()->has('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Gagal <i class="fa fa-info-circle"></i></strong>
        <?php echo e(session('error')); ?>

        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <strong>Failed <i class="fa fa-info-circle"></i></strong>
        <?php echo e($error); ?>

        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
        <br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>

    <div class="tombol-export mb-3">
        <a href="<?php echo e(route('laporan.pengiriman.export-pdf', ['start' => request('start'), 'end' => request('end')])); ?>" class="btn btn-danger" data-bs-toggle="tooltip"
            data-bs-placement="top" title="Cetak PDF">
            <i class="fa fa-file-pdf-o"></i> Cetak PDF
        </a>
    </div>

    <div class="table-responsive">
        <table class="display" id="<?php echo e($tableId); ?>">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Resi</th>
                    <th>Nama Penerima</th>
                    <th>No HP Penerima</th>
                    <th>Kota Tujuan</th>
                    <th>Status Pembayaran</th>
                    <th>Metode Pembayaran</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($item->no_resi); ?></td>
                    <td><?php echo e($item->nama_penerima); ?></td>
                    <td><?php echo e($item->no_hp_penerima); ?></td>
                    <td><?php echo e($item->kota_tujuan); ?></td>
                    <td><?php echo e($item->status_pembayaran == 1 ? 'Lunas' : 'Pending'); ?></td>
                    <td><?php echo e($item->metode_pembayaran); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/laporan/table/data-pengiriman.blade.php ENDPATH**/ ?>