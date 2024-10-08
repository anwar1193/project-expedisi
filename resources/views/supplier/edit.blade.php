@extends('layouts.admin.master')

@section('title')Edit Data Supplier
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
        <li class="breadcrumb-item active">Edit</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Form Edit Data Supplier</h5>
					</div>
					<form class="form theme-form" method="POST" action="{{ route('supplier.update', $datas->id) }}">
                        @csrf
						<div class="card-body">

							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Nama Supplier</label>
										<input class="form-control @error('nama_supplier') is-invalid @enderror" type="text" name="nama_supplier" autocomplete="off" value="{{ old('nama_supplier', $datas->nama_supplier) }}"/>

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
										<label class="form-label" for="">Nomor Hp</label>
										<input class="form-control @error('nomor_hp') is-invalid @enderror" type="text" name="nomor_hp" autocomplete="off" value="{{ old('nomor_hp', $datas->nomor_hp) }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />

										@error('nomor_hp')
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
										<label class="form-label" for="">Alamat</label>
										<textarea name="alamat" id="alamat" class="form-control">{{ $datas->alamat }}</textarea>

										@error('alamat')
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
										<label class="form-label" for="">Note</label>
										<textarea name="note" id="note" class="form-control">{{ $datas->note }}</textarea>

										@error('note')
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
							<a href="{{ route('supplier') }}" class="btn btn-light">Kembali</a>
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