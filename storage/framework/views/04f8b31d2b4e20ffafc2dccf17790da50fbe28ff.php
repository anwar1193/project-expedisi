<?php $__env->startSection('title'); ?>All Invoices
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
			<h3>Data All Invoices</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item active"><a href="<?php echo e(route('jenis-pengeluaran')); ?>">Invoices</a></li>
		<li class="breadcrumb-item active">Table</li>
	<?php echo $__env->renderComponent(); ?>
	
	<div class="container-fluid">
        <form class="d-flex flex-column col-12" role="search" action="" method="GET">
			<div class="d-flex justify-content-end">
                <div id="customer_id">
                    <input class="form-control" type="date" name="tanggal" value="" />
                </div>
                <div id="customer_id" class="px-2">
                    <select name="customer_id" class="form-control py-2">
                        <option value="">- Pilih Customer -</option>
                        <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($customer->id); ?>" <?php echo e(request('customer_id') == $customer->id ? 'selected' : ''); ?>><?php echo e($customer->nama); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div id="status" class="px-2">
                    <select name="status" class="form-control py-2">
                        <option value="">- Pilih Status -</option>
						<option value="1" <?php echo e(request('status') == '1' ? 'selected' : ''); ?>>Lunas</option>
						<option value="0" <?php echo e(request('status') == '0' ? 'selected' : ''); ?>>Belum Lunas</option>
					</select>
                </div>
				<div class="px-1">
					<button type="submit" class="btn btn-primary" title="Cari"><i class="fa fa-search"></i> Cari</button>
				</div>
				<div class="px-1">
					<a href="<?php echo e(route('invoices.index')); ?>" class="btn btn-md btn-secondary" title="Reset"><i class="fa fa-refresh"></i> Reset</a>
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
	                    
						
						<div class="table-responsive">
	                        <table class="display" id="basic-1">
	                            <thead>
	                                <tr>
	                                    <th width="5%">No</th>
	                                    <th>No Invoice</th>
	                                    <th>Total Tagihan</th>
	                                    <th>Sisa Tagihan</th>
	                                    <th>Tanggal Cetak</th>
										<th>Kode Customer</th>
										<th>Nama Customer</th>
										<th>Status</th>
										<th width="20%">Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr>
											<td><?php echo e($loop->iteration); ?></td>
											<td><?php echo e($data->invoice_no); ?></td>
											<td>Rp <?php echo e(number_format($data->totalBersih, 0, '.', '.')); ?></td>
											<td>Rp <?php echo e(number_format($data->sisa, 0, '.', '.')); ?></td>
											<td><?php echo e(formatTanggalIndonesia($data->created_at)); ?></td>
											<td><?php echo e($data->kode_customer); ?></td>
											<td><?php echo e($data->nama); ?></td>
											<td class="text-center">
												<span class="badge <?php echo e($data->sisa == 0 ? 'badge-primary' : 'badge-warning'); ?>">
													<i class="fa <?php echo e($data->sisa == 0 ? 'fa-check' : 'fa-warning'); ?>"></i>
													<?php echo e($data->sisa == 0 ? 'Lunas' : 'Belum Lunas'); ?>

												</span>
											</td>
											<td>
												<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
													<div class="btn-group" role="group">
														<button class="btn btn-secondary btn-sm dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
														<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
															<a class="dropdown-item" href="<?php echo e(route('invoice.hasil-transaksi', ['id' => $data->id, 'invoiceId' => $data->invoiceId])); ?>">
																<span><i class="pt-2 pe-2" data-feather="eye"></i> Detail</span>
															</a>

															<?php if($data->sisa != 0): ?>
																<a class="dropdown-item" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#pembayaranInvoice<?php echo e($data->invoiceId); ?>">
																	<span><i class="pt-2 pe-2" data-feather="dollar-sign"></i> Pembayaran</span>
																</a>
															<?php endif; ?>

															<a class="dropdown-item" href="<?php echo e(route('invoice.transaksi-pembayaran.detail', $data->invoiceId)); ?>">
																<span><i class="pt-2 pe-2" data-feather="eye"></i> History Pembayaran</span>
															</a>
														</div>
													</div>
												</div>
												<?php echo $__env->make('invoice.pembayaran', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

														
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
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/munawarahmad/Documents/Applications/projectku/project-expedisi/resources/views/invoice/all.blade.php ENDPATH**/ ?>