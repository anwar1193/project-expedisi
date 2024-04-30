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

							<input type="text" name="id" value="{{ $user->id }}" hidden>
							<input type="text" name="old_foto" value="{{ $user->foto }}" hidden>
							
							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Kode Satker</label>
										<input class="form-control @error('kode_satker') is-invalid @enderror" type="text" name="kode_satker" autocomplete="off" value="{{ old('kode_satker', $user->kode_satker) }}"/>

										@error('kode_satker')
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
										<label class="form-label" for="">Satker</label>
										<input class="form-control @error('nama_satker') is-invalid @enderror" type="text" name="nama_satker" autocomplete="off" value="{{ old('nama_satker', $user->nama_satker) }}"/>

										@error('nama_satker')
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
										<label class="form-label" for="">NIP</label>
										<input class="form-control @error('nip') is-invalid @enderror" type="text" name="nip" autocomplete="off" value="{{ old('nip', $user->nip) }}"/>

										@error('nip')
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
										<label class="form-label" for="">Nomor Telepon</label>
										<input class="form-control @error('nomor_telepon') is-invalid @enderror" type="text" type="text" name="nomor_telepon" autocomplete="off" value="{{ old('nomor_telepon', $user->nomor_telepon) }}"/>

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
										<label class="form-label" for="">User Level</label>
										<select name="user_level" id="user_level" class="form-control @error('user_level') is-invalid @enderror">
											<option value="">- Pilih Level -</option>
											@foreach ($levels as $item)
												<option value="{{ $item->kode_level }}" {{ $user->user_level == $item->kode_level ? 'selected' : NULL }}>
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
										<select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
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
								<div class="col-4">
									<div class="mb-3">
										<label class="form-label" for="">Tanggal Kadaluarsa</label>
										<input type="date" class="form-control @error('kadaluarsa') is-invalid @enderror"" name="kadaluarsa" value="{{ old('kadaluarsa', $user->tgl_kadaluarsa) }}">

										@error('kadaluarsa')
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