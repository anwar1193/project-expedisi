@extends('layouts.admin.master')

@section('title')Pengguna
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Data Pengguna</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('users') }}">Pengguna</a></li>
		<li class="breadcrumb-item active">Table</li>
	@endcomponent

    <nav class="page-breadcrumb">
        <ol class="breadcrumb align-items-center">
            <div class="d-grid gap-2 d-md-block mx-2">
					@if (isAdmin())
						<a href="{{ route('users.create') }}" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data">
							<i class="fa fa-plus"></i> Tambah
						</a>
					@endif

					<a href="{{ route('users.export-pdf') }}" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Export PDF">
						<i class="fa fa-file-pdf-o"></i> Download PDF
					</a>

					{{-- <a href="{{ route('users.export-excel') }}" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Export Excel">
						<i class="fa fa-file-excel-o"></i> Export Excel
					</a> --}}
            </div>
        </ol>
    </nav>
	
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
	                                    <th>No</th>
										<th></th>
	                                    <th>Nama Lengkap</th>
	                                    <th>Username</th>
	                                    <th>Level</th>
	                                    <th>Status</th>
										<th width="20%" class="text-center">Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                @foreach ($users as $data)
										<tr>
											<td>{{ $loop->iteration; }}</td>
											<td>
												<center>
												<img 
													class="rounded-circle d-none d-sm-none d-sm-block d-lg-block pe-1 "
												 	src="{{ $data->foto ? asset('storage/foto_profil/'.$data->foto) : asset('assets/images/avtar/users.png')}}" 
													alt="" 
													style="width: 40px;" /> 
												</center>
											</td>
											<td>{{ $data->nama }}</td>
											<td>{{ $data->username }}</td>
											<td>{{ $data->level_user }}</td>
											<td>{{ $data->status == 1 ? 'Aktif' : 'Non Aktif'; }}</td>
											<td class="text-center">
												<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
													<div class="btn-group" role="group">
														<button class="btn btn-secondary btn-sm dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
														<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

															<a class="dropdown-item" href="{{ route('users.detail', $data->id) }}"><span><i data-feather="eye"></i> Detail</span></a>

															<a class="dropdown-item" href="{{ route('users.edit', $data->id) }}"><span><i data-feather="edit"></i> Edit</span></a>

															<a class="dropdown-item" href="{{ route('users.delete', $data->id) }}" onclick="return confirm('Apakah Anda Yakin?')"><span><i data-feather="delete"></i> Delete</span></a>
															
														</div>
													</div>
												</div>
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