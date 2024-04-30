@extends('layouts.admin.master')

@section('title')Hak Akses Pengguna
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Hak Akses Pengguna</h3>
		@endslot
		<li class="breadcrumb-item active">Pengaturan</li>
		<li class="breadcrumb-item active"><a href="{{ route('hak-akses') }}">Hak Akses</a></li>
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
	                    
						{{-- Table --}}
						<div class="table-responsive">
	                        <table class="display" id="basic-1">
	                            <thead>
	                                <tr>
	                                    <th>No</th>
	                                    <th>Nama Lengkap</th>
	                                    <th>Level</th>
	                                    <th>Status</th>
										<th class="text-center">Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                @foreach ($user as $data)
										<tr>
											<td>{{ $loop->iteration; }}</td>
											<td> {{ $data->nama }}</td>
											<td>{{ $data->nama_level }}</td>
											<td><span class="badge {{ $data->status == 1 ? 'bg-success' : 'bg-danger' }}">{{ $data->status == 1 ? 'Aktif' : 'Non Aktif' }}</span></td>
											<td class="text-center">
                                                <a class="btn btn-square btn-warning btn-xs" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal{{ $data->id }}" data-bs-placement="top" title="Update">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                @include('components.form-hak-akses')
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