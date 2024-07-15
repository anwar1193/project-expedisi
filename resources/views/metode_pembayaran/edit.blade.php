@extends('layouts.admin.master')

@section('title')Update Metode Pembayaran
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Metode Pembayaran</h3>
		@endslot
        <li class="breadcrumb-item active"><a href="{{ route('metode_pembayaran') }}">Metode Pembayaran</a></li>
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

						<h5>Form Update Metode Pembayaran</h5>
					</div>
					<form class="form theme-form" method="POST" action="{{ route('metode_pembayaran.update') }}" enctype="multipart/form-data">
                        @csrf
						<div class="card-body">
							
							<input type="hidden" name="id" value="{{ $metode_pembayaran->id }}">
							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Metode Pembayaran</label>
										<input class="form-control @error('metode') is-invalid @enderror" type="text" name="metode" autocomplete="off" value="{{ old('metode', $metode_pembayaran->metode) }}"/>

										@error('metode')
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
										<label class="form-label" for="">Keterangan</label>
										<textarea name="keterangan" id="keterangan" class="form-control">{{ $metode_pembayaran->keterangan }}</textarea>

										@error('keterangan')
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
							<a href="{{ route('metode_pembayaran') }}" class="btn btn-light">Kembali</a>
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