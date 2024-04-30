<?php $__env->startSection('title'); ?>Daftar Gambar Front Camera
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Daftar Gambar Front Camera</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item active">Pemanatauan Kamera</li>
		<li class="breadcrumb-item active">Front Camera</li>
	<?php echo $__env->renderComponent(); ?>

	<div class="container-fluid">
		<div class="row mb-3">
			<div class="d-flex justify-content-end">
				<button class="btn btn-light col-12 col-sm-12 col-md-4 col-xl-3" onclick="history.back()">Kembali</button>
			</div>
		</div>
		<div class="row">
			<?php $__empty_1 = true; $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
			<div class="col-3 col-sm-12 col-md-4 col-xl-3 mb-3">
				<img src="<?php echo e(asset('storage/front-camera/'.$data->foto)); ?>" alt="<?php echo e($data->foto); ?>" width="250px">
			</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
			<div class="col-sm-12 col-xl-12">
				<div class="card">
					<div class="card-header text-center">
						Tidak Ada Gambar
					</div>
				</div>
			</div>
			<?php endif; ?> 
		</div>
	</div>
	

<?php $__env->startPush('scripts'); ?> 
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/apps/paket1/frontend/resources/views/pemantauan-camera/image/front.blade.php ENDPATH**/ ?>