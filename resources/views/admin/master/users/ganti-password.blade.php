@extends('layouts.admin.master')

@section('title')Ganti Password
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
        <li class="breadcrumb-item active">Ganti Password</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Form Ganti Password</h5>
					</div>
					<form class="form theme-form" method="POST" action="{{ route('ganti-password.proses') }}" enctype="multipart/form-data">
                        @csrf
						<div class="card-body">

                            @if (session()->has('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Berhasil <i class="fa fa-info-circle"></i></strong> 
                                    {{ session('success') }}
                                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session()->has('failed'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Gagal <i class="fa fa-info-circle"></i></strong> 
                                    {{ session('failed') }}
                                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Nama</label>
										<input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama" autocomplete="off" value="{{ Session::get('nama') }}" readonly/>

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
										<input class="form-control @error('username') is-invalid @enderror" type="text" name="username" autocomplete="off" value="{{ Session::get('username') }}" readonly/>

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
										<label class="form-label" for="">Password Lama</label>
										<input name="password_lama" class="form-control @error('password_lama') is-invalid @enderror" type="password" autocomplete="off" value="{{ old('password_lama') }}"/>

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

						</div>
						<div class="card-footer text-end">
							<button class="btn btn-primary" type="submit">Ubah Password</button>
							{{-- <button class="btn btn-light" href="{{ route('users') }}" type="button">Kembali</button> --}}
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