@extends('layouts.admin.master')

@section('title')Edit Data Jasa
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Data Jasa</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('data-jasa') }}">Data Jasa</a></li>
        <li class="breadcrumb-item active">Edit</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Form Edit Data Jasa</h5>
					</div>
					<form class="form theme-form" method="POST" action="{{ route('data-jasa.update', $data->id) }}" enctype="multipart/form-data">
                        @csrf
						<div class="card-body">

							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Nama Jasa</label>
										<input class="form-control @error('nama_jasa') is-invalid @enderror" type="text" name="nama_jasa" autocomplete="off" value="{{ old('nama_jasa', $data->nama_jasa) }}"/>

										@error('nama_jasa')
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
										<textarea class="form-control" name="keterangan" id="keterangan">{{ $data->keterangan }}</textarea>

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
							<button class="btn btn-primary" type="submit">Update Data</button>
							<a href="{{ route('data-jasa') }}" class="btn btn-light">Kembali</a>
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