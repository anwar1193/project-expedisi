<?php $__env->startSection('title'); ?>Perlengkapan
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Data Perlengkapan</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item active"><a href="<?php echo e(route('perlengkapan')); ?>">Perlengkapan</a></li>
		<li class="breadcrumb-item active">Table</li>
	<?php echo $__env->renderComponent(); ?>

	<?php if(isAdmin()): ?>
    <nav class="page-breadcrumb">
        <ol class="breadcrumb align-items-center">
            <div class="d-grid gap-2 d-md-block mx-2">
<<<<<<< HEAD:storage/framework/views/b6cf13b5186de59050d5ba5a2df4ac6918c44b70.php
                
                    <a href="<?php echo e(route('role.create')); ?>" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data">
                        <i class="fa fa-plus"></i> Add Role
=======
                    <a href="<?php echo e(route('perlengkapan.create')); ?>" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data">
                        <i class="fa fa-plus"></i> Tambah
>>>>>>> a0feffec37c35456c65975640deb1bdc0e62042d:storage/framework/views/3b40dfc8009ed69128783dcc64a828f3c5b9ce47.php
                    </a>
            </div>
        </ol>
    </nav>
	<?php endif; ?>
	
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
	                                    <th>Nama Perlengkapan</th>
										<th>Keterangan</th>
										<?php if(isAdmin()): ?>
										<th width="20%">Action</th>
										<?php endif; ?>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                <?php $__currentLoopData = $perlengkapans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr>
											<td><?php echo e($loop->iteration); ?></td>
											<td><?php echo e($data->nama_perlengkapan); ?></td>
											<td><?php echo e($data->keterangan); ?></td>
											<?php if(isAdmin()): ?>
											<td class="text-center">

												<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
													<div class="btn-group" role="group">
														<button class="btn btn-secondary btn-sm dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
														<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
<<<<<<< HEAD:storage/framework/views/b6cf13b5186de59050d5ba5a2df4ac6918c44b70.php
															<a class="dropdown-item" href="<?php echo e(route('role.edit', $data->id)); ?>"><span><i data-feather="edit"></i> Edit</span></a>

															<a class="dropdown-item" href="<?php echo e(route('role.delete', $data->id)); ?>" onclick="return confirm('Are you sure?')"><span><i data-feather="delete"></i> Delete</span></a>

															<a class="dropdown-item" href="<?php echo e(route('role.change-permission', $data->id)); ?>"><span><i data-feather="unlock"></i> Change Permission</span></a>
=======
															<a class="dropdown-item" href="<?php echo e(route('perlengkapan.edit', $data->id)); ?>"><span><i class="pt-2 pe-2" data-feather="edit"></i> Edit</span></a>

															<a class="dropdown-item" href="<?php echo e(route('perlengkapan.delete', $data->id)); ?>" onclick="return confirm('Apakah Anda Yakin?')"><span><i class="pt-2 pe-2" data-feather="delete"></i> Delete</span></a>
>>>>>>> a0feffec37c35456c65975640deb1bdc0e62042d:storage/framework/views/3b40dfc8009ed69128783dcc64a828f3c5b9ce47.php
														</div>
													</div>
												</div>

											</td>
											<?php endif; ?>
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
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/perlengkapan/index.blade.php ENDPATH**/ ?>