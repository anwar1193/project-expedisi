@extends('layouts.admin.master')

@section('title')Edit Data Barang
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Data Barang</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('data-barang') }}">Data Barang</a></li>
        <li class="breadcrumb-item active">Edit</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Form Edit Data Barang</h5>
					</div>
					<form class="form theme-form" method="POST" action="{{ route('data-barang.update', $data->id) }}" enctype="multipart/form-data">
                        @csrf
						<div class="card-body">

							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Nama Barang</label>
										<input class="form-control @error('nama_barang') is-invalid @enderror" type="text" name="nama_barang" autocomplete="off" value="{{ old('nama_barang', $data->nama_barang) }}"/>

										@error('nama_barang')
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
										<label class="form-label" for="">Harga Beli</label>
										<input class="form-control @error('harga_beli') is-invalid @enderror" type="number" name="harga_beli" autocomplete="off" value="{{ old('harga_beli', $data->harga_beli) }}"/>

										@error('harga_beli')
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
										<label class="form-label" for="">Harga Jual</label>
										<input class="form-control @error('harga_jual') is-invalid @enderror" type="number" name="harga_jual" autocomplete="off" value="{{ old('harga_jual', $data->harga_jual) }}"/>

										@error('harga_jual')
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
										<label class="form-label" for="">Stok Awal</label>
										<input class="form-control @error('stok') is-invalid @enderror" type="number" name="stok" autocomplete="off" value="{{ old('stok', $data->stok) }}"/>

										@error('stok')
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
							<a href="{{ route('data-barang') }}" class="btn btn-light">Kembali</a>
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
		document.addEventListener('input', function (e) {
			if (e.target.name === 'harga_beli' || e.target.name === 'harga_jual') {
				const typedValue = e.target.value;
				const formattedValue = new Intl.NumberFormat('id-ID').format(typedValue);
				const displayElement = e.target.parentNode.querySelector('.typed-value');
				
				if (displayElement) {
					displayElement.innerHTML = 'Number Format: <strong>RP. ' + formattedValue + '</strong>';
				} else {
					const newDisplayElement = document.createElement('div');
					newDisplayElement.className = 'typed-value';
					newDisplayElement.innerHTML = 'Number Format: <strong>RP. ' + formattedValue + '</strong>';
					e.target.parentNode.appendChild(newDisplayElement);
				}
			}
		});
	</script>
	@endpush

@endsection