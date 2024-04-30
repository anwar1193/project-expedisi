@extends('layouts.admin.master')

@section('title')OBD II Tracker
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Data OBD II Tracker</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('surveilance-car') }}">OBD II Tracker</a></li>
		<li class="breadcrumb-item active">Table</li>
	@endcomponent
	
	<div class="container-fluid">
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
	                                    <th>No</th>
	                                    <th>Merk</th>
	                                    <th>Serial Number</th>
	                                    <th>Armada</th>
	                                    <th>Nopol</th>
	                                    <th>Status Engine</th>
										<th width="20%">Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                @foreach ($items as $data)
										<tr>
											<td>{{ $loop->iteration; }}</td>
											<td>{{ $data->merk }}</td>
											<td class="text-uppercase">{{ $data->serial_number }}</td>
											<td>{{ $data->cars_merk ? $data->cars_merk : "-" }}</td>
											<td>{{ $data->nopol ? $data->nopol : "-" }}</td>
											<td>{{ $data->car_id ? ($data->engine_status == 1 ?  "ON" : "OFF") : "-"  }}</td>
											<td>
												@if (!$data->car_id)
													<a class="btn btn-square btn-success btn-xs" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal{{ $data->id }}">
														Hubungkan
													</a>
												@else
													<a class="btn btn-square btn-danger btn-xs" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#lepasModal{{ $data->id }}">
														Lepaskan
													</a>
													<a class="btn btn-square btn-{{ $data->engine_status == 1 ? "danger" : "success" }} btn-xs" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#switchModal{{ $data->id }}">
														{{ $data->engine_status == 1 ? "Matikan" : "Hidupkan" }}
													</a>
												@endif
												
												@include('obd-tracker.component.form-hubungkan')
												@include('obd-tracker.component.form-lepaskan')
												@include('obd-tracker.component.modal-switch')
											</td>
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
	@endpush

@endsection