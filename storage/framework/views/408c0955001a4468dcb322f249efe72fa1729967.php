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

    

    <div class="table-responsive">
        <div class="row py-3">
            <div class="col">
                <label class="form-label" for="">Metode Pembayaran</label>
                <select name="search-metode" id="search-metode" class="form-control js-example-basic-single">
                    <option value="">- Pilih Metode Pembayaran -</option>
                    <?php $__currentLoopData = $metodePembayaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $metode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($metode); ?>"><?php echo e($metode); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col">
                <label class="form-label" for="">Status Pembayaran</label>
                <select name="search-pembayaran" id="search-pembayaran" class="form-control js-example-basic-single">
                    <option value="">- Pilih Status Pembayaran -</option>
                    <?php $__currentLoopData = $statusPembayaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($status['name']); ?>"><?php echo e($status['name']); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col">
                <label class="form-label" for="">Status Pengiriman</label>
                <select name="search-pengiriman" id="search-pengiriman" class="form-control js-example-basic-single">
                    <option value="">- Pilih Status Pengiriman -</option>
                    <?php $__currentLoopData = $statusPengiriman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($status->status_pengiriman); ?>"><?php echo e($status->status_pengiriman); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col">
                <label class="form-label" for="">Customer</label>
                <select name="search-customer" id="search-customer" class="form-control js-example-basic-single">
                    <option value="">- Pilih Customer -</option>
                    <?php $__currentLoopData = $customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($customer->nama); ?>"><?php echo e($customer->nama); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
        <table class="display" id="<?php echo e($tableId); ?>">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Resi</th>
                    <th>Tanggal Transaksi</th>
                    <th>Customer</th>
                    <th>Nama Penerima</th>
                    <th>Kota Tujuan</th>
                    <th>Metode Pembayaran</th>
                    <th>Status Pembayaran</th>
                    <th style="display: none">Status Pengiriman</th>
                    <th>Ongkir</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    
                    <td>
                        <span class="badge badge-danger">
                            <?php echo e($item->no_resi); ?>

                        </span>
                    </td>

                    <td><?php echo e($item->tgl_transaksi); ?></td>
                    <td><?php echo e($item->nama ?? '-'); ?></td>
                    <td><?php echo e($item->nama_penerima); ?></td>
                    <td><?php echo e($item->kota_tujuan); ?></td>
                    <td><?php echo e($item->metode_pembayaran); ?></td>

                    <td>
                        <span class="badge <?php echo e($item->status_pembayaran == 1 ? 'badge-primary' : 'badge-warning'); ?>">
                            <i class="fa <?php echo e($item->status_pembayaran == 1 ? 'fa-check' : 'fa-warning'); ?>"></i>
                            <?php echo e($item->status_pembayaran == 1 ? 'Lunas' : 'Pending'); ?>

                        </span>
                    </td>

                    <td style="display: none"><?php echo e($item->status_pengiriman); ?></td>
                    <td><?php echo e(number_format($item->ongkir, 0, '.', ',')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/laporan/table/data-pengiriman.blade.php ENDPATH**/ ?>