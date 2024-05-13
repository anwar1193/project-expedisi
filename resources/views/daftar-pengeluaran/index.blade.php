@extends('layouts.admin.master')

@section('title')Daftar Pengeluaran
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Daftar Pengeluaran</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('daftar-pengeluaran') }}">Daftar Pengeluaran</a></li>
		<li class="breadcrumb-item active">Table</li>
	@endcomponent

    <nav class="page-breadcrumb">
        <ol class="breadcrumb align-items-center">
            <div class="d-grid gap-2 d-md-block mx-2">
                {{-- @if (isAdmin()) --}}
                    <a href="{{ route('daftar-pengeluaran.create') }}" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data">
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
										<th>Tanggal Pengeluaran</th>
										<th>Keterangan</th>
	                                    <th>Jumlah Pembayaran</th>
	                                    <th>Yang Menerima Pembayaran</th>
	                                    <th>Status Pengeluaran</th>
	                                    <th>Jenis Pengeluaran</th>
										<th width="35%" class="text-center">Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>                                        
                                    @foreach ($datas as $data)
										<tr>
											<td>{{ $loop->iteration; }}</td>
											<td>{{ $data->tgl_pengeluaran }}</td>
											<td>{{ $data->keterangan }}</td>
											<td>{{ number_format($data->jumlah_pembayaran, 0, '.', ',') }}</td>
											<td>{{ $data->yang_menerima }}</td>
											<td>
												<span class="badge {{ $data->status_pengeluaran == 1 ? 'badge-primary' : 'badge-warning' }}">
													<i class="fa {{ $data->status_pengeluaran == 1 ? 'fa-check' : 'fa-warning' }}"></i>
													{{ $data->status_pengeluaran == 1 ? 'Disetujui' : 'Pending'; }}
												</span>
											</td>
											<td>{{ $data->jenis_pengeluaran }}</td>
											<td class="text-center">

												<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
													<div class="btn-group" role="group">
														<button class="btn btn-secondary btn-sm dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
														<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

															@if ($data->status_pengeluaran != 1 && Session::get('user_level') == 2)
																<a class="dropdown-item" href="{{ route('daftar-pengeluaran.approve', $data->id) }}" onclick="return confirm('Approve Data Pengeluaran Ini?')"><span><i data-feather="check-square"></i> Approve</span></a>
															@endif

															<a class="dropdown-item" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modalDataPengiriman{{ $data->id }}" title="Detail Data"><span><i data-feather="eye"></i> Detail</span></a>

															<a class="dropdown-item" href="{{ route('daftar-pengeluaran.edit', $data->id) }}"><span><i data-feather="edit"></i> Edit</span></a>

															@if (Session::get('user_level') == 1)
																<a class="dropdown-item" href="{{ route('daftar-pengeluaran.delete', $data->id) }}" onclick="return confirm('Apakah Anda Yakin?')"><span><i data-feather="delete"></i> Delete</span></a>
															@endif
															
														</div>
													</div>
												</div>
												@include('daftar-pengeluaran.detail')
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