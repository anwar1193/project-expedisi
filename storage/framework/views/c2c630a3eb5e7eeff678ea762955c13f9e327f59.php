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
        <a href="<?php echo e(route('laporan.pengeluaran.export-pdf', ['start' => request('start'), 'end' => request('end')])); ?>" class="btn btn-danger" data-bs-toggle="tooltip"
            data-bs-placement="top" title="Cetak PDF">
            <i class="fa fa-file-pdf-o"></i> Cetak PDF
        </a>
    </div>

    <div class="table-responsive">
        <table class="display" id="<?php echo e($tableId); ?>">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Pengeluaran</th>
                    <th>Keterangan</th>
                    <th>Jumlah Pembayaran</th>
                    <th>Yang Melakukan Pembayaran</th>
                    <th>Yang Menerima Pembayaran</th>
                    <th>Metode Pembayaran</th>
                    <th>Status Pengeluaran</th>
                    <th>Jenis Pengeluaran</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($item->tgl_pengeluaran); ?></td>
                    <td><?php echo e($item->keterangan); ?></td>
                    <td><?php echo e(number_format($item->jumlah_pembayaran, 0, ',', '.')); ?></td>
                    <td><?php echo e($item->yang_membayar); ?></td>
                    <td><?php echo e($item->yang_menerima); ?></td>
                    <td><?php echo e($item->metode_pembayaran); ?></td>
                    <td><?php echo e($item->status_pengeluaran == 1 ? 'Disetujui' : 'Pending'); ?></td>
                    <td><?php echo e($item->jenis_pengeluaran); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php /**PATH /Users/munawarahmad/Documents/Applications/projectku/frontend/resources/views/laporan/table/data-pengeluaran.blade.php ENDPATH**/ ?>