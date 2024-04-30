@extends('layouts.admin.master')

@section('title')Login Terakhir Pengguna
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Data Login Terakhir Pengguna</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('users') }}">Login Terakhir Pengguna</a></li>
		<li class="breadcrumb-item active">Table</li>
	@endcomponent

    {{-- <nav class="page-breadcrumb">
        <ol class="breadcrumb align-items-center">
            <div class="d-grid gap-2 d-md-block mx-2">
					@if (isAdmin())
						<a href="{{ route('users.create') }}" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data">
							<i class="fa fa-plus"></i> Tambah
						</a>
					@endif

					<a href="{{ route('users.export-pdf') }}" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Export PDF">
						<i class="fa fa-file-pdf-o"></i> Export PDF
					</a>

					<a href="{{ route('users.export-excel') }}" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Export Excel">
						<i class="fa fa-file-excel-o"></i> Export Excel
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
	                    
						{{-- Table --}}
						<div class="table-responsive">
	                        <table class="display" id="basic-1">
	                            <thead>
	                                <tr>
	                                    <th>No</th>
                                        <th width="20%" class="text-center">Login Terakhir</th>
	                                    <th>Nama Lengkap</th>
	                                    <th>NIP</th>
	                                    <th>Username</th>
	                                    <th>Level</th>
	                                    <th>Status</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                @foreach ($users as $data)
										<tr>
											<td>{{ $loop->iteration; }}</td>
                                            <td class="text-center">
												{{ $data->last_login }}
											</td>
											<td>{{ $data->nama }}</td>
											<td>{{ $data->nip }}</td>
											<td>{{ $data->username }}</td>
											<td>{{ $data->level_user }}</td>
											<td>{{ $data->status == 1 ? 'Aktif' : 'Non Aktif'; }}</td>
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