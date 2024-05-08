@extends('layouts.admin.master')

@section('title')Tambah Supplier
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Supplier</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('supplier') }}">Supplier</a></li>
        <li class="breadcrumb-item active">Tambah</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Form Supplier</h5>
					</div>
					<form class="form theme-form" method="POST" action="{{ route('supplier.store') }}">
                        @csrf
						<div class="card-body">
							
							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Nama Supplier</label>
										<input class="form-control @error('nama_supplier') is-invalid @enderror" type="text" name="nama_supplier" autocomplete="off" value="{{ old('nama_supplier') }}"/>

										@error('nama_supplier')
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
										<label class="form-label" for="">Keterangan Barang</label>
										<input class="form-control @error('keterangan_barang') is-invalid @enderror" type="text" name="keterangan_barang" autocomplete="off" value="{{ old('keterangan_barang') }}"/>

										@error('keterangan_barang')
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
										<label class="form-label" for="">Harga</label>
										<input class="form-control @error('harga') is-invalid @enderror" type="number" name="harga" autocomplete="off" value="{{ old('harga') }}"/>

										@error('harga')
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
										<label class="form-label" for="">Jumlah Barang</label>
										<input class="form-control @error('jumlah_barang') is-invalid @enderror" type="number" name="jumlah_barang" autocomplete="off" value="{{ old('jumlah_barang') }}"/>

										@error('jumlah_barang')
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
										<label class="form-label" for="">Nomor Hp</label>
										<input class="form-control @error('nomor_hp') is-invalid @enderror" type="text" name="nomor_hp" autocomplete="off" value="{{ old('nomor_hp') }}"/>

										@error('nomor_hp')
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
							<a href="{{ route('data-pengiriman') }}" class="btn btn-light">Kembali</a>
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