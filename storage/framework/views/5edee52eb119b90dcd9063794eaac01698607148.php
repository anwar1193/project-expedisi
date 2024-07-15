<?php echo $__env->make('admin.authentication.register', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->startSection('title'); ?>login
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/sweetalert2.css')); ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
	    <div class="row">
	        
	        
	        <div class="col-xl-12 p-0">
	            <div class="login-card">
	                <form class="theme-form login-form needs-validation" method="POST" action="<?php echo e(route('signin')); ?>">
						<?php echo csrf_field(); ?>

						<div class="logo mb-3" style="text-align: center">
							
							<img src="/assets/lionparcel.png" width="250px" alt="">
						</div>

	                    <p class="mb-3">AGEN EXPEDISI</p>

	                    

						<?php if(session()->has('success')): ?>
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>Berhasil <i class="fa fa-info-circle"></i></strong> 
								<?php echo e(session('success')); ?>

								<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						<?php endif; ?>
						
						<?php if($errors->has('login')): ?>
                            
							<div class="alert alert-danger dark alert-dismissible fade show" role="alert">
								<strong>Gagal ! </strong> 
								<?php echo e($errors->first('login')); ?>

								<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
                        <?php endif; ?>

                        <?php if(session('error')): ?>
                            
							<div class="alert alert-danger dark alert-dismissible fade show" role="alert">
								<strong>Gagal ! </strong> 
								<?php echo e(session('error')); ?>

								<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
                        <?php endif; ?>
						
	                    <div class="form-group">
	                        <label>Username</label>
	                        <div class="input-group">
	                            <span class="input-group-text"><i class="icon-email"></i></span>
	                            <input class="form-control" type="text" name="username" value="<?php echo e(old('username')); ?>" autofocus autocomplete="off"/>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label>Kata Sandi</label>
	                        <div class="input-group">
	                            <span class="input-group-text"><i class="icon-lock"></i></span>
	                            <input class="form-control" type="password" name="password" id="password" />
	                        </div>
	                        <div class="input-group mt-2 pt-2">
								<input class="ms-3 me-2" type="checkbox" id="showPassword"> <label class="pt-1" for="showPassword">Tampilkan Kata Sandi</label>
							</div>
                        </div>

	                    <div class="form-group">
	                        <button class="btn btn-danger btn-block" type="submit">Masuk</button>
	                    </div>

						<hr class="my-4">
	                    <div class="form-group my-4">
							<div class="d-flex justify-content-center my-4">
								<div>
									<a href="<?php echo e(route('google-login')); ?>" class="btn btn-primary"><i class="fa fa-google me-2"></i> Lanjutkan Dengan Google</a>
								</div>
							</div>
	                    </div>
						<div class="form-group my-4">
							<div class="d-flex justify-content-center my-4">
								<div>
									<a class="btn text-light" style="background-color: rgb(52, 70, 234)" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modalRegister"><i class="fa fa-users me-2"></i>Daftar Sebagai Customer</a>
								</div>
							</div>
						</div>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>
	<script>
		const passwordInput = document.getElementById('password');
        const showPasswordCheckbox = document.getElementById('showPassword');

        showPasswordCheckbox.addEventListener('change', function () {
            passwordInput.type = showPasswordCheckbox.checked ? 'text' : 'password';
        });

	    (function () {
	        "use strict";
	        window.addEventListener(
	            "load",
	            function () {
	                // Fetch all the forms we want to apply custom Bootstrap validation styles to
	                var forms = document.getElementsByClassName("needs-validation");
	                // Loop over them and prevent submission
	                var validation = Array.prototype.filter.call(forms, function (form) {
	                    form.addEventListener(
	                        "submit",
	                        function (event) {
	                            if (form.checkValidity() === false) {
	                                event.preventDefault();
	                                event.stopPropagation();
	                            }
	                            form.classList.add("was-validated");
	                        },
	                        false
	                    );
	                });
	            },
	            false
	        );
	    })();
	</script>

	<script src="<?php echo e(asset('assets/js/sweet-alert/sweetalert.min.js')); ?>"></script>


    <?php $__env->startPush('scripts'); ?>
		<script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
		<script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>
		<script>
			function toggleUserFields() {
				var addUserCheckbox = document.getElementById('addUser');
				var usernameField = document.getElementById('usernameField');
				var passwordField = document.getElementById('passwordField');
				if (addUserCheckbox.checked) {
					usernameField.style.display = 'block';
					passwordField.style.display = 'block';
				} else {
					usernameField.style.display = 'none';
					passwordField.style.display = 'none';
				}
			}

			document.getElementById('addUser').addEventListener('change', toggleUserFields);

			document.addEventListener('DOMContentLoaded', toggleUserFields);
		</script>
    <?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.authentication.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/admin/authentication/login-bs-tt-validation.blade.php ENDPATH**/ ?>