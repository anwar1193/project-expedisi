<?php $__env->startSection('title'); ?>OBD II Tracker
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Data OBD II Tracker</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item active"><a href="<?php echo e(route('surveilance-car')); ?>">OBD II Tracker</a></li>
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
	                                    <th>Merk</th>
	                                    <th>Serial Number</th>
	                                    <th>Armada</th>
	                                    <th>Nopol</th>
	                                    <th>Status Engine</th>
										<th width="20%">Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr>
											<td><?php echo e($loop->iteration); ?></td>
											<td><?php echo e($data->merk); ?></td>
											<td class="text-uppercase"><?php echo e($data->serial_number); ?></td>
											<td><?php echo e($data->cars_merk ? $data->cars_merk : "-"); ?></td>
											<td><?php echo e($data->nopol ? $data->nopol : "-"); ?></td>
											<td><?php echo e($data->car_id ? ($data->engine_status == 1 ?  "ON" : "OFF") : "-"); ?></td>
											<td>
												<?php if(!$data->car_id): ?>
													<a class="btn btn-square btn-success btn-xs" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal<?php echo e($data->id); ?>">
														Hubungkan
													</a>
												<?php else: ?>
													<a class="btn btn-square btn-danger btn-xs" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#lepasModal<?php echo e($data->id); ?>">
														Lepaskan
													</a>
													<a class="btn btn-square btn-<?php echo e($data->engine_status == 1 ? "danger" : "success"); ?> btn-xs" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#switchModal<?php echo e($data->id); ?>">
														<?php echo e($data->engine_status == 1 ? "Matikan" : "Hidupkan"); ?>

													</a>
												<?php endif; ?>
												
												<?php echo $__env->make('obd-tracker.component.form-hubungkan', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
												<?php echo $__env->make('obd-tracker.component.form-lepaskan', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
												<?php echo $__env->make('obd-tracker.component.modal-switch', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/munawarahmad/Documents/Applications/projectku/frontend/resources/views/obd-tracker/index.blade.php ENDPATH**/ ?>