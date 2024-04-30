@extends('layouts.admin.master')

@section('title')Edit Jenis Perangkat
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Jenis Perangkat</h3>
		@endslot
        <li class="breadcrumb-item active"><a href="{{ route('jenis-perangkat') }}">Jenis Perangkat</a></li>
        <li class="breadcrumb-item active">Edit</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Form Edit Jenis Perangkat</h5>
					</div>
					<form class="form theme-form" method="POST" action="{{ route('jenis-perangkat.update') }}" enctype="multipart/form-data">
                        @csrf
						<div class="card-body">

                            <input type="text" name="id" value="{{ $jenis_perangkat->id }}" hidden>
							
							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Kode Jenis</label>
										<input class="form-control @error('kode_jenis') is-invalid @enderror" type="text" name="kode_jenis" autocomplete="off" value="{{ old('kode_jenis', $jenis_perangkat->kode_jenis) }}"/>

										@error('kode_jenis')
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
										<label class="form-label" for="">Jenis</label>
										<input class="form-control @error('jenis') is-invalid @enderror" type="text" name="jenis" autocomplete="off" value="{{ old('jenis', $jenis_perangkat->jenis) }}"/>

										@error('jenis')
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
							{{-- <button class="btn btn-light" href="{{ route('jenis-perangkat') }}" type="button">Kembali</button> --}}
							<a href="{{ route('jenis-perangkat') }}" class="btn btn-light">Kembali</a>
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