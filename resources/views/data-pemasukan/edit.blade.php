@extends('layouts.admin.master')

@section('title')Edit Data Pemasukan
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Data Pemasukan</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('data-pemasukan') }}">Data Pemasukan</a></li>
        <li class="breadcrumb-item active">Edit</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Form Edit Data Pemasukan</h5>
					</div>
					<form class="form theme-form" method="POST" action="{{ route('data-pemasukan.update', $datas->id) }}" enctype="multipart/form-data">
                        @csrf
						<div class="card-body">

							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Kategori</label>
										<input class="form-control @error('kategori') is-invalid @enderror" type="text" name="kategori" autocomplete="off" value="{{ old('kategori', $datas->kategori) }}"/>

										@error('kategori')
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
										<label class="form-label" for="">Nama Customer</label>
										<input class="form-control @error('nama_customer') is-invalid @enderror" type="text" name="nama_customer" autocomplete="off" value="{{ old('nama_customer', $datas->nama_customer) }}"/>

										@error('nama_customer')
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
										<input class="form-control @error('harga') is-invalid @enderror" type="number" name="harga" autocomplete="off" value="{{ old('harga', $datas->harga) }}"/>

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
										<label class="form-label" for="">Tanggal Transaksi</label>
										<input class="form-control @error('tanggal_transaksi') is-invalid @enderror" type="text" name="tanggal_transaksi" autocomplete="off" value="{{ $datas->tanggal_transaksi }}" readonly/>

										@error('tanggal_transaksi')
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
										<label class="form-label" for="">Komisi</label>
										<input class="form-control @error('komisi') is-invalid @enderror" type="number" name="komisi" autocomplete="off" value="{{ old('komisi', $datas->komisi) }}"/>

										@error('komisi')
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
							<a href="{{ route('data-pemasukan') }}" class="btn btn-light">Kembali</a>
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