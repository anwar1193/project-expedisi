<div class="card-body"></div>
<div class="row ps-3 ms-3">
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
                            <img class="img-90" alt="" src="<?php echo e(asset('storage/foto_profil/'.$data->foto)); ?>" />
                            <div class="media-body" style="margin-left:15px">
                                <h3 class="mb-1 f-20 txt-danger"><?php echo e($data->nama); ?></h3>
                                <p class="f-12"><?php echo e($data->nama_level); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-end mb-2">
                    <form class="form theme-form" method="POST" action="<?php echo e(route('ganti-foto')); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="row mb-2">
                            <input type="text" name="id" value="<?php echo e($data->id); ?>" hidden>
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
                    <input type="text" name="id" value="<?php echo e($data->id); ?>" hidden>

                    <div class="col-sm-6 col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input class="form-control" type="text" name="nama" value="<?php echo e($data->nama); ?>" />
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input class="form-control" type="text" name="username" value="<?php echo e($data->username); ?>" />
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control" type="text" name="email" value="<?php echo e($data->email); ?>" />
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Level</label>
                            <input class="form-control" type="text" name="user_level" value="<?php echo e($data->nama_level); ?>" readonly/>
                        </div>
                    </div>

                    
                </div>
            </div>
            <div class="card-footer text-end">
                <button class="btn btn-danger" type="submit">Update Profile</button>
            </div>
        </form>
    </div>
</div><?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/customers/component/profile.blade.php ENDPATH**/ ?>