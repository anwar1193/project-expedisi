@extends('layouts.admin.master')

@section('title')Data Pengiriman
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fixedHeader-datatable.css') }}">
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
			<h3>Detail Data Pengiriman</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('data-pengiriman') }}">Data Pengiriman</a></li>
		<li class="breadcrumb-item active">Table</li>
	@endcomponent
	
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
						<div class="table-responsive">
							<form class="d-flex flex-column col-12" role="search" action="" method="GET">
								<div class="d-flex justify-content-end">
									<div id="tanggal">
										<input class="form-control" type="date" name="tanggal" value="{{ request('tanggal') }}" />
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
											<td>{{ date('d-m-Y', strtotime($data->tgl_transaksi)) }}</td>
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
														<img src="{{ $bukti_pembayaran_view }}" alt="Bukti Pembayaran" width="200px" class="img-fluid mt-2">
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
					[10, 25, 50, -1],
					[10, 25, 50, 'All']
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


