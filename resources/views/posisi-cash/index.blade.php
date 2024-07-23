@extends('layouts.admin.master')
@include('posisi-cash.pemasukan')
@include('posisi-cash.pengeluaran')

@section('title')Posisi Cash
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Posisi Cash</h3>
		@endslot
		<li class="breadcrumb-item active">Posisi Cash</li>
	@endcomponent
	
	<div class="container-fluid">
		<form class="d-flex flex-column col-12 mb-2" role="search" action="" method="GET">
			<div class="d-flex justify-content-end">
                <div id="customer_id" class="px-2">
                    <input class="form-control" type="date" name="tanggal" value="{{ $tanggal }}" />
                </div>
				<div class="px-1">
					<button type="submit" class="btn btn-primary" title="Cari"><i class="fa fa-search"></i> Cari</button>
				</div>
				<div class="px-1">
					<a href="{{ route('posisi-cash') }}" class="btn btn-md btn-secondary" title="Reset"><i class="fa fa-refresh"></i> Reset</a>
				</div>
			</div>
		</form>
        <div class="row">
        </div>
	    <div class="row">
	        <!-- Server Side Processing start-->
	        <div class="col-sm-12">
	            <div class="card">
	                <div class="card-body">
                        @if (session()->has('success'))
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>Berhasil <i class="fa fa-info-circle"></i></strong> 
								{{ session('success') }}
								<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif

						@if (session()->has('delete'))
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Berhasil <i class="fa fa-info-circle"></i></strong> 
								{{ session('delete') }}
								<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif
						
						@if (session()->has('error'))
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Gagal <i class="fa fa-info-circle"></i></strong> 
								{{ session('error') }}
								<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif

                        <div class="row ps-3 ms-3 pt-3 mt-3">
							<div class="col-xl-4 col-md-4 col-sm-4 box-col-4 des-xl-25 rate-sec">
								<a class="text-white" href="{{ route('posisi-cash.history-saldo') }}">
									<div class="card shadow-lg" style="width: 18rem; border-radius:15px; background-color: rgb(219, 176, 55)">
										<div class="card-body fw-bold">
											<div class="row">
												<div class="col-4 d-flex align-items-center"><h1><i class="icofont icofont-sale-discount"></i></h1></div>
												<div class="col">
													<div class="row"><h5 class="fw-bold">Total Saldo</h5></div>
													<div class="row"><h5 class="fw-bold">{{ 'Rp '.number_format($saldo, 0, '.', '.') }}</h5></div>
												</div>
											</div>

										{{-- <h5 class="card-title pb-3 text-center fw-bold">Total Saldo</h5>
										<h4><i class="icofont icofont-sale-discount"></i></h4>
										<h3 class="fw-bold">{{ 'Rp '.number_format($saldo, 0, '.', '.') }}</h3> --}}
										</div>
									</div>
								</a>
                              </div>
                              <div class="col-xl-4 col-md-4 col-sm-4 box-col-4 des-xl-25 rate-sec">
								<a class="text-white"  href="{{ route('posisi-cash.history-pemasukan') }}">
									<div class="card shadow-lg" style="width: 18rem; border-radius:15px; background-color: rgb(33, 174, 47)">
										<div class="card-body fw-bold">
											<div class="row">
												<div class="col-4 d-flex align-items-center"><h1><i class="icofont icofont-arrow-up"></i></h1></div>
												<div class="col">
													<div class="row"><h5 class="fw-bold">Pemasukkan</h5></div>
													<div class="row"><h5 class="fw-bold">{{ 'Rp '.number_format($pemasukan->total ?? 0, 0, '.', '.') }}</h5></div>
												</div>
											</div>
										</div>
									</div>
								</a>
                              </div>
                              <div class="col-xl-4 col-md-4 col-sm-4 box-col-4 des-xl-25 rate-sec">
								<a class="text-white"  href="{{ route('posisi-cash.history-pengeluaran') }}">
									<div class="card shadow-lg" style="width: 18rem; border-radius:15px; background-color: rgb(200, 75, 75)">
										<div class="card-body text-center fw-bold">
											<div class="row">
												<div class="col-4 d-flex align-items-center"><h1><i class="icofont icofont-arrow-down"></i></h1></div>
												<div class="col">
													<div class="row"><h5 class="fw-bold">Pengeluaran</h5></div>
													<div class="row"><h5 class="fw-bold">{{ 'Rp '.number_format($pengeluaran->total ?? 0, 0, '.', '.') }}</h5></div>
												</div>
											</div>
										</div>
									</div>
								</a>
                              </div>
                        </div>
	                </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-evenly">
							@if ($tanggal == date('Y-m-d'))
								<form action="{{ route('posisi-cash.closing') }}" method="POST">
									@csrf
									<input type="hidden" name="saldo" value="{{ $saldo }}">
									<input type="hidden" name="tanggal" value="{{ $tanggal }}">
									<button class="btn btn-secondary" type="submit" onclick="return confirm('Apakah Anda Yakin?')">Closing</button>
								</form>
							@endif
                            <button class="btn btn-secondary" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#pemasukan">Input Pemasukan</button>
                            <button class="btn btn-secondary" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#pengeluaran">Input Pengeluaran</button>
                        </div>
                    </div>
	            </div>
	        </div>
	        <!-- Server Side Processing end-->
	    </div>
	</div>
	
	@push('scripts')
	<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
    <script>
		document.addEventListener('DOMContentLoaded', function() {
			const jumlahPembayaranInput = document.querySelector('input[id="pemasukan"]');
			const displayElement = document.createElement('div');
			displayElement.innerHTML = '<strong>RP. ' + new Intl.NumberFormat('id-ID').format(jumlahPembayaranInput.value) + '</strong>';
			jumlahPembayaranInput.parentNode.appendChild(displayElement);

			jumlahPembayaranInput.addEventListener('input', function() {
				const typedValue = jumlahPembayaranInput.value;
				displayElement.innerHTML = '<strong>RP. ' + new Intl.NumberFormat('id-ID').format(typedValue) + '</strong>';
			});
		});
		document.addEventListener('DOMContentLoaded', function() {
			const jumlahPembayaranInput = document.querySelector('input[id="pengeluaran"]');
			const displayElement = document.createElement('div');
			displayElement.innerHTML = '<strong>RP. ' + new Intl.NumberFormat('id-ID').format(jumlahPembayaranInput.value) + '</strong>';
			jumlahPembayaranInput.parentNode.appendChild(displayElement);

			jumlahPembayaranInput.addEventListener('input', function() {
				const typedValue = jumlahPembayaranInput.value;
				displayElement.innerHTML = '<strong>RP. ' + new Intl.NumberFormat('id-ID').format(typedValue) + '</strong>';
			});
		});
	</script>
	@endpush

@endsection