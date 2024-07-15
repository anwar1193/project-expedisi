<?php $__env->startSection('title'); ?>Customer
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Customer</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item active"><a href="<?php echo e(route('customers.index')); ?>">Customer</a></li>
		<li class="breadcrumb-item active">Table</li>
	<?php echo $__env->renderComponent(); ?>

    <nav class="page-breadcrumb">
        <ol class="breadcrumb align-items-center">
            <div class="d-grid gap-2 d-md-block mx-2">
                
                    <a href="<?php echo e(route('customers.create')); ?>" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data">
                        <i class="fa fa-plus"></i> Tambah
                    </a>
                
            </div>
        </ol>
    </nav>
	
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
	                                    <th>No</th>
										<th width="20%" class="text-center">Action</th>
										<th>Kode Customer</th>
										<th>Status</th>
										<th>Nama</th>
										<th>Perusahaan</th>
										<th>No Whatsapp</th>
	                                    <th>Email</th>
	                                    <th>Limit Kredit</th>
	                                    <th>Point</th>
	                                    <th>Diskon</th>
	                                </tr>
	                            </thead>
	                            <tbody>                                        
                                    <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr>
											<td><?php echo e($loop->iteration); ?></td>

											<td class="text-center">

												<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
													<div class="btn-group" role="group">
														<button class="btn btn-secondary btn-sm dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
														<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

															<?php if(Session::get('user_level') == 2): ?>
																<a class="dropdown-item" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#customerLimitKredit<?php echo e($data->id); ?>">
																	<span><i class="pt-2 pe-2" data-feather="tag"></i> Limit Kredit</span>
																</a>
																
																<a class="dropdown-item" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#customerDiskon<?php echo e($data->id); ?>">
																	<span><i class="pt-2 pe-2" data-feather="dollar-sign"></i> Diskon</span>
																</a>
																
																<a class="dropdown-item" href="<?php echo e(route('customers.historyLimit', $data->id)); ?>"><span><i class="pt-2 pe-2" data-feather="list"></i> History Limit</span></a>

															<?php endif; ?>

															<a class="dropdown-item" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#customer<?php echo e($data->id); ?>">
																<span><i class="pt-2 pe-2" data-feather="eye"></i> Detail</span>
															</a>
															
															<a class="dropdown-item" href="<?php echo e(route('customers.edit', $data->id)); ?>"><span><i class="pt-2 pe-2" data-feather="edit"></i> Edit</span></a>

															<a class="dropdown-item" href="<?php echo e(route('customers.delete', $data->id)); ?>" onclick="return confirm('Apakah Anda Yakin?')"><span><i class="pt-2 pe-2" data-feather="delete"></i> Delete</span></a>

															<a class="dropdown-item" href="<?php echo e(route('customers.approval', $data->id)); ?>" onclick="return confirm('Approve Data Customer Ini?')"><span><i data-feather="check-square"></i> Approve</span></a>
															
														</div>
														<?php echo $__env->make('customers.detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
														<?php echo $__env->make('customers.limit_kredit', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
														<?php echo $__env->make('customers.diskon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
													</div>
												</div>
											</td>
											
											<td><?php echo e($data->kode_customer); ?></td>
											<td><?php echo e($data->status == true ? "Altif" : "Tidak Aktif"); ?></td>
											<td><?php echo e($data->nama); ?></td>
											<td><?php echo e($data->perusahaan == NULL ? '-' : $data->perusahaan); ?></td>
											<td><?php echo e($data->no_wa); ?></td>
											<td><?php echo e($data->email); ?></td>

											<td class="text-center">
												<span class="badge badge-primary">
													<?php echo e('Rp '.number_format($data->limit_credit, 0, '.', ',')); ?>

												</span>
											</td>

											<td class="text-center">
												<span class="badge" style="background-color: blue">
													<?php echo e($data->point); ?>

												</span>
											</td>
											
											<td class="text-center">
												<span class="badge" style="background-color: blue">
													<?php echo e($data->diskon); ?>%
												</span>
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
			const jumlahPembayaranInput = document.querySelector('input[name="nominal_kredit"]');
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
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/customers/index.blade.php ENDPATH**/ ?>