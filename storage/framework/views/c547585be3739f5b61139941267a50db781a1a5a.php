<?php $__env->startSection('title'); ?>Profile Pengguna
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/dropzone.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	
	
	<div class="container-fluid">
		<div class="row">
            <?php if(session()->has('success')): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Berhasil <i class="fa fa-info-circle"></i></strong> 
                    <?php echo e(session('success')); ?>

                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

            <?php if(session()->has('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Berhasil <i class="fa fa-info-circle"></i></strong> 
                    <?php echo e(session('error')); ?>

                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php endif; ?>

			<div class="col-xl-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h4 class="card-title mb-0">My Profile</h4>
                        <div class="card-options">
                            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="profile-title">
                                <div class="media">
                                    <img class="img-90" alt="" src="<?php echo e(asset('storage/foto_profil/'.$user->foto)); ?>" />
                                    <div class="media-body" style="margin-left:15px">
                                        <h3 class="mb-1 f-20 txt-danger"><?php echo e($user->nama); ?></h3>
                                        <p class="f-12"><?php echo e($user->nama_level); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end mb-2">
                            <form class="form theme-form" method="POST" action="<?php echo e(route('ganti-foto')); ?>" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="row mb-2">
                                    <input type="text" name="id" value="<?php echo e($user->id); ?>" hidden>
                                </div>
                                <div class="row mb-3">
                                    <input class="form-control" type="file" width="48" height="48" name="foto" />
                                </div>
                                <button class="btn btn-danger" type="submit">Simpan</button>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-8">
                <form method="post" action="<?php echo e(route('profile.update')); ?>" class="card">
                    <?php echo csrf_field(); ?>
                    <div class="card-header pb-0">
                        <h4 class="card-title mb-0">Edit Profile</h4>
                        <div class="card-options">
                            <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <input type="text" name="id" value="<?php echo e($user->id); ?>" hidden>

                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input class="form-control" type="text" name="nama" value="<?php echo e($user->nama); ?>" />
                                </div>
                            </div>

                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Username</label>
                                    <input class="form-control" type="text" name="username" value="<?php echo e($user->username); ?>" />
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input class="form-control" type="text" name="email" value="<?php echo e($user->email); ?>" />
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Level</label>
                                    <input class="form-control" type="text" name="user_level" value="<?php echo e($user->nama_level); ?>" readonly/>
                                </div>
                            </div>

                            
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-danger" type="submit">Update Profile</button>
                    </div>
                </form>
            </div>
		</div>
	</div>

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myLargeModalLabel">Large modal</h4>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="dropzone digits" id="singleFileUpload" action="/upload.php">
                        <div class="dz-message needsclick">
                            <i class="icon-cloud-up"></i>
                            <h6>Drop files here or click to upload.</h6>
                            <span class="note needsclick">(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
	
	
<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/dropzone/dropzone.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/dropzone/dropzone-script.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/admin/master/users/profile.blade.php ENDPATH**/ ?>