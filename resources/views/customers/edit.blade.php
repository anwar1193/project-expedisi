@extends('layouts.admin.master')

@section('title')Edit Data Customer
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
        <li class="breadcrumb-item active">Edit</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Form Edit Data Customer</h5>
					</div>
					<form class="needs-validation" method="POST" action="{{ route('customers.update', $customer->id) }}">
                        @csrf
						<div class="card-body">
							
							<div class="row g-3 py-2">
								<div class="col-md-6">
									<label class="form-label" for="nama">Nama</label>
									<input class="form-control @error('nama') is-invalid @enderror" id="nama" type="text" name="nama" value="{{ old('nama', $customer->nama) }}" />

									@error('nama')
										<div class="text-danger">
											{{ $message }}
										</div>
									@enderror
								</div>

								<div class="col-md-6">
									<label class="form-label" for="no_wa">No Whatsapp</label>
									<input class="form-control @error('no_wa') is-invalid @enderror" id="no_wa" type="text" name="no_wa" value="{{ old('no_wa', $customer->no_wa) }}" />

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
									<input class="form-control @error('email') is-invalid @enderror" id="email" type="text" name="email" value="{{ old('email', $customer->email) }}" />

									@error('email')
										<div class="text-danger">
											{{ $message }}
										</div>
									@enderror
								</div>

								<div class="col-md-6">
									<label class="form-label" for="alamat">Alamat</label>
									<input class="form-control @error('alamat') is-invalid @enderror" id="alamat" type="text" name="alamat" value="{{ old('alamat', $customer->alamat) }}" />

									@error('alamat')
										<div class="text-danger">
											{{ $message }}
										</div>
									@enderror
								</div>
							</div>

							@if ($customer->username)
								<div class="row g-3 py-2">
									<div class="col-md-6">
										<label class="form-label" for="username">Username</label>
										<input class="form-control @error('username') is-invalid @enderror" id="username" type="text" name="username" value="{{ old('username', $customer->username) }}" />

										@error('username')
											<div class="text-danger">
												{{ $message }}
											</div>
										@enderror
									</div>
								</div>
							@else
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
							@endif
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