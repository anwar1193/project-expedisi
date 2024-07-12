@extends('layouts.admin.master')

@section('title')Tambah Merchandise
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

						<h5>Form Tambah Merchandise</h5>
					</div>
					<form class="form theme-form" method="POST" action="{{ route('merchandise.store') }}" enctype="multipart/form-data">
                        @csrf
						<div class="card-body">
							
							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Nama Merchandise</label>
										<input class="form-control @error('nama') is-invalid @enderror" type="text" name="nama" autocomplete="off" value="{{ old('nama') }}"/>

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
										<input class="form-control @error('nilai') is-invalid @enderror" type="number" placeholder="0" name="nilai" autocomplete="off" value="{{ old('nilai') }}"/>

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
										<input class="form-control @error('gambar') is-invalid @enderror" type="file" width="48" height="48" name="gambar" />
                                        <div id="nominal" class="form-text text-danger">*Maximun Size 10 Mb</div>

										@error('gambar')
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
		document.addEventListener('input', function (e) {
			if (e.target.name === 'nilai') {
				const typedValue = e.target.value;
				const formattedValue = new Intl.NumberFormat('id-ID').format(typedValue);
				const displayElement = e.target.parentNode.querySelector('.typed-value');
				
				if (displayElement) {
					displayElement.innerHTML = '<strong>' + formattedValue + ' point</strong>';
				} else {
					const newDisplayElement = document.createElement('div');
					newDisplayElement.className = 'typed-value';
					newDisplayElement.innerHTML = '<strong>' + formattedValue + ' point</strong>';
					e.target.parentNode.appendChild(newDisplayElement);
				}
			}
		});
	</script>
	@endpush

@endsection