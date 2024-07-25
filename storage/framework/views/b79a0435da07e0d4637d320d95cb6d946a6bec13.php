<?php echo $__env->make('posisi-cash.pemasukan', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('posisi-cash.pengeluaran', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title'); ?>Posisi Cash
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Posisi Cash</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item active">Posisi Cash</li>
	<?php echo $__env->renderComponent(); ?>
	
	<div class="container-fluid">
		<form class="d-flex flex-column col-12 mb-2" role="search" action="" method="GET">
			<div class="d-flex justify-content-end">
                <div id="customer_id" class="px-2">
                    <input class="form-control" type="date" name="tanggal" value="<?php echo e($tanggal); ?>" />
                </div>
				<div class="px-1">
					<button type="submit" class="btn btn-primary" title="Cari"><i class="fa fa-search"></i> Cari</button>
				</div>
				<div class="px-1">
					<a href="<?php echo e(route('posisi-cash')); ?>" class="btn btn-md btn-secondary" title="Reset"><i class="fa fa-refresh"></i> Reset</a>
				</div>
			</div>
		</form>
        <div class="row">
        </div>
	    <div class="row">
	        <!-- Server Side Processing start-->
	        <div class="col-sm-12">
	            <div class="card">
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

                        <div class="row ps-3 ms-3 pt-3 mt-3">
							<div class="col-xl-4 col-md-4 col-sm-4 box-col-4 des-xl-25 rate-sec">
								<a class="text-white" href="<?php echo e(route('posisi-cash.history-saldo')); ?>">
									<div class="card shadow-lg" style="width: 18rem; border-radius:15px; background-color: rgb(219, 176, 55)">
										<div class="card-body fw-bold">
											<div class="row">
												<div class="col-4 d-flex align-items-center"><h1><i class="icofont icofont-sale-discount"></i></h1></div>
												<div class="col">
													<div class="row"><h5 class="fw-bold">Total Saldo</h5></div>
													<div class="row"><h5 class="fw-bold"><?php echo e('Rp '.number_format($saldoToday->saldo, 0, '.', '.')); ?></h5></div>
												</div>
											</div>

										
										</div>
									</div>
								</a>
                              </div>
                              <div class="col-xl-4 col-md-4 col-sm-4 box-col-4 des-xl-25 rate-sec">
								<a class="text-white"  href="<?php echo e(route('posisi-cash.history-pemasukan')); ?>">
									<div class="card shadow-lg" style="width: 18rem; border-radius:15px; background-color: rgb(33, 174, 47)">
										<div class="card-body fw-bold">
											<div class="row">
												<div class="col-4 d-flex align-items-center"><h1><i class="icofont icofont-arrow-up"></i></h1></div>
												<div class="col">
													<div class="row"><h5 class="fw-bold">Pemasukkan</h5></div>
													<div class="row"><h5 class="fw-bold"><?php echo e('Rp '.number_format($pemasukan->total ?? 0, 0, '.', '.')); ?></h5></div>
												</div>
											</div>
										</div>
									</div>
								</a>
                              </div>
                              <div class="col-xl-4 col-md-4 col-sm-4 box-col-4 des-xl-25 rate-sec">
								<a class="text-white"  href="<?php echo e(route('posisi-cash.history-pengeluaran')); ?>">
									<div class="card shadow-lg" style="width: 18rem; border-radius:15px; background-color: rgb(200, 75, 75)">
										<div class="card-body text-center fw-bold">
											<div class="row">
												<div class="col-4 d-flex align-items-center"><h1><i class="icofont icofont-arrow-down"></i></h1></div>
												<div class="col">
													<div class="row"><h5 class="fw-bold">Pengeluaran</h5></div>
													<div class="row"><h5 class="fw-bold"><?php echo e('Rp '.number_format($pengeluaran->total ?? 0, 0, '.', '.')); ?></h5></div>
												</div>
											</div>
										</div>
									</div>
								</a>
                              </div>
                        </div>
	                </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-evenly">
							<?php if($tanggal == date('Y-m-d')): ?>
								<form action="<?php echo e(route('posisi-cash.closing')); ?>" method="POST">
									<?php echo csrf_field(); ?>
									<input type="hidden" name="saldo" value="<?php echo e($saldo); ?>">
									<input type="hidden" name="tanggal" value="<?php echo e($tanggal); ?>">
									<button class="btn btn-secondary" type="submit" onclick="return confirm('Apakah Anda Yakin?')">Closing</button>
								</form>
							<?php endif; ?>
                            <button class="btn btn-secondary" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#pemasukan">Input Pemasukan</button>
                            <button class="btn btn-secondary" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#pengeluaran">Input Pengeluaran</button>
                        </div>
                    </div>
	            </div>
	        </div>
	        <!-- Server Side Processing end-->
	    </div>
	</div>
	
	<?php $__env->startPush('scripts'); ?>
	<script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatables/datatable.custom.js')); ?>"></script>
    <script>
		document.addEventListener('DOMContentLoaded', function() {
			const jumlahPembayaranInput = document.querySelector('input[id="pemasukan"]');
			const displayElement = document.createElement('div');
			displayElement.innerHTML = '<strong>RP. ' + new Intl.NumberFormat('id-ID').format(jumlahPembayaranInput.value) + '</strong>';
			jumlahPembayaranInput.parentNode.appendChild(displayElement);

			jumlahPembayaranInput.addEventListener('input', function() {
				const typedValue = jumlahPembayaranInput.value;
				displayElement.innerHTML = '<strong>RP. ' + new Intl.NumberFormat('id-ID').format(typedValue) + '</strong>';
			});
		});
		document.addEventListener('DOMContentLoaded', function() {
			const jumlahPembayaranInput = document.querySelector('input[id="pengeluaran"]');
			const displayElement = document.createElement('div');
			displayElement.innerHTML = '<strong>RP. ' + new Intl.NumberFormat('id-ID').format(jumlahPembayaranInput.value) + '</strong>';
			jumlahPembayaranInput.parentNode.appendChild(displayElement);

			jumlahPembayaranInput.addEventListener('input', function() {
				const typedValue = jumlahPembayaranInput.value;
				displayElement.innerHTML = '<strong>RP. ' + new Intl.NumberFormat('id-ID').format(typedValue) + '</strong>';
			});
		});
	</script>
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/munawarahmad/Documents/Applications/projectku/project-expedisi/resources/views/posisi-cash/index.blade.php ENDPATH**/ ?>