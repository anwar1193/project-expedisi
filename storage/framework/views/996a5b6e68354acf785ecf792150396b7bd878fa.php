<?php $__env->startSection('title'); ?>Penukaran Point
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Penukaran Point</h3>
		<?php $__env->endSlot(); ?>
        <li class="breadcrumb-item active">Penukaran Point</li>
	<?php echo $__env->renderComponent(); ?>
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
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

						<h5>Tukar Point</h5>
					</div>
					<form class="form theme-form" method="GET" action="<?php echo e(route('penukaran-point')); ?>">
                        <?php echo csrf_field(); ?>
						<div class="card-body">
							
							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Pilih Customer</label>
										
										<select name="id" id="id" class="form-control <?php $__errorArgs = ['customer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
											<option value="">- Pilih Customer -</option>
											<?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($item->id); ?>" <?php echo e(old('nama') == $item->nama ? 'selected' : ''); ?>>
													<?php echo e($item->kode_customer); ?> - <?php echo e($item->nama); ?>

												</option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>

										<?php $__errorArgs = ['customer'];
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

						</div>
						<div class="card-footer text-end">
							<button class="btn btn-primary" type="submit">Tampilkan</button>
							<a href="<?php echo e(route('penukaran-point')); ?>" class="btn btn-secondary">Reset</a>
						</div>
					</form>
				</div>
			</div>
		</div>
        <?php if(request('id')): ?>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header fw-bold pb-0">Data Customer Terpilih</div>
                    <div class="card-body">
                        <div class="row invo-profile py-2" style="border: 0.5px solid; width: 70%">
                            <div class="col-xl-8">
                                <div class="text-xl-start" id="project">
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-4 col-lg-4">Kode Customer</div>
                                        <div class="col-1 col-lg-2">:</div>
                                        <div class="col-6 col-lg-6 text-capitalize"><?php echo e($customer->kode_customer); ?></div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-4 col-lg-4">Nama Customer</div>
                                        <div class="col-1 col-lg-2">:</div>
                                        <div class="col-6 col-lg-6 text-capitalize"><?php echo e($customer->nama); ?></div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-4 col-lg-4">Point</div>
                                        <div class="col-1 col-lg-2">:</div>
                                        <div class="col-6 col-lg-6 text-capitalize"><?php echo e($customer->point); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row py-2 my-2 text-center d-flex justify-content-center">
                            <div class="py-3 mb-2 text-start">
                                <h5>Daftar Merchandise</h5>
                            </div>
                            <?php $__currentLoopData = $merchandise; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card px-2 mx-3 text-center" style="width: 18rem;">
                                    <img src="<?php echo e(asset('storage/merchandise/'.$data->gambar)); ?>" style="height: 150px" class="card-img-top" alt="...">
                                    <div class="card-body">
                                    <p class="card-title"><?php echo e($data->nama); ?></p>

                                    <p class="card-text"><?php echo e(number_format($data->nilai, 0, '.', ',')); ?> point</p>

									<form action="<?php echo e(route('proses-penukaran-point')); ?>" method="POST">
										<?php echo csrf_field(); ?>
										<input type="hidden" name="customer_id" value="<?php echo e($customer->id); ?>">
										<input type="hidden" name="marchendise_id" value="<?php echo e($data->id); ?>">

										<button type="submit" class="btn btn-primary">Tukar</button>
									</form>

                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
	</div>
	
	
	<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/penukaran-point/index.blade.php ENDPATH**/ ?>