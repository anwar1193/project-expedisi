@extends('layouts.admin.master')

@section('title')Tambah Pengguna
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Pengguna</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('users') }}">Pengguna</a></li>
        <li class="breadcrumb-item active">Tambah</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Form Tambah Pengguna</h5>
					</div>
					<form class="form theme-form" method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
                        @csrf
						<div class="card-body">

							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Nama</label>
										<input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama" autocomplete="off" value="{{ old('nama') }}"/>

										@error('nama')
										<div class="text-danger">
											{{ $message }}
										</div>
										@enderror
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Username</label>
										<input class="form-control @error('username') is-invalid @enderror" type="text" name="username" autocomplete="off" value="{{ old('username') }}"/>

										@error('username')
										<div class="text-danger">
											{{ $message }}
										</div>
										@enderror
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Email</label>
										<input class="form-control @error('email') is-invalid @enderror" type="text" type="email" name="email" autocomplete="off" value="{{ old('email') }}"/>

										@error('email')
										<div class="text-danger">
											{{ $message }}
										</div>
										@enderror
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Nomor Telepon</label>
										<input class="form-control @error('nomor_telepon') is-invalid @enderror" type="text" type="text" placeholder="Contoh: 08xxxxxxxxxx" name="nomor_telepon" autocomplete="off" value="{{ old('nomor_telepon') }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />

										@error('nomor_telepon')
										<div class="text-danger">
											{{ $message }}
										</div>
										@enderror
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">User Level</label>
										<select name="user_level" id="user_level" class="form-control @error('user_level') is-invalid @enderror js-example-basic-single">
											<option value="">- Pilih Level -</option>
											@foreach ($levels as $item)
												<option value="{{ $item->id }}" {{ old('user_level') == $item->id ? 'selected' : '' }}>
													{{ $item->level }}
												</option>
											@endforeach
										</select>

										@error('user_level')
										<div class="text-danger">
											{{ $message }}
										</div>
										@enderror
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Password</label>
										<input name="password" class="form-control @error('password') is-invalid @enderror" type="password" autocomplete="off" value="{{ old('password') }}"/>

										@error('password')
										<div class="text-danger">
											{{ $message }}
										</div>
										@enderror
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Konfirmasi Password</label>
										<input name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" type="password" autocomplete="off"/>

										@error('password_confirmation')
										<div class="text-danger">
											{{ $message }}
										</div>
										@enderror
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Status</label>
										<select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
											<option value="1">Aktif</option>
											<option value="0">Non-Aktif</option>
										</select>

										@error('status')
										<div class="text-danger">
											{{ $message }}
										</div>
										@enderror
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Foto</label>
										<input class="form-control @error('foto') is-invalid @enderror" type="file" width="48" height="48" name="foto" />

										@error('foto')
										<div class="text-danger">
											{{ $message }}
										</div>
										@enderror
									</div>
								</div>
							</div>

						</div>
						<div class="card-footer text-end">
							<button class="btn btn-primary" type="submit">Simpan Data</button>
							{{-- <button class="btn btn-light" href="{{ route('users') }}" type="button">Kembali</button> --}}
							<a href="{{ route('users') }}" class="btn btn-light">Kembali</a>
							{{-- <input class="btn btn-light" type="button" value="Cancel" /> --}}
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	
	@push('scripts')
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
	@endpush

@endsection