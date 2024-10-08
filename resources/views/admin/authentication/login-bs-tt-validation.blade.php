@extends('admin.authentication.master')
{{-- @include('admin.authentication.register') --}}

@section('title')login
 {{ $title }}
@endsection

@push('css')
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sweetalert2.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
    <div class="container-fluid">
	    <div class="row">
	        {{-- <div class="col-xl-5"><img class="bg-img-cover bg-center" src="{{ asset('assets/images/login/login.jpg') }}" alt="looginpage" height="50%" /></div> --}}
	        {{-- <div class="col-xl-5"><img class="bg-img-cover bg-center" src="{{ asset('assets/kejagung.jpg') }}" alt="looginpage" height="50%" /></div> --}}
	        <div class="col-xl-12 p-0">
	            <div class="login-card">
	                <form class="theme-form login-form needs-validation" method="POST" action="{{ route('signin') }}">
						@csrf

						<div class="logo mb-3" style="text-align: center">
							{{-- <img src="/assets/logo-kejaksaan.png" width="100px" alt=""> --}}
							<img src="/assets/lionparcel.png" width="250px" alt="">
						</div>

	                    <p class="mb-3">AGEN EXPEDISI</p>

	                    {{-- <h6>Selamat Datang! Silahkan Masuk Ke akun Anda.</h6> --}}

						@if (session()->has('success'))
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>Berhasil <i class="fa fa-info-circle"></i></strong> 
								{{ session('success') }}
								<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif
						
						@if ($errors->has('login'))
                            {{-- <div class="alert alert-danger my-2" role="alert">
                                <p class="ps-2">{{ $errors->first('login') }}</p>
                            </div> --}}
							<div class="alert alert-danger dark alert-dismissible fade show" role="alert">
								<strong>Gagal ! </strong> 
								{{ $errors->first('login') }}
								<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
                        @endif

                        @if(session('error'))
                            {{-- <div class="alert alert-danger my-2" role="alert">
                                <p class="ps-2">{{ session('error') }}</p>
                            </div> --}}
							<div class="alert alert-danger dark alert-dismissible fade show" role="alert">
								<strong>Gagal ! </strong> 
								{{ session('error') }}
								<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
                        @endif
						
	                    <div class="form-group">
	                        <label>Username</label>
	                        <div class="input-group">
	                            <span class="input-group-text"><i class="icon-email"></i></span>
	                            <input class="form-control" type="text" name="username" value="{{ old('username') }}" autofocus autocomplete="off"/>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label>Kata Sandi</label>
	                        <div class="input-group">
	                            <span class="input-group-text"><i class="icon-lock"></i></span>
	                            <input class="form-control" type="password" name="password" id="passwordLogin" />
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
									<a href="{{ route('google-login') }}" class="btn btn-primary"><i class="fa fa-google me-2"></i> Lanjutkan Dengan Google</a>
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

	<script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>


    @push('scripts')
		<script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
		<script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
		<script>
			const passwordInput = document.getElementById('passwordLogin');
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
    @endpush

@endsection