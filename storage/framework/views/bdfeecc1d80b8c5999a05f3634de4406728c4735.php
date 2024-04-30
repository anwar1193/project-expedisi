<?php $__env->startSection('title'); ?>Perangkat
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Data Perangkat</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item active"><a href="<?php echo e(route('perangkat')); ?>">Perangkat</a></li>
		<li class="breadcrumb-item active">Table</li>
	<?php echo $__env->renderComponent(); ?>

    <nav class="page-breadcrumb">
        <ol class="breadcrumb align-items-center">
            <div class="d-grid gap-2 d-md-block mx-2">
					<?php if(isAdmin()): ?>
                    <a href="<?php echo e(route('perangkat.create')); ?>" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data">
                    	<i class="fa fa-plus"></i> Tambah
                    </a>
					<?php endif; ?>

					<a href="<?php echo e(route('perangkat.export-pdf')); ?>" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Export PDF">
						<i class="fa fa-file-pdf-o"></i> Export PDF
					</a>

					<a href="<?php echo e(route('perangkat.export-excel')); ?>" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Export Excel">
						<i class="fa fa-file-excel-o"></i> Export Excel
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
	                                    <th>Kode Perangkat</th>
	                                    <th>Nama Perangkat</th>
	                                    <th>Jenis</th>
	                                    <th>Serial Number</th>
	                                    <th>Kondisi</th>
										<th width="20%" class="text-center">Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                <?php $__currentLoopData = $perangkats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr>
											<td><?php echo e($loop->iteration); ?></td>
											<td><?php echo e($data->kode_perangkat); ?></td>
											<td><?php echo e($data->nama_perangkat); ?></td>
											<td><?php echo e($data->nama_jenis); ?></td>
											<td><?php echo e($data->serial_number); ?></td>
											<td><?php echo e($data->kondisi_perangkat); ?></td>
											<td class="text-center">
												<a href="<?php echo e(route('perangkat.detail', $data->id)); ?>" class="btn btn-square btn-info btn-xs" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Data">
													<i class="fa fa-eye"></i>
												</a>

												<?php if(isAdmin()): ?>
												<a href="<?php echo e(route('perangkat.edit', $data->id)); ?>" class="btn btn-square btn-warning btn-xs" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data">
													<i class="fa fa-edit"></i>
												</a>
												
												<a href="<?php echo e(route('perangkat.delete', $data->id)); ?>" class="btn btn-square btn-danger btn-xs" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data" onclick="return confirm('Apakah Anda Yakin?')">
													<i class="fa fa-trash"></i>
												</a>
												<?php endif; ?>
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
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/apps/paket1/frontend/resources/views/perangkat/index.blade.php ENDPATH**/ ?>