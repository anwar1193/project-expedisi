<?php $__env->startSection('title'); ?>Tambah Daftar Pengeluaran
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Daftar Pengeluaran</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item active"><a href="<?php echo e(route('daftar-pengeluaran')); ?>">Daftar Pengeluaran</a></li>
        <li class="breadcrumb-item active">Tambah</li>
	<?php echo $__env->renderComponent(); ?>
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Form Daftar Pengeluaran</h5>
					</div>
					<form class="form theme-form" method="POST" action="<?php echo e(route('daftar-pengeluaran.store')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
						<div class="card-body">

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
unset($__errorArgs, $__bag); ?>" type="text" name="keterangan" autocomplete="off" value="<?php echo e(old('keterangan')); ?>"/>

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
										<label class="form-label" for="">Jumlah Pembayaran</label>
										<input class="form-control <?php $__errorArgs = ['jumlah_pembayaran'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="number" name="jumlah_pembayaran" autocomplete="off" value="<?php echo e(old('jumlah_pembayaran')); ?>"/>

										<?php $__errorArgs = ['jumlah_pembayaran'];
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
										<label class="form-label" for="">Yang Menerima Pembayaran</label>
										<input class="form-control <?php $__errorArgs = ['yang_menerima'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" name="yang_menerima" autocomplete="off" value="<?php echo e(old('yang_menerima')); ?>"/>

										<?php $__errorArgs = ['yang_menerima'];
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
										<label class="form-label" for="">Metode Pembayaran</label>
										<select name="metode_pembayaran" id="metode_pembayaran" class="form-control <?php $__errorArgs = ['metode_pembayaran'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
											<option value="">- Pilih Metode Pembayaran -</option>
											<option value="tunai">Tunai</option>
											<option value="transfer">Transfer</option>
										</select>

										<?php $__errorArgs = ['metode_pembayaran'];
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
										<label class="form-label" for="">Jenis Pengeluaran</label>
                                        <select name="jenis_pengeluaran" id="jenis_pengeluaran" class="form-control <?php $__errorArgs = ['jenis_pengeluaran'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
											<option value="">- Pilih Jenis Pengeluaran -</option>
											<?php $__currentLoopData = $jenis_pengeluaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<option value="<?php echo e($jenis->id); ?>"><?php echo e($jenis->jenis_pengeluaran); ?></option>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</select>

										<?php $__errorArgs = ['jenis_pengeluaran'];
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
										<label class="form-label" for="">Keterangan Tambahan</label>
										<input class="form-control <?php $__errorArgs = ['keterangan_tambahan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" name="keterangan_tambahan" autocomplete="off" value="<?php echo e(old('keterangan_tambahan')); ?>" maxlength="255"/>

										<?php $__errorArgs = ['keterangan_tambahan'];
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
									<div class="mb-2">
										<label class="form-label" for="">Bukti Pembayaran</label>
										<input class="form-control <?php $__errorArgs = ['bukti_pembayaran'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="buktiBayar" style="display: block" type="file" width="48" height="48" name="bukti_pembayaran" />
									
										<?php $__errorArgs = ['bukti_pembayaran'];
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
									<div>										
										<input class="form-check-input" id="takeImage" type="checkbox" name="takeImage" />
										<label class="form-check-label" for="takeImage">Ambil Gambar</label>

										<div id="image" style="display:none">
											<div>
												<input type="hidden" id="bukti_pembayaran" name="image">
												<video width="250" height="200" autoplay="true" id="videoElement">
												</video>
												<canvas width="250" height="200" id="canvas"></canvas>
											</div>
										</div>

										<?php $__errorArgs = ['bukti_pembayaran'];
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
							<a href="<?php echo e(route('daftar-pengeluaran')); ?>" class="btn btn-light">Kembali</a>
						</div>
					</form>

					<div class="d-flex ps-3 pb-3 mb-3">
						<div>
							<button class="btn btn-success" id="captureButton">Capture Image</button>
						</div>
						<div>
							<button class="btn btn-warning" id="cancelButton" onclick="cancelCapture()">Cancel Capture</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>
	<script>
		document.addEventListener('input', function (e) {
			if (e.target.name === 'jumlah_pembayaran') {
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

	<script>
		function toggleUserFields() {
			var takeImageCheckbox = document.getElementById('takeImage');
			var image = document.getElementById('image');
			var buktiBayar = document.getElementById('buktiBayar');
			const video = document.querySelector(`#videoElement`);
			const canvas = document.getElementById('canvas');
            const captureButton = document.getElementById('captureButton');
            const cancelButton = document.getElementById('cancelButton');
            const imageInput = document.getElementById('bukti_pembayaran');
		
			if (video && takeImageCheckbox.checked) {
				if (navigator.mediaDevices.getUserMedia) {
					navigator.mediaDevices.getUserMedia({ video: true })
						.then(function (stream) {
							video.srcObject = stream;
						})
						.catch(function (error) {
							console.log("Something went wrong!", error);
						});

					captureButton.addEventListener('click', function() {
						const context = canvas.getContext('2d');
						context.drawImage(video, 0, 0, canvas.width, canvas.height);

						const imgData = canvas.toDataURL('image/png');
						imageInput.value = imgData;
					});
				} else {
					console.log("getUserMedia not supported on your browser!");
				}
			} else {
				video.srcObject = null;
				console.log(`Video element not found!`);
			}

			if (takeImageCheckbox.checked) {
				image.style.display = 'block';
				captureButton.style.display = 'block';
				cancelButton.style.display = 'block';
				buktiBayar.style.display = 'none';
			} else {
				image.style.display = 'none';
				captureButton.style.display = 'none';
				cancelButton.style.display = 'none';
				buktiBayar.style.display = 'block';
			}
		}

		function cancelCapture() {
			const video = document.querySelector(`#videoElement`);
			const imageInput = document.getElementById('bukti_pembayaran');
			const image = document.getElementById('image');
			const captureButton = document.getElementById('captureButton');
			const buktiBayar = document.getElementById('buktiBayar');
			
			video.srcObject = null;
			imageInput.value = '';
			image.style.display = 'none';
			captureButton.style.display = 'none';
			buktiBayar.style.display = 'block';

			const context = canvas.getContext('2d');
    		context.clearRect(0, 0, canvas.width, canvas.height);
		}

		document.getElementById('takeImage').addEventListener('change', toggleUserFields);

		document.addEventListener('DOMContentLoaded', toggleUserFields);
	</script>
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/daftar-pengeluaran/create.blade.php ENDPATH**/ ?>