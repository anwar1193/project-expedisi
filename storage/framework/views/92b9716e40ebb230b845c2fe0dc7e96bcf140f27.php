<?php $__env->startSection('title'); ?>Tambah Pembelian Perlengkapan
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Pembelian Perlengkapan</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item active"><a href="<?php echo e(route('pembelian-perlengkapan')); ?>">Pembelian Perlengkapan</a></li>
        <li class="breadcrumb-item active">Tambah</li>
	<?php echo $__env->renderComponent(); ?>
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Form Pembelian Perlengkapan</h5>
					</div>
					<form class="form theme-form" method="POST" action="<?php echo e(route('pembelian-perlengkapan.store')); ?>">
                        <?php echo csrf_field(); ?>
						<div class="card-body">
							
							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Nama Perlengkapan</label>
										<select name="id_perlengkapan" id="id_perlengkapan" class="form-control <?php $__errorArgs = ['id_perlengkapan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
											<option value="">- Pilih Nama Perlengkapan -</option>
											<?php $__currentLoopData = $perlengkapans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perlengkapan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($perlengkapan->id); ?>"><?php echo e($perlengkapan->nama_perlengkapan); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>

										<?php $__errorArgs = ['id_perlengkapan'];
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
							
							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Nama Supplier</label>
										<select name="id_supplier" id="id_supplier" class="form-control <?php $__errorArgs = ['id_supplier'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
											<option value="">- Pilih Nama Supplier -</option>
											<?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($supplier->id); ?>"><?php echo e($supplier->nama_supplier); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>

										<?php $__errorArgs = ['id_perlengkapan'];
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
                            
                            <div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Jumlah</label>
										<input class="form-control <?php $__errorArgs = ['jumlah'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" name="jumlah" autocomplete="off" value="<?php echo e(old('jumlah')); ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />

										<?php $__errorArgs = ['jumlah'];
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

							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Harga Total</label>
										<input class="form-control <?php $__errorArgs = ['harga'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" name="harga" autocomplete="off" value="<?php echo e(old('harga')); ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />

										<?php $__errorArgs = ['harga'];
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

                            <div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Keterangan</label>
										<input class="form-control <?php $__errorArgs = ['keterangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" name="keterangan" maxlength="255" autocomplete="off" value="<?php echo e(old('keterangan')); ?>"/>

										<?php $__errorArgs = ['keterangan'];
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
                            
							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Nota Pembelian</label>
										<textarea class="form-control <?php $__errorArgs = ['nota'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" cols="100" rows="5" name="nota"><?php echo e(old('nota')); ?></textarea>

										<?php $__errorArgs = ['nota'];
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
							<button class="btn btn-primary" type="submit">Simpan Data</button>
							<a href="<?php echo e(route('pembelian-perlengkapan')); ?>" class="btn btn-light">Kembali</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	
	<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>
	<script>
		document.addEventListener('input', function (e) {
			if (e.target.name === 'harga') {
				const typedValue = e.target.value;
				const formattedValue = new Intl.NumberFormat('id-ID').format(typedValue);
				const displayElement = e.target.parentNode.querySelector('.typed-value');
				
				if (displayElement) {
					displayElement.innerHTML = 'Number Format: <strong>RP. ' + formattedValue + '</strong>';
				} else {
					const newDisplayElement = document.createElement('div');
					newDisplayElement.className = 'typed-value';
					newDisplayElement.innerHTML = 'Number Format: <strong>RP. ' + formattedValue + '</strong>';
					e.target.parentNode.appendChild(newDisplayElement);
				}
			}
		});
	</script>
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/pembelian-perlengkapan/create.blade.php ENDPATH**/ ?>