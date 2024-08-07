@extends('layouts.admin.master')

@section('title')Bank
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Data Bank</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('bank') }}">Bank</a></li>
		<li class="breadcrumb-item active">Table</li>
	@endcomponent

	@if (isAdmin())
    <nav class="page-breadcrumb">
        <ol class="breadcrumb align-items-center">
            <div class="d-grid gap-2 d-md-block mx-2">
                    <a href="{{ route('bank.create') }}" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data">
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
	                                    <th>Bank</th>
										<th>Nomor Rekening</th>
										<th>Atas Nama</th>
										<th>Cabang</th>
										@if (isAdmin())
										<th width="20%">Action</th>
										@endif
	                                </tr>
	                            </thead>
	                            <tbody>
	                                @foreach ($banks as $data)
										<tr>
											<td>{{ $loop->iteration; }}</td>
											<td>{{ $data->bank }}</td>
											<td>{{ $data->nomor_rekening }}</td>
											<td>{{ $data->atas_nama }}</td>
											<td>{{ $data->cabang }}</td>
											@if (isAdmin())
											<td class="text-center">

												<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
													<div class="btn-group" role="group">
														<button class="btn btn-secondary btn-sm dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
														<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
															<a class="dropdown-item" href="{{ route('bank.edit', $data->id) }}"><span><i class="pt-2 pe-2" data-feather="edit"></i> Edit</span></a>

															<a class="dropdown-item" href="{{ route('bank.delete', $data->id) }}" onclick="return confirm('Apakah Anda Yakin?')"><span><i class="pt-2 pe-2" data-feather="delete"></i> Delete</span></a>
														</div>
													</div>
												</div>

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