<?php $__env->startSection('title'); ?>Data Pemasukan
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Data Pemasukan</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item active"><a href="<?php echo e(route('data-pemasukan')); ?>">Data Pemasukan</a></li>
		<li class="breadcrumb-item active">Table</li>
	<?php echo $__env->renderComponent(); ?>

    <nav class="page-breadcrumb">
        <ol class="breadcrumb align-items-center">
            <div class="d-grid gap-2 d-md-block mx-2">
                
                    <a href="<?php echo e(route('data-pemasukan.create')); ?>" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data">
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
										<th>Tanggal Pemasukan</th>
										<th>Keterangan</th>
	                                    <th>Jumlah Pemasukan</th>
	                                    <th>Sumber Pemasukan</th>
	                                    <th>Bukti Pembayaran</th>
										<th width="35%" class="text-center">Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>                                        
                                    <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($loop->iteration); ?></td>
										<td><?php echo e($data->tgl_pemasukkan); ?></td>
										<td><?php echo e($data->keterangan); ?></td>
										<td><?php echo e(number_format($data->jumlah_pemasukkan, 0, '.', ',')); ?></td>
										<td><?php echo e($data->sumber_pemasukkan); ?></td>
										<td onmouseover="showBukti(<?php echo e($data->id); ?>)" onmouseout="hideBukti(<?php echo e($data->id); ?>)">
											<?php if($data->bukti_pembayaran != ''): ?>
												<div id="view-bukti<?php echo e($data->id); ?>" class="mb-3">
													<img src="<?php echo e(asset('storage/data-pemasukkan/'.$data->bukti_pembayaran)); ?>" alt="" width="200px" class="img-fluid mt-2">
													<a class="btn btn-primary" href="<?php echo e(asset('storage/data-pemasukkan/'.$data->bukti_pembayaran)); ?>" target="_blank">View Image</a>
												</div>
											<?php endif; ?>
											<div id="icon-view<?php echo e($data->id); ?>">
												<i data-feather="link"></i> Gambar
											</div>
											
										</td>
										<td class="text-center">

											<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
												<div class="btn-group" role="group">
													<button class="btn btn-secondary btn-sm dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
													<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

														<a class="dropdown-item" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modalDataPemasukkan<?php echo e($data->id); ?>" title="Detail Data"><span><i data-feather="eye"></i> Detail</span></a>

														<a class="dropdown-item" href="<?php echo e(route('data-pemasukan.edit', $data->id)); ?>" ><span><i data-feather="edit"></i> Edit</span></a>

														<?php if(Session::get('user_level') == 1): ?>
															<a class="dropdown-item" href="<?php echo e(route('data-pemasukan.delete', $data->id)); ?>" onclick="return confirm('Apakah Anda Yakin?')"><span><i data-feather="delete"></i> Delete</span></a>
														<?php endif; ?>
														
													</div>
												</div>
											</div>
											<?php echo $__env->make('data-pemasukan.detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/munawarahmad/Documents/Applications/projectku/frontend/resources/views/data-pemasukan/index.blade.php ENDPATH**/ ?>