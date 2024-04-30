@extends('layouts.admin.master')

@section('title')Log Aktifitas
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Data Log Aktifitas</h3>
		@endslot
		<li class="breadcrumb-item active">Log Aktifitas</li>
	@endcomponent

    {{-- <nav class="page-breadcrumb">
        <ol class="breadcrumb align-items-center">
            <div class="d-grid gap-2 d-md-block mx-2">
                    <a href="{{ route('users.create') }}" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data">
                        Tambah Pengguna
                    </a>
            </div>
        </ol>
    </nav> --}}
	
	<div class="container-fluid">
        <div class="row">
        </div>
	    <div class="row">
	        <!-- Server Side Processing start-->
	        <div class="col-sm-12">
	            <div class="card">
	                <div class="card-body">

						<div class="tombol-export mb-3">
							<a href="{{ route('log-activity.export-pdf') }}" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data">
								<i class="fa fa-file-pdf-o"></i> Export PDF
							</a>

							<a href="{{ route('log-activity.export-excel') }}" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data">
								<i class="fa fa-file-excel-o"></i> Export Excel
							</a>
						</div>
	                    
						{{-- Table --}}
						<div class="table-responsive">
	                        <table class="display" id="basic-1">
	                            <thead>
	                                <tr>
	                                    <th>No</th>
	                                    <th>Username</th>
	                                    <th>Activity</th>
	                                    <th>IP Address</th>
	                                    <th>Browser</th>
	                                    <th>Log Time</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                @foreach ($log_activities as $data)
										<tr>
											<td>{{ $loop->iteration; }}</td>
											<td>{{ $data->username }}</td>
											<td>{{ $data->activity }}</td>
											<td>{{ $data->ip_address }}</td>
											<td>{{ $data->browser }}</td>
											<td>{{ $data->log_time }}</td>
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