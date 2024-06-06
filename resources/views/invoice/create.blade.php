@extends('layouts.admin.master')

@section('title')Tambah Invoice
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Invoice</h3>
		@endslot
        <li class="breadcrumb-item active"><a href="{{ route('invoices.create') }}">Invoice</a></li>
        <li class="breadcrumb-item active">Tambah</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						@if (session()->has('error'))
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Gagal <i class="fa fa-info-circle"></i></strong> 
								{{ session('error') }}
								<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif

						<h5>Create Invoice</h5>
					</div>
					<form class="form theme-form" method="POST" action="{{ route('invoices.generate') }}" enctype="multipart/form-data">
                        @csrf
						<div class="card-body">
							
							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Pilih Customer</label>
										
										<select name="customer" id="customer" class="form-control @error('customer') is-invalid @enderror">
											<option value="">- Pilih Customer -</option>
											@foreach ($customer as $item)
												<option value="{{ $item->id }}" {{ old('nama') == $item->nama ? 'selected' : '' }}>
													{{ $item->kode_customer }} - {{ $item->nama }}
												</option>
											@endforeach
										</select>

										@error('customer')
										<div class="text-danger">
											{{ $message }}
										</div>
										@enderror
									</div>
								</div>
							</div>

						</div>
						<div class="card-footer text-end">
							<button class="btn btn-primary" type="submit">Generate Invoice</button>
							{{-- <button class="btn btn-light" href="{{ route('jenis-pengeluaran') }}" type="button">Kembali</button> --}}
							{{-- <a href="{{ route('jenis-pengeluaran') }}" class="btn btn-light">Kembali</a> --}}
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