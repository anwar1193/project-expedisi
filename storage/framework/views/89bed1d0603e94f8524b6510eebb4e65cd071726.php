<?php $__env->startSection('title'); ?>Hak Akses Pengguna
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Hak Akses Pengguna</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item active">Pengaturan</li>
		<li class="breadcrumb-item active"><a href="<?php echo e(route('hak-akses')); ?>">Hak Akses</a></li>
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
	                    
						
						<div class="table-responsive">
	                        <table class="display" id="basic-1">
	                            <thead>
	                                <tr>
	                                    <th>No</th>
	                                    <th>Nama Lengkap</th>
	                                    <th>Level</th>
	                                    <th>Status</th>
										<th class="text-center">Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr>
											<td><?php echo e($loop->iteration); ?></td>
											<td> <?php echo e($data->nama); ?></td>
											<td><?php echo e($data->nama_level); ?></td>
											<td><span class="badge <?php echo e($data->status == 1 ? 'bg-success' : 'bg-danger'); ?>"><?php echo e($data->status == 1 ? 'Aktif' : 'Non Aktif'); ?></span></td>
											<td class="text-center">
                                                <a class="btn btn-square btn-warning btn-xs" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal<?php echo e($data->id); ?>" data-bs-placement="top" title="Update">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <?php echo $__env->make('components.form-hak-akses', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/munawarahmad/Documents/Applications/projectku/frontend/resources/views/admin/master/users/hak-akses.blade.php ENDPATH**/ ?>