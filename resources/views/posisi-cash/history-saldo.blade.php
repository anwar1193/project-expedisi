@extends('layouts.admin.master')

@section('title')History Saldo
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/date-picker.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>History Saldo</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('posisi-cash') }}">Posisi Cash</a></li>
		<li class="breadcrumb-item active">History Saldo</li>
	@endcomponent

    {{-- <nav class="page-breadcrumb">
        <ol class="breadcrumb align-items-center">
            <div class="d-grid gap-2 d-md-block mx-2">
                <a class="btn btn-danger btn-sm" href="{{ route('posisi-cash.export-saldo') }}">
                    <i class="fa fa-check-square"></i> Download PDF
                </a>
            </div>
        </ol>
    </nav> --}}

	<div class="container-fluid">
		<form class="d-flex flex-column col-12 mb-2" role="search" action="" method="GET">
			<div class="d-flex justify-content-end">
                <div id="customer_id" class="px-2">
					<input class="datepicker-here form-control digits" autocomplete="off" type="text" name="tanggal" value="{{ request('tanggal') ?? date('d/m/Y' , strtotime('-7 day')).' - '.date('d/m/Y') }}" data-range="true" data-multiple-dates-separator=" - " data-language="en" />
                </div>
				<div class="px-1">
					<button type="submit" class="btn btn-primary" title="Cari"><i class="fa fa-search"></i> Cari</button>
				</div>

				<div class="px-1">
					<a href="{{ route('posisi-cash.history-saldo') }}" class="btn btn-md btn-secondary" title="Reset"><i class="fa fa-refresh"></i> Reset</a>
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
	                    
						{{-- Table --}}
						<div class="table-responsive">
	                        <table class="display" id="basic-1">
	                            <thead>
	                                <tr>
	                                    <th width="5%">No</th>
	                                    <th>Jumlah Saldo</th>
										<th>Tanggal</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                @foreach ($saldo as $data)
										<tr>
											<td>{{ $loop->iteration; }}</td>
											<td>{{ 'Rp '.number_format($data->saldo, 0, '.', '.') }} </td>
											<td>{{ $data->tanggal }}</td>
										</tr>
									@endforeach
	                            </tbody>
	                        </table>
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
	<script src="{{ asset('assets/js/datepicker/date-picker/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.en.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker/date-picker/datepicker.custom.js') }}"></script>
	@endpush

@endsection