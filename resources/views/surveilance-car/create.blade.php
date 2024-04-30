@extends('layouts.admin.master')

@section('title')Tambah Surveilance Car
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Surveilance Car</h3>
		@endslot
        <li class="breadcrumb-item active"><a href="{{ route('surveilance-car') }}">Surveilance Car</a></li>
        <li class="breadcrumb-item active">Tambah</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Form Tambah Surveilance Car</h5>
					</div>
					<form class="form theme-form" method="POST" action="{{ route('surveilance-car.store') }}" enctype="multipart/form-data">
                        @csrf
						<div class="card-body">
							
							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Nomor Polisi</label>
										<input class="form-control @error('nopol') is-invalid @enderror" type="text" name="nopol" autocomplete="off" value="{{ old('nopol') }}"/>

										@error('nopol')
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
										<label class="form-label" for="">Warna</label>
										<input class="form-control @error('warna') is-invalid @enderror" type="text" name="warna" autocomplete="off" value="{{ old('warna') }}"/>

										@error('warna')
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
										<label class="form-label" for="">Merk</label>
										<input class="form-control @error('merk') is-invalid @enderror" type="text" name="merk" autocomplete="off" value="{{ old('merk') }}"/>

										@error('merk')
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
										<label class="form-label" for="">Kapasitas</label>
										<input class="form-control @error('kapasitas') is-invalid @enderror" type="text" name="kapasitas" autocomplete="off" value="{{ old('kapasitas') }}"/>

										@error('kapasitas')
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
										<label class="form-label" for="">Transmisi</label>
										<select name="transmisi" id="transmisi" class="form-control @error('transmisi') is-invalid @enderror">
											<option value="Manual">Manual</option>
											<option value="Otomatis">Otomatis</option>
										</select>

										@error('transmisi')
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
										<label class="form-label" for="">Bahan Bakar</label>
										<input class="form-control @error('bahan_bakar') is-invalid @enderror" type="text" name="bahan_bakar" autocomplete="off" value="{{ old('bahan_bakar') }}"/>

										@error('bahan_bakar')
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
											<option value="Aktif">Aktif</option>
											<option value="Non-Aktif">Non-Aktif</option>
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
										<label class="form-label" for="">Kondisi</label>
										<select name="kondisi" id="kondisi" class="form-control @error('kondisi') is-invalid @enderror">
											<option value="Baik">Baik</option>
											<option value="Rusak">Rusak</option>
										</select>

										@error('kondisi')
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
										<label class="form-label" for="">Foto Unit</label>
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
							{{-- <button class="btn btn-light" href="{{ route('surveilance-car') }}" type="button">Kembali</button> --}}
							<a href="{{ route('surveilance-car') }}" class="btn btn-light">Kembali</a>
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