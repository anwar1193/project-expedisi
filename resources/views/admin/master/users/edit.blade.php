@extends('layouts.admin.master')

@section('title')Edit Pengguna
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
        <li class="breadcrumb-item active">Edit</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Form Edit Pengguna</h5>
					</div>
					<form class="form theme-form" method="POST" action="{{ route('users.update') }}" enctype="multipart/form-data">
                        @csrf
						<div class="card-body">

							@if (session()->has('error'))
								<div class="alert alert-danger alert-dismissible fade show" role="alert">
									<strong>Gagal <i class="fa fa-info-circle"></i></strong> 
									{{ session('error') }}
									<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
							@endif

							<input type="text" name="id" value="{{ $user->id }}" hidden>
							<input type="text" name="old_foto" value="{{ $user->foto }}" hidden>

							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Nama</label>
										<input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama" autocomplete="off" value="{{ old('nama', $user->nama) }}"/>

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
										<input class="form-control @error('username') is-invalid @enderror" type="text" name="username" autocomplete="off" value="{{ old('username', $user->username) }}"/>

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
										<input class="form-control @error('email') is-invalid @enderror" type="text" type="email" name="email" autocomplete="off" value="{{ old('email', $user->email) }}"/>

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
										<label class="form-label" for="">Nomor Telepon (Contoh: 08xxxxxxxxxx)</label>
										<input class="form-control @error('nomor_telepon') is-invalid @enderror" type="text" placeholder="Contoh: 08xxxxxxxx" type="text" name="nomor_telepon" autocomplete="off" value="{{ old('nomor_telepon', $user->nomor_telepon) }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />

										@error('email')
										<div class="text-danger">
											{{ $message }}
										</div>
										@enderror
									</div>
								</div>
							</div>

							<div class="row" style="display: {{ $user->user_level != 3 ? 'block' : 'none' }}">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">User Level</label>
										<select name="user_level" id="user_level" class="form-control @error('user_level') is-invalid @enderror js-example-basic-single">
											<option value="">- Pilih Level -</option>
											@foreach ($levels as $item)
												<option value="{{ $item->id }}" {{ $user->user_level == $item->id ? 'selected' : NULL }}>
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
										<label class="form-label" for="">Status</label>
										<select name="status" id="status" class="form-control @error('status') is-invalid @enderror js-example-basic-single">
											<option value="1" {{ $user->status == 1 ? 'selected' : NULL }}>Aktif</option>
											<option value="0" {{ $user->status == 0 ? 'selected' : NULL }}>Non-Aktif</option>
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
										<label class="form-label" for="">Password Baru</label>
										<input name="password_baru" class="form-control @error('password_baru') is-invalid @enderror" type="password" autocomplete="off" value="{{ old('password_baru') }}"/>

										@error('password_baru')
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
										<label class="form-label" for="">Konfirmasi Password Baru</label>
										<input name="password_baru_confirmation" class="form-control @error('password_baru_confirmation') is-invalid @enderror" type="password" autocomplete="off"/>

										@error('password_baru_confirmation')
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

										<img src="{{ asset('storage/foto_profil/'.$user->foto) }}" alt="" width="200px" class="img-fluid mt-2">
									</div>
								</div>
							</div>

						</div>
						<div class="card-footer text-end">
							<button class="btn btn-primary" type="submit">Update Data</button>
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