@extends('layouts.admin.master')

@section('title')Edit Merchandise
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Merchandise</h3>
		@endslot
        <li class="breadcrumb-item active"><a href="{{ route('merchandise') }}">Merchandise</a></li>
        <li class="breadcrumb-item active">Edit</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Form Edit Merchandise</h5>
					</div>
					<form class="form theme-form" method="POST" action="{{ route('merchandise.update', $data->id) }}" enctype="multipart/form-data">
                        @csrf
						<div class="card-body">							
							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Nama Merchandise</label>
										<input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama" autocomplete="off" value="{{ old('nama', $data->nama) }}"/>

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
										<label class="form-label" for="">Nilai</label>
										<input class="form-control @error('nilai') is-invalid @enderror" type="text" name="nilai" autocomplete="off" value="{{ old('nilai', $data->nilai) }}"/>

										@error('nilai')
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
										<label class="form-label" for="">Gambar</label>
										<input class="form-control @error('gambar') is-invalid @enderror" type="file" width="48" height="48" name="foto" />

										@error('gambar')
										<div class="text-danger">
											{{ $message }}
										</div>
										@enderror

                                        <img src="{{ asset('storage/merchandise/'.$data->gambar) }}" alt="" width="200px" class="img-fluid mt-2">
									</div>
								</div>
							</div>

						</div>
						<div class="card-footer text-end">
							<button class="btn btn-primary" type="submit">Simpan Data</button>
							{{-- <button class="btn btn-light" href="{{ route('jenis-pengeluaran') }}" type="button">Kembali</button> --}}
							<a href="{{ route('jenis-pengeluaran') }}" class="btn btn-light">Kembali</a>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
			const nominalInput = document.querySelector('input[name="nilai"]');
			const displayElement = document.createElement('div');
			displayElement.innerHTML = '<strong>' + new Intl.NumberFormat('id-ID').format(nominalInput.value) + ' point</strong>';
			nominalInput.parentNode.appendChild(displayElement);

			nominalInput.addEventListener('input', function() {
				const typedValue = nominalInput.value;
				displayElement.innerHTML = '<strong>' + new Intl.NumberFormat('id-ID').format(typedValue) + ' point</strong>';
			});
		});
    </script>
	@endpush

@endsection