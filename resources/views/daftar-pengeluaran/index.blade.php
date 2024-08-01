@extends('layouts.admin.master')

@section('title')Daftar Pengeluaran
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<style>
    .dataTables_wrapper {
        overflow-x: auto;
    }
	.select2-container--default .select2-selection--single .select2-selection__rendered {
		background-color: black;
	}

	.tooltip-img {
		display: none;
		position: absolute;
		z-index: 1000;
		border: 1px solid #ccc;
		background-color: #fff;
		padding: 10px;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	}

	input[type="checkbox"] {
		transform: scale(2);
	}
</style>
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
                    <a href="{{ route('daftar-pengeluaran.create') }}" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data">
                        <i class="fa fa-plus"></i> Tambah
                    </a>

					@if (Session::get('user_level') == 2)
					<form action="{{ route('data-pengeluaran.approve-selected') }}" method="post" style="display: inline-block">
						@csrf
						<div class="inner"></div>
						<button type="submit" class="btn btn-success btn-sm" style="display: inline" onclick="return confirm('Approve semua data terpilih?')">
							<i class="fa fa-check-square"></i> Approve Selected
						</button>
					</form>
					{{-- <form action="{{ route('data-pengeluaran.unapprove-selected') }}" method="post" style="display: inline-block">
						@csrf
						<div class="inner"></div>
						<button type="submit" class="btn btn-danger btn-sm" style="display: inline" onclick="return confirm('Approve semua data terpilih?')">
							<i class="fa fa-check-square"></i> Cancel Approve Selected
						</button>
					</form> --}}
				@endif
                {{-- @endif --}}
            </div>
        </ol>
    </nav>
	
	<div class="container-fluid">
		<form class="d-flex flex-column col-12 mb-2" role="search" action="" method="GET">
			<div class="d-flex justify-content-end">
                <div id="customer_id" class="px-2">
                    <select name="kategori" class="form-control js-example-basic-single py-2">
                        <option value="">Pilih Kategori</option>
                        @foreach($jenis_pengeluaran as $item)
                            <option value="{{ $item->id }}" {{ request('kategori') == $item->id ? 'selected' : '' }}>{{ $item->jenis_pengeluaran }}</option>
                        @endforeach
                    </select>
                </div>
				<div class="px-1">
					<button type="submit" class="btn btn-primary" title="Cari"><i class="fa fa-search"></i> Cari</button>
				</div>
				<div class="px-1">
					<a href="{{ route('daftar-pengeluaran') }}" class="btn btn-md btn-secondary" title="Reset"><i class="fa fa-refresh"></i> Reset</a>
				</div>
			</div>
		</form>
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
										<th>Metode Pembayaran</th>
	                                    <th>Yang Melakukan Pembayaran</th>

	                                    <th>Status Pengeluaran</th>
	                                    <th>Bukti Pembayaran</th>

										@if (Session::get('user_level') == 2)
											<th class="text-center">
												<input type="checkbox" id="checkAll" title="Pilih Semua">
											</th>
										@endif

										<th width="35%" class="text-center">Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>                                        
                                    @foreach ($datas as $data)
										@php
											$bukti_pembayaran = $data->bukti_pembayaran;

											if (strpos($bukti_pembayaran, 'https://drive.google.com/file/d/') !== false) {
												$explode = explode("/", $bukti_pembayaran);
												$bukti_pembayaran_view = 'https://' . $explode[2] . '/thumbnail?id=' . $explode[5];
											} elseif (pathinfo($bukti_pembayaran, PATHINFO_EXTENSION) != '') {
												$bukti_pembayaran_view = asset('storage/daftar-pengeluaran/'.$data->bukti_pembayaran);
											} else {
												$bukti_pembayaran_view = '#';
											}
										@endphp
										<tr>
											<td>{{ $loop->iteration; }}</td>
											<td>{{ $data->tgl_pengeluaran }}</td>
											<td>{{ $data->keterangan }}</td>
											<td>{{ number_format($data->jumlah_pembayaran, 0, '.', ',') }}</td>
											<td>{{ $data->yang_menerima }}</td>
											<td>{{ $data->metode_pembayaran }}</td>
											<td>{{ $data->yang_membayar }}</td>
											<td>
												<span class="badge {{ $data->status_pengeluaran == 1 ? 'badge-primary' : 'badge-warning' }}">
													<i class="fa {{ $data->status_pengeluaran == 1 ? 'fa-check' : 'fa-warning' }}"></i>
													{{ $data->status_pengeluaran == 1 ? 'Disetujui' : 'Pending'; }}
												</span>
											</td>
											<td onmouseover="showBukti({{ $data->id }})" onmouseout="hideBukti({{ $data->id }})" style="position: relative;">
												@if ($data->bukti_pembayaran != '')
													<div id="tooltip{{ $data->id }}" class="tooltip-img">
														<img src="{{ $bukti_pembayaran_view }}" alt="" width="200px" class="img-fluid mt-2">
														<a class="btn btn-primary" href="{{ $bukti_pembayaran_view }}" target="_blank">View Image</a>
													</div>
												@endif
												<div id="icon-view{{ $data->id }}">
													<i data-feather="link"></i> Gambar
												</div>
												
											</td>

											@if (Session::get('user_level') == 2)
												{{-- Select/Pilih --}}
												<td class="text-center">
													<input type="checkbox" value="{{ $data->id }}" class="checkbox-item" id="checkbox-{{ $data->id }}" onclick="ceklis({{ $data->id }})">
												</td>
											@endif
											<td class="text-center">

												<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
													<div class="btn-group" role="group">
														<button class="btn btn-secondary btn-sm dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
														<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

															@if ($data->status_pengeluaran != 1 && Session::get('user_level') == 2)
																<a class="dropdown-item" href="{{ route('daftar-pengeluaran.approve', $data->id) }}" onclick="return confirm('Approve Data Pengeluaran Ini?')"><span><i data-feather="check-square"></i> Approve</span></a>
															@endif

															<a class="dropdown-item" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modalDataPengiriman{{ $data->id }}" title="Detail Data"><span><i data-feather="eye"></i> Detail</span></a>

															@if ($data->status_pengeluaran != 1)
																<a class="dropdown-item" href="{{ route('daftar-pengeluaran.edit', $data->id) }}" ><span><i data-feather="edit"></i> Edit</span></a>
															@endif

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
				lengthMenu: [
					[10, 25, 50, -1],
					[10, 25, 50, 'All']
				],
                scrollX: true,
			});
		})
	</script>	
	<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    {{-- <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script> --}}
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
		// function showBukti(id) {
		// 	$('#view-bukti'+id).show();
		// 	$('#icon-view'+id).hide();
		// }

		// function hideBukti(id) {
		// 	$('#view-bukti'+id).hide();
		// 	$('#icon-view'+id).show();
		// }

		// function ceklis(id){
		// 	$('.inner').append("<input type='hidden' value='"+id+"' name='id_pengeluaran[]'>");
		// }
	</script>
	<script>
		$(document).ready(function() {
			$('#checkAll').click(function() {
				if ($(this).is(':checked')) {
					$('.checkbox-item').prop('checked', true);
					$('.checkbox-item').each(function() {
						var id = $(this).val();
						if (!$('.inner input[value="'+id+'"]').length) {
							$('.inner').append("<input type='hidden' value='"+id+"' name='id_pengeluaran[]'>");
						}
					});
				} else {
					$('.checkbox-item').prop('checked', false);
					$('.inner').empty();
				}
			});

			$('.checkbox-item').change(function() {
				var id = $(this).val();
				if ($(this).is(':checked')) {
					if (!$('.inner input[value="'+id+'"]').length) {
						$('.inner').append("<input type='hidden' value='"+id+"' name='id_pengeluaran[]'>");
					}
				} else {
					$('.inner input[value="'+id+'"]').remove();
				}
			});
		});

		function ceklis(id) {
			var checkbox = $('#checkbox-' + id);
			if (checkbox.is(':checked')) {
				if (!$('.inner input[value="'+id+'"]').length) {
					$('.inner').append("<input type='hidden' value='"+id+"' name='id_pengeluaran[]'>");
				}
			} else {
				$('.inner input[value="'+id+'"]').remove();
			}
		}
	</script>
	@endpush

@endsection