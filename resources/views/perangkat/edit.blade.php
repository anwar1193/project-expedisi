@extends('layouts.admin.master')

@section('title')Edit Perangkat
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Perangkat</h3>
		@endslot
        <li class="breadcrumb-item active"><a href="{{ route('perangkat') }}">Perangkat</a></li>
        <li class="breadcrumb-item active">Edit</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Form Edit Perangkat</h5>
					</div>
					<form class="form theme-form" method="POST" action="{{ route('perangkat.update') }}" enctype="multipart/form-data">
                        @csrf
						<div class="card-body">

							<input type="text" name="id" value="{{ $perangkat->id }}" hidden>
							<input type="text" name="old_foto" value="{{ $perangkat->foto }}" hidden>
							
							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Kode Perangkat</label>
										<input class="form-control @error('kode_perangkat') is-invalid @enderror" type="text" name="kode_perangkat" autocomplete="off" value="{{ old('kode_perangkat', $perangkat->kode_perangkat) }}"/>

										@error('kode_perangkat')
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
										<label class="form-label" for="">Nama Perangkat</label>
										<input class="form-control @error('nama_perangkat') is-invalid @enderror" type="text" name="nama_perangkat" autocomplete="off" value="{{ old('nama_perangkat', $perangkat->nama_perangkat) }}"/>

										@error('nama_perangkat')
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
										<label class="form-label" for="">Jenis Perangkat</label>
										<select name="jenis_perangkat" id="jenis_perangkat" class="form-control @error('jenis_perangkat') is-invalid @enderror">
											<option value="">- Pilih Jenis Perangkat -</option>
											@foreach ($jenis_perangkat as $data)
												<option value="{{ $data->kode_jenis }}" {{ $data->kode_jenis == $perangkat->jenis_perangkat ? 'selected' : NULL }}>{{ $data->jenis }}</option>
											@endforeach
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
										<label class="form-label" for="">Serial Number</label>
										<input class="form-control @error('serial_number') is-invalid @enderror" type="text" name="serial_number" autocomplete="off" value="{{ old('serial_number', $perangkat->serial_number) }}"/>

										@error('serial_number')
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
										<label class="form-label" for="">Kondisi Perangkat</label>
										<select name="kondisi_perangkat" id="kondisi_perangkat" class="form-control @error('kondisi_perangkat') is-invalid @enderror">
											<option value="Baik" {{ $perangkat->kondisi_perangkat == 'Baik' ? 'selected' : NULL }}>Baik</option>
											<option value="Rusak" {{ $perangkat->kondisi_perangkat == 'Rusak' ? 'selected' : NULL }}>Rusak</option>
										</select>

										@error('kondisi_perangkat')
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
										<label class="form-label" for="">Foto Perangkat</label>
										<input class="form-control @error('foto') is-invalid @enderror" type="file" width="48" height="48" name="foto" />

										@error('foto')
										<div class="text-danger">
											{{ $message }}
										</div>
										@enderror

										<img src="{{ asset('storage/perangkat/'.$perangkat->foto) }}" alt="" width="200px" class="img-fluid mt-2">
									</div>
								</div>
							</div>

						</div>
						<div class="card-footer text-end">
							<button class="btn btn-primary" type="submit">Update Data</button>
							{{-- <button class="btn btn-light" href="{{ route('surveilance-car') }}" type="button">Kembali</button> --}}
							<a href="{{ route('perangkat') }}" class="btn btn-light">Kembali</a>
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