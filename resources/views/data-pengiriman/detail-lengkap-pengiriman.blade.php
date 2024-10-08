@extends('layouts.admin.master')

@section('title')Data Pengiriman
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fixedHeader-datatable.css') }}">
<style>
	body {
		margin: 0;
		padding: 0;
		font-family: Arial, sans-serif;
	}

	.tooltip-img {
		display: none;
		position: absolute;
		z-index: 1000;
		border: 1px solid #ccc;
		background-color: #fff;
		padding: 2px;
		box-shadow: 0 0 2px rgba(0, 0, 0, 0.1);
	}

	input[type="checkbox"] {
		transform: scale(2);
	}

	.content {
        flex: 1;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

	table.dataTable thead th, table.dataTable thead td {
		padding: 10px 18px;
		border-bottom: 1px solid #111;
	}

	.table-container {
        flex: 1;
        overflow: auto;
        max-height: 500px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 8px 12px;
        border: 1px solid #ccc;
        text-align: left;
    }

	.table thead th {
        background-color: #f2f2f2;
        position: sticky;
        top: 0;
        z-index: 1;
    }

	#table-wrapper {
		position: relative;
		margin-bottom: 20px;
	}

    #table-container {
		width: 100%;
		overflow-x: auto;
		white-space: nowrap;
	}

	.scrollbar-container {
		position: fixed;
		bottom: 0;
		left: 0;
		width: 100%;
		height: 20px;
		overflow-x: auto;
		background: #f1f1f1;
		z-index: 1;
	}

	.scrollbar {
		height: 1px;
		width: 100%;
	}
