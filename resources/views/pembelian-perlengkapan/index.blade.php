@extends('layouts.admin.master')

@section('title')Pembelian Perlengkapan
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<style>
	.tooltip-img {
		display: none;
		position: absolute;
		z-index: 1000;
		border: 1px solid #ccc;
		background-color: #fff;
		padding: 10px;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	}
</style>
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Pembelian Perlengkapan</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('pembelian-perlengkapan') }}">Pembelian Perlengkapan</a></li>
		<li class="breadcrumb-item active">Table</li>
	@endcomponent

    <nav class="page-breadcrumb">
        <ol class="breadcrumb align-items-center">
            <div class="d-grid gap-2 d-md-block mx-2">
                {{-- @if (isAdmin()) --}}
                    <a href="{{ route('pembelian-perlengkapan.create') }}" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data">
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
										<th>Tanggal Pembelian</th>
										<th>Nama Perlengkapan</th>
	                                    <th>Nama Supplier</th>
	                                    <th>Harga</th>
	                                    <th>Jumlah</th>
										<th>Nota</th>
										<th width="20%" class="text-center">Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>                                        
                                    @foreach ($datas as $data)
										@php
											$bukti_pembayaran = $data->nota;

											if($bukti_pembayaran != ''){
												$explode = explode("/", $bukti_pembayaran);
												$bukti_pembayaran_view = 'https://'.$explode[2].'/thumbnail?id='.$explode[5];
											}else{
												$bukti_pembayaran_view = '#';
											}
										@endphp
										<tr>
											<td>{{ $loop->iteration; }}</td>
											<td>{{ $data->tanggal_pembelian }}</td>
											<td>{{ $data->nama_perlengkapan }}</td>
											<td>{{ $data->nama_supplier }}</td>
											<td>{{ number_format($data->harga, 0, '.', ',') }}</td>
											<td>{{ $data->jumlah }}</td>	
											<td onmouseover="showBukti({{ $data->id }})" onmouseout="hideBukti({{ $data->id }})" style="position: relative">
												@if ($bukti_pembayaran != '')
													<div id="tooltip{{ $data->id }}" class="tooltip-img">
														<img src="{{ $bukti_pembayaran_view }}" alt="test" width="200px" class="img-fluid mt-2">
														<a class="btn btn-primary" href="{{ $bukti_pembayaran }}" target="_blank">View Full Image</a>
													</div>
												@endif

												<i data-feather="link"></i> Gambar
											</td>
											<td class="text-center">

												<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
													<div class="btn-group" role="group">
														<button class="btn btn-secondary btn-sm dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
														<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

															<a class="dropdown-item" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#pembelianPerlengkapan{{ $data->id }}">
																<span><i data-feather="eye"></i> Detail</span>
															</a>
															
															<a class="dropdown-item" href="{{ route('pembelian-perlengkapan.edit', $data->id) }}"><span><i data-feather="edit"></i> Edit</span></a>

															<a class="dropdown-item" href="{{ route('pembelian-perlengkapan.delete', $data->id) }}" onclick="return confirm('Apakah Anda Yakin?')"><span><i data-feather="delete"></i> Delete</span></a>
															
														</div>
														@include('pembelian-perlengkapan.detail')
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
	@foreach ($datas as $data)
		<script>
			$('#view-bukti'+{{ $data->id }}).hide();
			$('#icon-view'+{{ $data->id }}).show();
		</script>
	@endforeach
	<script>
		function showBukti(id) {
			var tooltip = document.getElementById('tooltip' + id);
			tooltip.style.display = 'block';
		}

		function hideBukti(id) {
			var tooltip = document.getElementById('tooltip' + id);
			tooltip.style.display = 'none';
		}
	</script>
	@endpush

@endsection