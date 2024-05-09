@extends('layouts.admin.master')

@section('title')Edit Perlengkapan
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Perlengkapan</h3>
		@endslot
        <li class="breadcrumb-item active"><a href="{{ route('perlengkapan') }}">Perlengkapan</a></li>
        <li class="breadcrumb-item active">Edit</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Form Edit Perlengkapan</h5>
					</div>
					<form class="form theme-form" method="POST" action="{{ route('perlengkapan.update') }}" enctype="multipart/form-data">
                        @csrf
						<div class="card-body">

                            <input type="text" name="id" value="{{ $perlengkapan->id }}" hidden>
							
							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Perlengkapan</label>
										<input class="form-control @error('nama_perlengkapan') is-invalid @enderror" type="text" name="nama_perlengkapan" autocomplete="off" value="{{ old('nama_perlengkapan', $perlengkapan->nama_perlengkapan) }}"/>

										@error('nama_perlengkapan')
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
										<input class="form-control @error('keterangan') is-invalid @enderror" type="text" name="keterangan" autocomplete="off" value="{{ old('keterangan', $perlengkapan->keterangan) }}"/>

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
							{{-- <button class="btn btn-light" href="{{ route('perlengkapan') }}" type="button">Kembali</button> --}}
							<a href="{{ route('perlengkapan') }}" class="btn btn-light">Kembali</a>
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