</style>
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Detail Data Pengiriman</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('data-pengiriman') }}">Data Pengiriman</a></li>
		<li class="breadcrumb-item active">Table</li>
	@endcomponent
	
	<nav class="page-breadcrumb">
        <ol class="breadcrumb align-items-center">
            <div class="d-grid gap-2 d-md-block mx-2">

				@if (Session::get('user_level') == 2)
					<form action="{{ route('data-pengiriman.approve-selected') }}" method="post" style="display: inline-block">
						@csrf
						<div class="inner"></div>
						<button name="unapprove" value="unapprove" type="submit" class="btn btn-success btn-sm" style="display: inline" onclick="return confirm('Batalkan Approve semua data terpilih?')">
							<i class="fa fa-check-square"></i> Batalkan Approve Selected
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
						
						@if (session()->has('error') && is_string(session('error')))
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Gagal <i class="fa fa-info-circle"></i></strong> 
								{{ session('error') }}
								<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif


						@if (session()->has('error') && is_array(session('error')))
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Gagal <i class="fa fa-info-circle"></i></strong>
								<ul>
									@foreach (session('error') as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
								<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif

						@if ($errors->any())
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								@foreach ($errors->all() as $error)
									<strong>Gagal <i class="fa fa-info-circle"></i></strong> 
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
						<div class="" id="table-wrapper">
							<div class="table-responsive" id="table-container">
								<form class="d-flex flex-column col-12" role="search" action="" method="GET">
									<div class="d-flex justify-content-end">
										<div id="tanggal">
											<input class="form-control" type="date" name="tanggal" value="{{ request('tanggal') ?? date('d/m/Y', strtotime('-7 day')).' - '.date('d/m/Y') }}" />
										</div>
										<div id="customer_id" class="px-2">
											<select name="customer" class="form-control js-example-basic-single py-2">
												<option value="">- Pilih Customer -</option>
												<option value="General" {{ request('customer') == 'General' ? 'selected' : '' }}>General</option>
												@foreach($customer as $customer)
													<option value="{{ $customer->kode_customer }}" {{ request('customer') == $customer->kode_customer ? 'selected' : '' }}>{{ $customer->kode_customer }} - {{ $customer->nama }}</option>
												@endforeach
											</select>
										</div>
										<div id="customer_id" class="px-2">
											<select name="metode" class="form-control js-example-basic-single py-2">
												<option value="">- Pilih Metode -</option>
												@foreach($metode as $item)
													<option value="{{ $item->metode }}" {{ request('metode') == $item->metode ? 'selected' : '' }}>{{ $item->metode }}</option>
												@endforeach
											</select>
										</div>
										<div id="customer_id" class="px-2">
											<select name="nama_pengirim" class="form-control js-example-basic-single py-2">
												<option value="">- Pilih Nama Pengirim -</option>
												@foreach($nama_pengirim as $item)
													<option value="{{ $item->nama_pengirim }}" {{ request('nama_pengirim') == $item->nama_pengirim ? 'selected' : '' }}>{{ $item->nama_pengirim }}</option>
												@endforeach
											</select>
										</div>
										<div id="customer_id" class="px-2">
											<select name="nama_penerima" class="form-control js-example-basic-single py-2">
												<option value="">- Pilih Nama Penerima -</option>
												@foreach($nama_penerima as $item)
													<option value="{{ $item->nama_penerima }}" {{ request('nama_penerima') == $item->nama_penerima ? 'selected' : '' }}>{{ $item->nama_penerima }}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="d-flex justify-content-end pt-2">
										<div class="px-1">
											<button type="submit" class="btn btn-primary" title="Cari"><i class="fa fa-search"></i> Cari</button>
										</div>
										<div class="px-1">
											<a href="{{ route('data-pengiriman') }}" class="btn btn-md btn-secondary" title="Reset"><i class="fa fa-refresh"></i> Reset</a>
										</div>
									</div>
								</form>
								<table class="display" id="basic-1">
									<thead>
										<tr>
											<th>No</th>
											<th>Action</th>
											@if (Session::get('user_level') == 2)
												<th>
													<input type="checkbox" id="checkAll" title="Pilih Semua">
												</th>
											@endif
											<th>Resi Terkait</th>
											<th>No Resi</th>
											<th>Tanggal Transaksi</th>
											<th>Customer</th>
											<th>Metode Pembayaran</th>
											<th>Status Pembayaran</th>
											<th>Pengirim</th>
											<th>Penerima</th>
											<th>Kota Tujuan</th>
											<th>Bawa Sendiri</th>
											<th>Status Pengiriman</th>
											<th>Ongkir</th>
											<th>Diinput Oleh</th>
										</tr>
									</thead>
									<tbody>
										
										@foreach ($datas as $data)
											@php
												$bukti_pembayaran = $data->bukti_pembayaran;

												if($bukti_pembayaran != ''){
													$explode = explode("/", $bukti_pembayaran);
													$bukti_pembayaran_view = 'https://drive.google.com/file/d/'.$explode[5].'/preview';
												}else{
													$bukti_pembayaran_view = '#';
												}
											@endphp
											<tr>
												<td>{{ $loop->iteration; }}</td>
												<td>
													<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
														<div class="btn-group" role="group">
															<button class="btn btn-secondary btn-sm dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
															<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

																@if (Session::get('user_level') == 2)
																	<a class="dropdown-item" href="{{ route('data-pengiriman.approve', $data->id) }}" onclick="return confirm('Batalkan Approve Data Pengiriman?')"><span><i data-feather="check-square"></i> Approve</span></a>
																@endif
																
																<a class="dropdown-item" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modalDataPengiriman{{ $data->id }}" title="Detail Data"><span><i data-feather="eye"></i> Detail</span></a>
																
															</div>
														</div>
													</div>
													@include('data-pengiriman.detail')
												</td>
												@if (Session::get('user_level') == 2)
													{{-- Select/Pilih --}}
													<td class="text-center">
														<input type="checkbox" value="{{ $data->id }}" class="checkbox-item" id="checkbox-{{ $data->id }}" onclick="ceklis({{ $data->id }})">
													</td>
												@endif
												<td>
													<form method="GET">
														<input type="hidden" name="bukti_pembayaran" value="{{ $data->bukti_pembayaran }}">
														@if ((filter_var($bukti_pembayaran, FILTER_VALIDATE_URL)) && $data->jumlahBuktiPembayaran > 1)
															@if (!$bukti_pembayarans)
																<button type="submit" class="btn btn-secondary">
																	Lihat
																</button>															
															@elseif ($bukti_pembayarans)
																<a href="{{ route('data-pengiriman') }}" class="text-dark btn btn-md btn-secondary" title="Reset"><i class="fa fa-refresh"></i> Kembali</a>
															@endif															
														@endif
													</form>
												</td>
												<td>
													<span class="badge badge-danger">
														{{ $data->no_resi }}
													</span>
												</td>
												<td>{{ date('d-m-Y H:i', strtotime($data->tgl_transaksi)) }}</td>
												<td>
													@if ($data->kode_customer == "General")
														{{ $data->kode_customer }}
													@else
														{{ $data->kode_customer }} - {{ $data->nama }}
													@endif
												</td>
												<td onmouseover="showBukti({{ $data->id }})" onmouseout="hideBukti({{ $data->id }})" style="position: relative;">
													@if ($bukti_pembayaran != '')
														<div id="tooltip{{ $data->id }}" class="tooltip-img">
															<iframe src="{{ $bukti_pembayaran_view }}" width="400" height="400" allow="autoplay"></iframe>
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

												
												<td>{{ $data->nama_pengirim }}</td>
												<td>{{ $data->nama_penerima }}</td>
												<td>{{ $data->kota_tujuan }}</td>
												<td>{{ $data->bawa_sendiri }}</td>
												<td>{{ $data->status_pengiriman }}</td>
												<td>{{ number_format($data->ongkir, 0, '.', ',') }}</td>
												<td>{{ $data->input_by }}</td>
											</tr>
										@endforeach
										
									</tbody>
								</table>
								<div class="mt-3 pt-3 float-end">
									<h5>Total Nilai Transaksi: Rp {{ number_format($total, 0, '.', '.') }}</h5>
								</div>
								
							</div>
						</div>

						<div class="scrollbar-container" id="scrollbar-container">
							<div class="scrollbar"></div>
						</div>

	                </div>
					
	            </div>
	        </div>
	        <!-- Server Side Processing end-->
	    </div>
	</div>
	
	@push('scripts')
	<script src="{{ asset('assets/js/jquery-3.7.1.js') }}"></script>
	<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/js/datatable/datatables/dataTable.fixHeader.js') }}"></script>
	<script src="{{ asset('assets/js/datatable/datatables/fixedHeader.dataTable.js') }}"></script>
	<script src="{{asset('assets/js/tooltip-init.js')}}"></script>
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
					[-1, 10, 25, 50],
					['All', 10, 25, 50]
				],
				fixedHeader: {
					header: true,
					footer: true
				},
				// scrollX: true,
				searching: false
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
			var tooltip = document.getElementById('tooltip' + id);
			tooltip.style.display = 'block';
		}

		function hideBukti(id) {
			var tooltip = document.getElementById('tooltip' + id);
			tooltip.style.display = 'none';
		}
		// function showBukti(id) {
		// 	$('#view-bukti'+id).show();
		// }

		// function hideBukti(id) {
		// 	$('#view-bukti'+id).hide();
		// }

		// function ceklis(id){
		// 	$('.inner').append("<input type='hidden' value='"+id+"' name='id_pengiriman[]'>");
		// }
	</script>
	<script>
        document.addEventListener('DOMContentLoaded', function() {
            const tableContainer = document.getElementById('table-container');
            const scrollbarContainer = document.getElementById('scrollbar-container');
            const scrollbar = document.querySelector('.scrollbar');

            // Synchronize scroll positions
            scrollbarContainer.addEventListener('scroll', function() {
                tableContainer.scrollLeft = scrollbarContainer.scrollLeft;
            });

            tableContainer.addEventListener('scroll', function() {
                scrollba	rContainer.scrollLeft = tableContainer.scrollLeft;
            });

            // Set the width of the scrollbar to match the table content width
            scrollbar.style.width = tableContainer.scrollWidth + 'px';

            // Ensure scrollbar is always visible
            // scrollbarContainer.style.overflowX = 'scroll';
        });
    </script>
	<script>
		$(document).ready(function() {
			$('#checkAll').click(function() {
				if ($(this).is(':checked')) {
					$('.checkbox-item').prop('checked', true);
					$('.checkbox-item').each(function() {
						var id = $(this).val();
						if (!$('.inner input[value="'+id+'"]').length) {
							$('.inner').append("<input type='hidden' value='"+id+"' name='id_pengiriman[]'>");
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
						$('.inner').append("<input type='hidden' value='"+id+"' name='id_pengiriman[]'>");
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
					$('.inner').append("<input type='hidden' value='"+id+"' name='id_pengiriman[]'>");
				}
			} else {
				$('.inner input[value="'+id+'"]').remove();
			}
		}
	</script>
	
	@endpush

@endsection


