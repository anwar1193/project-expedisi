@extends('layouts.admin.master')

@section('title')Perangkat
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Data Perangkat</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('perangkat') }}">Perangkat</a></li>
		<li class="breadcrumb-item active">Table</li>
	@endcomponent

    <nav class="page-breadcrumb">
        <ol class="breadcrumb align-items-center">
            <div class="d-grid gap-2 d-md-block mx-2">
					@if(isAdmin())
                    <a href="{{ route('perangkat.create') }}" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data">
                    	<i class="fa fa-plus"></i> Tambah
                    </a>
					@endif

					<a href="{{ route('perangkat.export-pdf') }}" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Export PDF">
						<i class="fa fa-file-pdf-o"></i> Export PDF
					</a>

					<a href="{{ route('perangkat.export-excel') }}" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Export Excel">
						<i class="fa fa-file-excel-o"></i> Export Excel
					</a>
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
	                                    <th>Kode Perangkat</th>
	                                    <th>Nama Perangkat</th>
	                                    <th>Jenis</th>
	                                    <th>Serial Number</th>
	                                    <th>Kondisi</th>
										<th width="20%" class="text-center">Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                @foreach ($perangkats as $data)
										<tr>
											<td>{{ $loop->iteration; }}</td>
											<td>{{ $data->kode_perangkat }}</td>
											<td>{{ $data->nama_perangkat }}</td>
											<td>{{ $data->nama_jenis }}</td>
											<td>{{ $data->serial_number }}</td>
											<td>{{ $data->kondisi_perangkat }}</td>
											<td class="text-center">
												<a href="{{ route('perangkat.detail', $data->id) }}" class="btn btn-square btn-info btn-xs" data-bs-toggle="tooltip" data-bs-placement="top" title="Detail Data">
													<i class="fa fa-eye"></i>
												</a>

												@if(isAdmin())
												<a href="{{ route('perangkat.edit', $data->id) }}" class="btn btn-square btn-warning btn-xs" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data">
													<i class="fa fa-edit"></i>
												</a>
												
												<a href="{{ route('perangkat.delete', $data->id) }}" class="btn btn-square btn-danger btn-xs" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data" onclick="return confirm('Apakah Anda Yakin?')">
													<i class="fa fa-trash"></i>
												</a>
												@endif
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