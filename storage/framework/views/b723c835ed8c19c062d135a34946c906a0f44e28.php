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

                        <div class="row ps-3 ms-3 py-3 my-3">
                            <div class="col-xl-4 col-md-4 col-sm-4 box-col-4 des-xl-25 rate-sec">
                                <div class="card shadow-lg" style="width: 18rem; border-radius:15px; background-color: rgb(219, 176, 55)">
                                    <div class="card-body text-center fw-bold">
                                      <h5 class="card-title pb-3 text-center fw-bold">Total Saldo</h5>
                                      <h4><i class="icofont icofont-sale-discount"></i></h4>
                                      <h3 class="fw-bold"><?php echo e('Rp '.number_format($saldo, 0, '.', '.')); ?></h3>
                                    </div>
                                  </div>
                              </div>
                              <div class="col-xl-4 col-md-4 col-sm-4 box-col-4 des-xl-25 rate-sec">
                                <div class="card shadow-lg" style="width: 18rem; border-radius:15px; background-color: rgb(33, 174, 47)">
                                    <div class="card-body text-center fw-bold">
                                        <h5 class="card-title pb-3 text-center fw-bold">Pemasukan</h5>
                                        <h4><i class="icofont icofont-arrow-up"></i></h4>
                                        <h3 class="fw-bold"><?php echo e('Rp '.number_format($pemasukan->total ?? 0, 0, '.', '.')); ?></h3>
                                      </div>
                                  </div>
                              </div>
                              <div class="col-xl-4 col-md-4 col-sm-4 box-col-4 des-xl-25 rate-sec">
                                <div class="card shadow-lg" style="width: 18rem; border-radius:15px; background-color: rgb(200, 75, 75)">
                                    <div class="card-body text-center fw-bold">
                                        <h5 class="card-title pb-3 text-center fw-bold">Pengeluaran</h5>
                                        <h4><i class="icofont icofont-arrow-down"></i></h4>
                                        <h3 class="fw-bold"><?php echo e('Rp '.number_format($pengeluaran->total ?? 0, 0, '.', '.')); ?></h3>
                                      </div>
                                  </div>
                              </div>
                        </div>
	                </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-evenly">
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
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/posisi-cash/index.blade.php ENDPATH**/ ?>