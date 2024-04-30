<?php $__env->startSection('title'); ?>Detail Perangkat
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Perangkat</h3>
		<?php $__env->endSlot(); ?>
        <li class="breadcrumb-item active"><a href="<?php echo e(route('perangkat')); ?>">Perangkat</a></li>
        <li class="breadcrumb-item active">Detail</li>
	<?php echo $__env->renderComponent(); ?>
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					
                    <table class="table">
                        <tr>
                            <th>Kode Perangkat</th>
                            <th class="text-center">:</th>
                            <td><?php echo e($perangkat->kode_perangkat); ?></td>
                        </tr>

                        <tr>
                            <th>Nama Perangkat</th>
                            <th class="text-center">:</th>
                            <td><?php echo e($perangkat->nama_perangkat); ?></td>
                        </tr>

                        <tr>
                            <th>Jenis Perangkat</th>
                            <th class="text-center">:</th>
                            <td><?php echo e($perangkat->nama_jenis); ?></td>
                        </tr>

                        <tr>
                            <th>Serial Number</th>
                            <th class="text-center">:</th>
                            <td><?php echo e($perangkat->serial_number); ?></td>
                        </tr>

                        <tr>
                            <th>Kondisi Perangkat</th>
                            <th class="text-center">:</th>
                            <td><?php echo e($perangkat->kondisi_perangkat); ?></td>
                        </tr>

                        <tr>
                            <th>Foto</th>
                            <th class="text-center">:</th>
                            <td>
                                <img src="<?php echo e(asset('storage/perangkat/'.$perangkat->foto)); ?>" alt="" width="200px" class="img-fluid mt-2">
                            </td>
                        </tr>

                    </table>

                    <div class="card-footer text-end">
                        <a href="<?php echo e(route('perangkat')); ?>" class="btn btn-light">Kembali</a>
                        
                    </div>

				</div>
			</div>
		</div>
	</div>
	
	
	<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/apps/paket1/frontend/resources/views/perangkat/detail.blade.php ENDPATH**/ ?>