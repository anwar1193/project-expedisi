@extends('layouts.admin.master')

@section('title')Data Barang Masuk
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Data Barang Masuk</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('data-barang') }}">Master Data Barang</a></li>
		<li class="breadcrumb-item active">Table</li>
	@endcomponent

    <nav class="page-breadcrumb">
        <ol class="breadcrumb align-items-center">
            <div class="d-grid gap-2 d-md-block mx-2">
                {{-- @if (isAdmin()) --}}
					<a href="{{ route('data-pemasukan') }}" class="btn btn-sm btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Kembali">
						<i class="fa fa-backward"></i> Kembali
					</a>

                    <a href="{{ route('data-barang.create') }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data">
                        <i class="fa fa-plus"></i> Tambah Barang
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
										<th>Nama Barang</th>
										<th>Harga Beli</th>
	                                    <th>Harga Jual</th>
	                                    <th>Stok</th>
										<th width="35%" class="text-center">Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>                                        
                                    @foreach ($datas as $data)
									<tr>
										<td>{{ $loop->iteration; }}</td>
										<td>{{ $data->nama_barang }}</td>
										<td>{{ number_format($data->harga_beli, 0, '.', ',') }}</td>
										<td>{{ number_format($data->harga_jual, 0, '.', ',') }}</td>
										<td>{{ $data->stok }}</td>
										<td class="text-center">

											<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
												<div class="btn-group" role="group">
													<button class="btn btn-secondary btn-sm dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
													<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

														<a class="dropdown-item" href="{{ route('data-barang.edit', $data->id) }}" ><span><i data-feather="edit"></i> Edit</span></a>

														<a class="dropdown-item" href="{{ route('data-barang.delete', $data->id) }}" onclick="return confirm('Apakah Anda Yakin?')"><span><i data-feather="delete"></i> Delete</span></a>
														
													</div>
												</div>
											</div>
											@include('data-barang.detail')
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
	@foreach ($datas as $data)
		<script>
			$('#view-bukti'+{{ $data->id }}).hide();
			$('#icon-view'+{{ $data->id }}).show();
		</script>
	@endforeach
	<script>
		function showBukti(id) {
			$('#view-bukti'+id).show();
			$('#icon-view'+id).hide();
		}

		function hideBukti(id) {
			$('#view-bukti'+id).hide();
			$('#icon-view'+id).show();
		}
	</script>
	@endpush

@endsection