@extends('layouts.admin.master')

@section('title')Edit Pembelian Perlengkapan
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Pembelian Perlengkapan</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('pembelian-perlengkapan') }}">Pembelian Perlengkapan</a></li>
        <li class="breadcrumb-item active">Edit</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Form Edit Data Pembelian Perlengkapan</h5>
					</div>
					<form class="form theme-form" method="POST" action="{{ route('pembelian-perlengkapan.update', $pembelian->id) }}">
                        @csrf
						<div class="card-body">
							
							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Nama Perlengkapan</label>
										<select name="id_perlengkapan" id="id_perlengkapan" class="form-control @error('id_perlengkapan') is-invalid @enderror">
											<option value="">- Pilih Nama Perlengkapan -</option>
											@foreach ($perlengkapans as $perlengkapan)
												<option value="{{ $perlengkapan->id }}" {{ $pembelian->id_perlengkapan == $perlengkapan->id ? 'selected' : '' }}>{{ $perlengkapan->nama_perlengkapan }}</option>
											@endforeach
										</select>

										@error('id_perlengkapan')
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
										<label class="form-label" for="">Nama Supplier</label>
										<select name="id_supplier" id="id_supplier" class="form-control @error('id_supplier') is-invalid @enderror">
											<option value="">- Pilih Nama Supplier -</option>
											@foreach ($suppliers as $supplier)
												<option value="{{ $supplier->id }}" {{ $pembelian->id_supplier == $supplier->id ? 'selected' : '' }}>{{ $supplier->nama_supplier }}</option>											
											@endforeach
										</select>

										@error('id_perlengkapan')
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
										<label class="form-label" for="">Jumlah</label>
										<input class="form-control @error('jumlah') is-invalid @enderror" type="number" name="jumlah" autocomplete="off" value="{{ old('jumlah', $pembelian->jumlah) }}"/>

										@error('jumlah')
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
										<label class="form-label" for="">Harga Total</label>
										<input class="form-control @error('harga') is-invalid @enderror" type="number" name="harga" autocomplete="off" value="{{ old('harga', $pembelian->harga) }}"/>

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
										<label class="form-label" for="">Keterangan</label>
										<input class="form-control @error('keterangan') is-invalid @enderror" type="text" name="keterangan" maxlength="255" autocomplete="off" value="{{ old('keterangan', $pembelian->keterangan) }}"/>

										@error('keterangan')
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
										<label class="form-label" for="">Nota Pembelian</label>
										<textarea class="form-control @error('nota') is-invalid @enderror" cols="100" rows="5" name="nota">{{ old('nota', $pembelian->nota) }}</textarea>

										@error('nota')
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
							<a href="{{ route('pembelian-perlengkapan') }}" class="btn btn-light">Kembali</a>
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