<?php $__env->startSection('title'); ?>Detail Surveilance Car
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Surveilance Car</h3>
		<?php $__env->endSlot(); ?>
        <li class="breadcrumb-item active"><a href="<?php echo e(route('surveilance-car')); ?>">Surveilance Car</a></li>
        <li class="breadcrumb-item active">Detail</li>
	<?php echo $__env->renderComponent(); ?>
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					
                    <table class="table">
                        <tr>
                            <th>Nomor Polisi</th>
                            <th class="text-center">:</th>
                            <td><?php echo e($surveilance_car->nopol); ?></td>
                        </tr>

                        <tr>
                            <th>Warna</th>
                            <th class="text-center">:</th>
                            <td><?php echo e($surveilance_car->warna); ?></td>
                        </tr>

                        <tr>
                            <th>Merk</th>
                            <th class="text-center">:</th>
                            <td><?php echo e($surveilance_car->merk); ?></td>
                        </tr>

                        <tr>
                            <th>Kapasitas</th>
                            <th class="text-center">:</th>
                            <td><?php echo e($surveilance_car->kapasitas); ?></td>
                        </tr>

                        <tr>
                            <th>Transmisi</th>
                            <th class="text-center">:</th>
                            <td><?php echo e($surveilance_car->transmisi); ?></td>
                        </tr>

                        <tr>
                            <th>Bahan Bakar</th>
                            <th class="text-center">:</th>
                            <td><?php echo e($surveilance_car->bahan_bakar); ?></td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <th class="text-center">:</th>
                            <td><?php echo e($surveilance_car->status); ?></td>
                        </tr>

                        <tr>
                            <th>Kondisi</th>
                            <th class="text-center">:</th>
                            <td><?php echo e($surveilance_car->kondisi); ?></td>
                        </tr>

                        <tr>
                            <th>Foto</th>
                            <th class="text-center">:</th>
                            <td>
                                <img src="<?php echo e(asset('storage/surveilance-car/'.$surveilance_car->foto)); ?>" alt="" width="200px" class="img-fluid mt-2">
                            </td>
                        </tr>

                    </table>

                    <div class="card-footer text-end">
                        <a href="<?php echo e(route('surveilance-car')); ?>" class="btn btn-light">Kembali</a>
                        
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
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/apps/paket1/frontend/resources/views/surveilance-car/detail.blade.php ENDPATH**/ ?>