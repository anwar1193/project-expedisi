<?php $__env->startSection('title'); ?>Daftar Gambar Rear Camera
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Daftar Gambar Rear Camera</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item active">Pemanatauan Kamera</li>
		<li class="breadcrumb-item active">Rear Camera</li>
	<?php echo $__env->renderComponent(); ?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-xl-6">
				<div class="card">
					<div class="card-body text-center">
                        <img src="<?php echo e(asset('assets/images/avtar/3.jpg')); ?>" alt="">
                    </div>
				</div>
			</div>
			<div class="col-sm-12 col-xl-6">
				<div class="card">
					<div class="card-body text-center">
                        <img src="<?php echo e(asset('assets/images/avtar/11.jpg')); ?>" alt="">
                    </div>
				</div>
			</div>
			<div class="col-sm-12 col-xl-6">
				<div class="card">
					<div class="card-body text-center">
                        <img src="<?php echo e(asset('assets/images/avtar/16.jpg')); ?>" alt="">
                    </div>
				</div>
			</div>
		</div>
	</div>
	

<?php $__env->startPush('scripts'); ?> 
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/apps/paket1/frontend/resources/views/pemantauan-camera/image/rear.blade.php ENDPATH**/ ?>