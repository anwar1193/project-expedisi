<?php $__env->startSection('title'); ?>Detail Riwayat Pembayaran
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<style>
	.dataTables_filter {
		display: none;
	}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Detail Riwayat Pembayaran</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item active"><a href="<?php echo e(route('invoices.index')); ?>">All Invoice</a></li>
		<li class="breadcrumb-item active">Table</li>
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
	                    
						
						<div class="table-responsive">
	                        <table class="display" id="basic-1">
	                            <thead>
	                                <tr>
	                                    <th width="5%">No</th>
	                                    <th>No Invoice</th>
	                                    <th>Tanggal Pembayaran</th>
	                                    <th>Nominal Pembayaran</th>
	                                    <th>Bukti Pembayaran</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr>
											<td><?php echo e($loop->iteration); ?></td>
											<td><?php echo e($data->invoice_no); ?></td>
											<td><?php echo e(formatTanggalIndonesia($data->tanggal_bayar)); ?></td>
											<td>Rp <?php echo e(number_format($data->nominal, 0, '.', '.')); ?></td>
											<td onmouseover="showBukti(<?php echo e($data->id); ?>)" onmouseout="hideBukti(<?php echo e($data->id); ?>)">
                                                <?php if($data->bukti_bayar != ''): ?>
												    <div id="view-bukti<?php echo e($data->id); ?>" class="mb-3">
                                                        <img src="<?php echo e(asset('storage/invoice-bukti-bayar/'.$data->bukti_bayar)); ?>" alt="" width="200px" class="img-fluid mt-2">
                                                        <a class="btn btn-primary" href="<?php echo e(asset('storage/invoice-bukti-bayar/'.$data->bukti_bayar)); ?>" target="_blank">View Image</a>
                                                    </div>
                                                <?php endif; ?>
                                                <div id="icon-view<?php echo e($data->id); ?>">
                                                    <i data-feather="link"></i> Gambar
                                                </div>
                                                
                                            </td>
										</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                            </tbody>
	                        </table>
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
	<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<script>
			$('#view-bukti'+<?php echo e($data->id); ?>).hide();
			$('#icon-view'+<?php echo e($data->id); ?>).show();
		</script>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<script>
		function showBukti(id) {
			$('#view-bukti'+id).show();
			$('#icon-view'+id).hide();
		}

		function hideBukti(id) {
			$('#view-bukti'+id).hide();
			$('#icon-view'+id).show();
		}
	</script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const jumlahPembayaranInput = document.querySelector('input[name="nominal"]');
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
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/invoice/riwayat-pembayaran.blade.php ENDPATH**/ ?>