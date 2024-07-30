@extends('layouts.admin.master')

@section('title')Data Pemasukan
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
			<h3>Data Pemasukan</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('data-pemasukan') }}">Data Pemasukan</a></li>
		<li class="breadcrumb-item active">Table</li>
	@endcomponent

    <nav class="page-breadcrumb">
        <ol class="breadcrumb align-items-center">
            <div class="d-grid gap-2 d-md-block mx-2">
                {{-- @if (isAdmin()) --}}
                    <a href="{{ route('data-pemasukan.create') }}" class="btn btn-sm btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data">
                        <i class="fa fa-plus"></i> Tambah Pemasukan
                    </a>

					{{-- <a href="{{ route('data-barang') }}" class="btn btn-sm btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Data Barang">
                        <i class="fa fa-cube"></i> Data Barang
                    </a> --}}

					<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
						<div class="btn-group" role="group">
							<button class="btn btn-success btn-sm dropdown-toggle" id="btnGroupDropBarang" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-cube"></i> Data Barang</button>
							<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

								<a class="dropdown-item" href="{{ route('data-barang') }}" ><span>Master Data</span></a>
								<a class="dropdown-item" href="{{ route('barang-masuk') }}" ><span>Barang Masuk</span></a>
								
							</div>
						</div>
					</div>

					<a href="{{ route('data-jasa') }}" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Data Jasa">
                        <i class="fa fa-male"></i> Data Jasa
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
										<th>Tanggal Pemasukan</th>
										<th>Barang/Jasa</th>
										<th>Keterangan</th>
	                                    <th>Jumlah Pemasukan</th>
	                                    <th>Sumber Pemasukan</th>
	                                    <th>Bukti Pembayaran</th>
	                                    <th>No Resi Pengiriman</th>
										<th width="35%" class="text-center">Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>                                        
                                    @foreach ($datas as $data)
									<tr>
										<td>{{ $loop->iteration; }}</td>
										<td>{{ $data->tgl_pemasukkan }}</td>
										<td>
											@if ($data->kategori == 'barang')
												{{ HApp::namaBarang($data->barang_jasa) }}
											@else
												{{ HApp::namaJasa($data->barang_jasa) }}
											@endif
											{{-- {{ $data->barang_jasa }} --}}
										</td>
										<td>{{ $data->keterangan }}</td>
										<td>{{ number_format($data->jumlah_pemasukkan, 0, '.', ',') }}</td>
										<td>{{ $data->sumber_pemasukkan }}</td>
										<td onmouseover="showBukti({{ $data->id }})" onmouseout="hideBukti({{ $data->id }})" style="position: relative; ">
											@if ($data->bukti_pembayaran != '')
												<div id="tooltip{{ $data->id }}" class="tooltip-img">
													<img src="{{ asset('storage/data-pemasukkan/'.$data->bukti_pembayaran) }}" alt="" width="200px" class="img-fluid mt-2">
													<a class="btn btn-primary" href="{{ asset('storage/data-pemasukkan/'.$data->bukti_pembayaran)}}" target="_blank">View Image</a>
												</div>
											@endif
											<div id="icon-view{{ $data->id }}">
												<i data-feather="link"></i> Gambar
											</div>
											
										</td>

										<td>{{ $data->no_resi_pengiriman }}</td>

										<td class="text-center">

											<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
												<div class="btn-group" role="group">
													<button class="btn btn-secondary btn-sm dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
													<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

														<a class="dropdown-item" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modalDataPemasukkan{{ $data->id }}" title="Detail Data"><span><i data-feather="eye"></i> Detail</span></a>

														<a class="dropdown-item" href="{{ route('data-pemasukan.edit', $data->id) }}" ><span><i data-feather="edit"></i> Edit</span></a>
														
														<a class="dropdown-item" href="{{ route('tanda-terima.export-pdf', $data->id) }}" ><span><i data-feather="file"></i> Cetak Tanda Terima</span></a>

														@if (Session::get('user_level') == 1)
															<a class="dropdown-item" href="{{ route('data-pemasukan.delete', $data->id) }}" onclick="return confirm('Apakah Anda Yakin?')"><span><i data-feather="delete"></i> Delete</span></a>
														@endif
														
													</div>
												</div>
											</div>
											@include('data-pemasukan.detail')
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