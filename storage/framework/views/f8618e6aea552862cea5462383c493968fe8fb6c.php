<?php $__env->startSection('title'); ?>Konversi Point
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Konversi Point</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item active"><a href="<?php echo e(route('konversi-point')); ?>">Konversi Point</a></li>
	<?php echo $__env->renderComponent(); ?>
	
	<div class="container-fluid">
		<div class="row d-flex justify-content-center">
			<div class="col-sm-12 col-xl-6">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Edit Konversi Point</h5>
					</div>
                    <form class="needs-validation" method="POST" action="<?php echo e(route('konversi-point.update')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="card-body megaoptions-border-space-sm">
                            <?php if(session()->has('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Berhasil <i class="fa fa-info-circle"></i></strong> 
                                    <?php echo e(session('success')); ?>

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
                                <input type="text" name="id" value="<?php echo e($konversiPoints->id); ?>" hidden>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="form-label" for="nominal">Nominal Untuk 1 Point</label>
                                        <input class="form-control <?php $__errorArgs = ['nominal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="nominal" type="text" name="nominal" value="<?php echo e(old('nominal', $konversiPoints->nominal)); ?>" />
                                        <div id="nominal" class="form-text text-danger">*Default 1 Point = Rp. 1000</div>

                                        <?php $__errorArgs = ['nama'];
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
                        <div class="card-footer text-end">
                            <button class="btn btn-primary m-r-15" type="submit">Update</button>
                        </div>
                    </form>

				</div>
			</div>
		</div>
	</div>
	
	
	<?php $__env->startPush('scripts'); ?>
	<script src="<?php echo e(asset('assets/js/height-equal.js')); ?>"></script>
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/munawarahmad/Documents/Applications/projectku/frontend/resources/views/konversi-point/index.blade.php ENDPATH**/ ?>