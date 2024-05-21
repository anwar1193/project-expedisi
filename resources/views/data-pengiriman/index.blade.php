@extends('layouts.admin.master')

@section('title')Data Pengiriman
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Data Pengiriman</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('data-pengiriman') }}">Data Pengiriman</a></li>
		<li class="breadcrumb-item active">Table</li>
	@endcomponent

    <nav class="page-breadcrumb">
        <ol class="breadcrumb align-items-center">
            <div class="d-grid gap-2 d-md-block mx-2">
				
				{{-- <a href="{{ route('data-pengiriman.create') }}" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data">
					<i class="fa fa-plus"></i> Tambah
				</a> --}}

				<a class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modalImport" title="Import Excel">
					<i class="fa fa-file-excel-o"></i> Import Excel
				</a>

				<a href="{{ route('data-pengiriman.truncate') }}" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Truncate Data">
					<i class="fa fa-trash"></i> Truncate
				</a>

				<a class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modalUpdateStatus" title="Update Status Pengiriman">
					<i class="fa fa-file-excel-o"></i> Update Status Pengiriman
				</a>

				@include('data-pengiriman.modal-import')
				@include('data-pengiriman.status-pengiriman', ['status' => $status])
				@include('data-pengiriman.modal-status-pengiriman')

				@if (Session::get('user_level') == 2)
					<form action="{{ route('data-pengiriman.approve-selected') }}" method="post" style="display: inline-block">
						@csrf
						<div class="inner"></div>
						<button type="submit" class="btn btn-success btn-sm" style="display: inline" onclick="return confirm('Approve semua data terpilih?')">
							<i class="fa fa-check-square"></i> Approve Selected
						</button>
					</form>
				@endif

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

						@if ($errors->any())
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								@foreach ($errors->all() as $error)
									<strong>Failed <i class="fa fa-info-circle"></i></strong> 
									{{ $error }}
									<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
									<br>
								@endforeach
							</div>
						@endif
						
						@if (session()->has('errorStatus'))
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Gagal <i class="fa fa-info-circle"></i></strong>
								@foreach(session('errorStatus') as $error)
									<div>{{ $error }}</div>
								@endforeach
								Silahkan  <a class="text-white text-decoration-underline" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modalStatusPengiriman" title="Status Pengiriman">
									<i class="fa fa-eye"></i>lihat di sini.
								</a>
								<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif
	                    
						{{-- Table --}}
						<div class="table-responsive">
	                        <table class="display" id="basic-1">
	                            <thead>
	                                <tr>
	                                    <th>No</th>
										<th>No Resi</th>
										<th>Nama Penerima</th>
	                                    <th>Kota Tujuan</th>
	                                    <th>Metode Pembayaran</th>
	                                    <th>Status Pembayaran</th>
	                                    <th>Status Pengiriman</th>
										
										@if (Session::get('user_level') == 2)
											<th>Pilih</th>
										@endif
										
										<th width="35%" class="text-center">Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>
									
                                    @foreach ($datas as $data)
										@php
											$bukti_pembayaran = $data->bukti_pembayaran;

											if($bukti_pembayaran != ''){
												$explode = explode("/", $bukti_pembayaran);
												$bukti_pembayaran_view = 'https://'.$explode[2].'/thumbnail?id='.$explode[5];
											}else{
												$bukti_pembayaran_view = '#';
											}
										@endphp
										<tr>
											<td>{{ $loop->iteration; }}</td>

											<td>
												<span class="badge badge-danger">
													{{ $data->no_resi }}
												</span>
											</td>

											<td>{{ $data->nama_penerima }}</td>
											<td>{{ $data->kota_tujuan }}</td>
											
											<td onmouseover="showBukti({{ $data->id }})" onmouseout="hideBukti({{ $data->id }})">
												@if ($bukti_pembayaran != '')
													<div id="view-bukti{{ $data->id }}" class="mb-3">
														<img src="{{ $bukti_pembayaran_view }}" alt="test" class="mb-2">
														<a class="btn btn-primary" href="{{ $bukti_pembayaran }}" target="_blank">View Full Image</a>
													</div>
												@endif

												{{ $data->metode_pembayaran }} <i class="{{ $data->metode_pembayaran == 'Transfer' ? 'fa fa-eye' : '' }}"></i>
											</td>

											<td class="text-center">
												<span class="badge {{ $data->status_pembayaran == 1 ? 'badge-primary' : 'badge-warning' }}">
													<i class="fa {{ $data->status_pembayaran == 1 ? 'fa-check' : 'fa-warning' }}"></i>
													{{ $data->status_pembayaran == 1 ? 'Lunas' : 'Pending'; }}
												</span>
											</td>

											<td>{{ $data->status_pengiriman }}</td>

											@if (Session::get('user_level') == 2)
												{{-- Select/Pilih --}}
												<td class="text-center">
													<input type="checkbox" value="5" name="id_pengiriman[]" id="flexCheckDefault" onclick="ceklis({{ $data->id }})">
												</td>
											@endif
											

											<td class="text-center">

												{{-- <a class="btn btn-square btn-warning btn-xs" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#statusPembayaran{{ $data->id }}" title="Edit Status Pembayaran">
													<i class="fa fa-credit-card"></i>
												</a> --}}

												<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
													<div class="btn-group" role="group">
														<button class="btn btn-secondary btn-sm dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
														<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

															@if ($data->metode_pembayaran == 'Transfer' && $data->status_pembayaran != 1 && Session::get('user_level') == 2)
																<a class="dropdown-item" href="{{ route('data-pengiriman.approve', $data->id) }}" onclick="return confirm('Approve Data Pengiriman Ini?')"><span><i data-feather="check-square"></i> Approve</span></a>
															@endif
															
															<a class="dropdown-item" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modalDataPengiriman{{ $data->id }}" title="Detail Data"><span><i data-feather="eye"></i> Detail</span></a>

															<a class="dropdown-item" href="{{ route('data-pengiriman.edit', $data->id) }}"><span><i data-feather="edit"></i> Edit</span></a>

															<a class="dropdown-item" href="{{ route('data-pengiriman.delete', $data->id) }}" onclick="return confirm('Apakah Anda Yakin?')"><span><i data-feather="delete"></i> Delete</span></a>
															
														</div>
													</div>
												</div>
												@include('data-pengiriman.detail')
												@include('data-pengiriman.status-pembayaran')
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
    <script>
		$(document).ready(function() {
			$('#basic-1').DataTable({
				language: {
					"emptyTable": "Tidak ada data yang tersedia pada tabel ini",
					"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
					"infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
					"infoFiltered": " (disaring dari _MAX_ entri keseluruhan)",
					"lengthMenu": "Tampilkan _MENU_ entri",
					"loadingRecords": "Sedang memuat...",
					"processing": "Sedang memproses...",
					"search": "Cari:",
					"zeroRecords": "Tidak ditemukan data yang sesuai",
					"paginate": {
					"first": "Pertama",
					"last": "Terakhir",
					"next": "Selanjutnya",
					"previous": "Sebelumnya"
					},
				},
			});
		})
	</script>
	
	@foreach ($datas as $data)
		<script>
			$('#view-bukti'+{{ $data->id }}).hide();
		</script>
	@endforeach

	<script>
		function showBukti(id) {
			$('#view-bukti'+id).show();
		}

		function hideBukti(id) {
			$('#view-bukti'+id).hide();
		}

		function ceklis(id){
			$('.inner').append("<input type='hidden' value='"+id+"' name='id_pengiriman[]'>");
		}
	</script>
	
	@endpush

@endsection