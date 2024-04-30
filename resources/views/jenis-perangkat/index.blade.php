@extends('layouts.admin.master')

@section('title')Jenis Perangkat
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Data Jenis Perangkat</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('jenis-perangkat') }}">Jenis Perangkat</a></li>
		<li class="breadcrumb-item active">Table</li>
	@endcomponent

	@if (isAdmin())
    <nav class="page-breadcrumb">
        <ol class="breadcrumb align-items-center">
            <div class="d-grid gap-2 d-md-block mx-2">
                    <a href="{{ route('jenis-perangkat.create') }}" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data">
                        <i class="fa fa-plus"></i> Tambah
                    </a>
            </div>
        </ol>
    </nav>
	@endif
	
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
	                                    <th width="5%">No</th>
	                                    <th>Kode Jenis</th>
	                                    <th>Jenis Perangkat</th>
										@if (isAdmin())
										<th width="20%">Action</th>
										@endif
	                                </tr>
	                            </thead>
	                            <tbody>
	                                @foreach ($jenis_perangkats as $data)
										<tr>
											<td>{{ $loop->iteration; }}</td>
											<td>{{ $data->kode_jenis }}</td>
											<td>{{ $data->jenis }}</td>
											@if (isAdmin())
											<td>
												<a href="{{ route('jenis-perangkat.edit', $data->id) }}" class="btn btn-square btn-warning btn-xs" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data">
													<i class="fa fa-edit"></i>
												</a>
												
												<a href="{{ route('jenis-perangkat.delete', $data->id) }}" class="btn btn-square btn-danger btn-xs" onclick="return confirm('Apakah Anda Yakin?')" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data">
													<i class="fa fa-trash"></i>
												</a>
											</td>
											@endif
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