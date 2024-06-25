@extends('layouts.admin.master')

@section('title')Penukaran Point
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Penukaran Point</h3>
		@endslot
        <li class="breadcrumb-item active">Penukaran Point</li>
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

						<h5>Tukar Point</h5>
					</div>
					<form class="form theme-form" method="GET" action="{{ route('penukaran-point') }}">
                        @csrf
						<div class="card-body">
							
							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Pilih Customer</label>
										
										<select name="id" id="id" class="form-control @error('customer') is-invalid @enderror">
											<option value="">- Pilih Customer -</option>
											@foreach ($customers as $item)
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
							<button class="btn btn-primary" type="submit">Tampilkan</button>
							<a href="{{ route('penukaran-point') }}" class="btn btn-secondary">Reset</a>
						</div>
					</form>
				</div>
			</div>
		</div>
        @if (request('id'))
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header fw-bold pb-0">Data Customer Terpilih</div>
                    <div class="card-body">
                        <div class="row invo-profile py-2" style="border: 0.5px solid; width: 70%">
                            <div class="col-xl-8">
                                <div class="text-xl-start" id="project">
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-4 col-lg-4">Kode Customer</div>
                                        <div class="col-1 col-lg-2">:</div>
                                        <div class="col-6 col-lg-6 text-capitalize">{{ $customer->kode_customer }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-4 col-lg-4">Nama Customer</div>
                                        <div class="col-1 col-lg-2">:</div>
                                        <div class="col-6 col-lg-6 text-capitalize">{{ $customer->nama }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-4 col-lg-4">Point</div>
                                        <div class="col-1 col-lg-2">:</div>
                                        <div class="col-6 col-lg-6 text-capitalize">{{ $customer->point }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row py-2 my-2 text-center d-flex justify-content-center">
                            <div class="py-3 mb-2 text-start">
                                <h5>Daftar Merchandise</h5>
                            </div>
                            @foreach ($merchandise as $data)
                                <div class="card px-2 mx-3 text-center" style="width: 18rem;">
                                    <img src="{{ asset('storage/merchandise/'.$data->gambar) }}" style="height: 150px" class="card-img-top" alt="...">
                                    <div class="card-body">
                                    <p class="card-title">{{ $data->nama }}</p>
                                    <p class="card-text">{{ number_format($data->nilai, 0, '.', ',') }} point</p>
                                    <a href="#" class="btn btn-primary">Tukar</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
	</div>
	
	
	@push('scripts')
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
	@endpush

@endsection