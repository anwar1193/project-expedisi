@extends('layouts.admin.master')

@section('title')Customer
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Customer</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('customers.index') }}">Customer</a></li>
		<li class="breadcrumb-item active">Table</li>
	@endcomponent

    <nav class="page-breadcrumb">
        <ol class="breadcrumb align-items-center">
            <div class="d-grid gap-2 d-md-block mx-2">
                {{-- @if (isAdmin()) --}}
                    <a href="{{ route('customers.create') }}" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data">
                        <i class="fa fa-plus"></i> Tambah
                    </a>
                {{-- @endif --}}
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
										<th>Nama</th>
										<th>No Whatsapp</th>
	                                    <th>Email</th>
	                                    <th>Limit Kredit</th>
	                                    <th>Point</th>
										<th width="20%" class="text-center">Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>                                        
                                    @foreach ($customers as $data)
										<tr>
											<td>{{ $loop->iteration; }}</td>
											<td>{{ $data->nama }}</td>
											<td>{{ $data->no_wa }}</td>
											<td>{{ $data->email }}</td>

											<td class="text-center">
												<span class="badge badge-primary">
													{{ 'Rp '.number_format($data->limit_credit, 0, '.', ',') }}
												</span>
											</td>

											<td class="text-center">
												<span class="badge badge-primary">
													{{ $data->point }}
												</span>
											</td>

											<td class="text-center">

												<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
													<div class="btn-group" role="group">
														<button class="btn btn-secondary btn-sm dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
														<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

															@if (Session::get('user_level') == 2)
																<a class="dropdown-item" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#customerLimitKredit{{ $data->id }}">
																	<span><i class="pt-2 pe-2" data-feather="tag"></i> Limit Kredit</span>
																</a>
																
																<a class="dropdown-item" href="{{ route('customers.historyLimit', $data->id) }}"><span><i class="pt-2 pe-2" data-feather="list"></i> History Limit</span></a>

															@endif

															<a class="dropdown-item" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#customer{{ $data->id }}">
																<span><i class="pt-2 pe-2" data-feather="eye"></i> Detail</span>
															</a>
															
															<a class="dropdown-item" href="{{ route('customers.edit', $data->id) }}"><span><i class="pt-2 pe-2" data-feather="edit"></i> Edit</span></a>

															<a class="dropdown-item" href="{{ route('customers.delete', $data->id) }}" onclick="return confirm('Apakah Anda Yakin?')"><span><i class="pt-2 pe-2" data-feather="delete"></i> Delete</span></a>
															
														</div>
														@include('customers.detail')
														@include('customers.limit_kredit')
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