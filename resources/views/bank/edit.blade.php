@extends('layouts.admin.master')

@section('title')Update Bank
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Bank</h3>
		@endslot
        <li class="breadcrumb-item active"><a href="{{ route('bank') }}">Bank</a></li>
        <li class="breadcrumb-item active">Update</li>
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

						<h5>Form Update Bank</h5>
					</div>
					<form class="form theme-form" method="POST" action="{{ route('bank.update') }}" enctype="multipart/form-data">
                        @csrf
						<div class="card-body">
							
							<input type="hidden" name="id" value="{{ $bank->id }}">
							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Nama Bank</label>
										<input class="form-control @error('bank') is-invalid @enderror" type="text" name="bank" autocomplete="off" value="{{ old('bank', $bank->bank) }}"/>

										@error('bank')
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
										<label class="form-label" for="">Nomor Rekening</label>
										<input class="form-control @error('nomor_rekening') is-invalid @enderror" type="text" name="nomor_rekening" autocomplete="off" value="{{ old('nomor_rekening', $bank->nomor_rekening) }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"/>

										@error('nomor_rekening')
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
										<label class="form-label" for="">Atas Nama</label>
										<input class="form-control @error('atas_nama') is-invalid @enderror" type="text" name="atas_nama" autocomplete="off" value="{{ old('atas_nama', $bank->atas_nama) }}"/>

										@error('atas_nama')
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
										<label class="form-label" for="">Cabang</label>
										<input class="form-control @error('cabang') is-invalid @enderror" type="text" name="cabang" autocomplete="off" value="{{ old('cabang', $bank->cabang) }}"/>

										@error('cabang')
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
							{{-- <button class="btn btn-light" href="{{ route('bank') }}" type="button">Kembali</button> --}}
							<a href="{{ route('bank') }}" class="btn btn-light">Kembali</a>
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