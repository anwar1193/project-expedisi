<?php $__env->startSection('title'); ?>Detail Pengguna
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Pengguna</h3>
		<?php $__env->endSlot(); ?>
        <li class="breadcrumb-item active"><a href="<?php echo e(route('users')); ?>">Pengguna</a></li>
        <li class="breadcrumb-item active">Detail</li>
	<?php echo $__env->renderComponent(); ?>
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					
                    <table class="table">
                        <tr>
                            <th>Nama</th>
                            <th class="text-center">:</th>
                            <td><?php echo e($user->nama); ?></td>
                        </tr>

                        <tr>
                            <th>Username</th>
                            <th class="text-center">:</th>
                            <td><?php echo e($user->username); ?></td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <th class="text-center">:</th>
                            <td><?php echo e($user->email); ?></td>
                        </tr>

                        <tr>
                            <th>Nomor Telepon</th>
                            <th class="text-center">:</th>
                            <td><?php echo e($user->nomor_telepon); ?></td>
                        </tr>

                        <tr>
                            <th>User Level</th>
                            <th class="text-center">:</th>
                            <td><?php echo e($user->nama_level); ?></td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <th class="text-center">:</th>
                            <td><?php echo e($user->status == 1 ? 'Aktif' : 'Non Aktif'); ?></td>
                        </tr>

                        <tr>
                            <th>Tanggal Kadaluarsa</th>
                            <th class="text-center">:</th>
                            <td><?php echo e(date("d-m-Y", strtotime($user->tgl_kadaluarsa))); ?></td>
                        </tr>

                        <tr>
                            <th>Foto</th>
                            <th class="text-center">:</th>
                            <td>
                                <img src="<?php echo e(asset('storage/foto_profil/'.$user->foto)); ?>" alt="" width="200px" class="img-fluid mt-2">
                            </td>
                        </tr>
                    </table>

                    <div class="card-footer text-end">
                        <a href="<?php echo e(route('users')); ?>" class="btn btn-light">Kembali</a>
                        
                    </div>

				</div>
			</div>
		</div>
	</div>
	
	
	<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/munawarahmad/Documents/Applications/projectku/frontend/resources/views/admin/master/users/detail.blade.php ENDPATH**/ ?>