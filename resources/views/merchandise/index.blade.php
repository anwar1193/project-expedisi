@extends('layouts.admin.master')

@section('title')Merchandise
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Data Merchandise</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('merchandise') }}">Merchandise</a></li>
		<li class="breadcrumb-item active">Table</li>
	@endcomponent

	@if (isAdmin())
    <nav class="page-breadcrumb">
        <ol class="breadcrumb align-items-center">
            <div class="d-grid gap-2 d-md-block mx-2">
                    <a href="{{ route('merchandise.create') }}" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data">
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
	                                    <th>Nama Merchandise</th>
										<th>Nilai</th>
										@if (isAdmin())
										<th width="20%">Action</th>
										@endif
	                                </tr>
	                            </thead>
	                            <tbody>
	                                @foreach ($data as $data)
										<tr>
											<td>{{ $loop->iteration; }}</td>
											<td>{{ $data->nama }}</td>
											<td>{{ number_format($data->nilai, 0, '.', ',') }}</td>
											@if (isAdmin())
                                                <td class="text-center">

                                                    <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                        <div class="btn-group" role="group">
                                                            <button class="btn btn-secondary btn-sm dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

                                                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modalMerchandise{{ $data->id }}" title="Detail Data"><span><i data-feather="eye"></i> Detail</span></a>

                                                                <a class="dropdown-item" href="{{ route('merchandise.edit', $data->id) }}" ><span><i data-feather="edit"></i> Edit</span></a>

                                                                <a class="dropdown-item" href="{{ route('merchandise.delete', $data->id) }}" onclick="return confirm('Apakah Anda Yakin?')"><span><i data-feather="delete"></i> Delete</span></a>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @include('merchandise.detail')
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