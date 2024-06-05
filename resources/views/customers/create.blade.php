@extends('layouts.admin.master')

@section('title')Tambah Customer
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Customer</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('customers.index') }}">Customer</a></li>
        <li class="breadcrumb-item active">Tambah</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						@if (session()->has('error'))
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Gagal <i class="fa fa-info-circle"></i></strong> 
								{{ session('error') }}
								<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif

						@if ($errors->any())
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								@foreach ($errors->all() as $error)
									<strong>Failed <i class="fa fa-info-circle"></i></strong> 
									{{ $error }}
									<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
									<br>
								@endforeach
							</div>
						@endif
						<h5>Form Customer</h5>
					</div>
					<form class="needs-validation" method="POST" action="{{ route('customers.store') }}">
                        @csrf
						<div class="card-body">
							
							<div class="row g-3 py-2">
								<div class="col-md-6">
									<label class="form-label" for="nama">Nama</label>
									<input class="form-control @error('nama') is-invalid @enderror" id="nama" type="text" name="nama" value="{{ old('nama') }}" autocomplete="off"/>

									@error('nama')
										<div class="text-danger">
											{{ $message }}
										</div>
									@enderror
								</div>

								<div class="col-md-6">
									<label class="form-label" for="no_wa">No Whatsapp</label>
									<input class="form-control @error('no_wa') is-invalid @enderror" id="no_wa" type="text" name="no_wa" value="{{ old('no_wa') }}" autocomplete="off"/>

									@error('no_wa')
										<div class="text-danger">
											{{ $message }}
										</div>
									@enderror
								</div>
							</div>
							
							<div class="row g-3 py-2">
								<div class="col-md-6">
									<label class="form-label" for="email">Email</label>
									<input class="form-control @error('email') is-invalid @enderror" id="email" type="text" name="email" value="{{ old('email') }}" autocomplete="off"/>

									@error('email')
										<div class="text-danger">
											{{ $message }}
										</div>
									@enderror
								</div>

								<div class="col-md-6">
									<label class="form-label" for="alamat">Alamat</label>
									<input class="form-control @error('alamat') is-invalid @enderror" id="alamat" type="text" name="alamat" value="{{ old('alamat') }}" autocomplete="off"/>

									@error('alamat')
										<div class="text-danger">
											{{ $message }}
										</div>
									@enderror
								</div>
							</div>

							<div class="row g-3 py-2">
								<div class="col-md-2 d-flex align-items-end">
									<div class="form-check">
										<input class="form-check-input" id="addUser" type="checkbox" name="addUser" />
										<label class="form-check-label" for="addUser">Tambahkan user</label>
									</div>
								</div>

								<div class="col-md-5" id="usernameField" style="display:none">
									<label class="form-label" for="username">Username</label>
									<input class="form-control @error('username') is-invalid @enderror" id="username" type="text" name="username" value="{{ old('username') }}" />

									@error('username')
										<div class="text-danger">
											{{ $message }}
										</div>
									@enderror
								</div>
								
								<div class="col-md-5" id="passwordField" style="display:none">
									<label class="form-label" for="password">Password</label>
									<input class="form-control" id="password" type="password" name="password" />

									@error('password')
										<div class="text-danger">
											{{ $message }}
										</div>
									@enderror
								</div>
							</div>
						</div>

						<div class="card-footer text-end">
							<button class="btn btn-primary" type="submit">Simpan Data</button>
							<a href="{{ route('customers.index') }}" class="btn btn-light">Kembali</a>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	
	@push('scripts')
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
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