@extends('layouts.admin.master')

@section('title')All Invoices
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<style>
	.dataTables_filter {
		display: none;
	}

	input[type="checkbox"] {
		transform: scale(2);
	}
</style>
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Data All Invoices</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('jenis-pengeluaran') }}">Invoices</a></li>
		<li class="breadcrumb-item active">Table</li>
	@endcomponent

	<nav class="page-breadcrumb">
        <ol class="breadcrumb align-items-center">
            <div class="d-grid gap-2 d-md-block mx-2">

				@if (isOwner())
					<form action="{{ route('invoice.approve-selected') }}" method="post" style="display: inline-block">
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
        <form class="d-flex flex-column col-12" role="search" action="" method="GET">
			<div class="d-flex justify-content-end">
                <div id="customer_id">
                    <input class="form-control" type="date" name="tanggal" value="" />
                </div>
                <div id="customer_id" class="px-2">
                    <select name="customer_id" class="form-control py-2">
                        <option value="">- Pilih Customer -</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div id="status" class="px-2">
                    <select name="status" class="form-control py-2">
                        <option value="">- Pilih Status -</option>
						<option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Lunas</option>
						<option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Belum Lunas</option>
					</select>
                </div>
				<div class="px-1">
					<button type="submit" class="btn btn-primary" title="Cari"><i class="fa fa-search"></i> Cari</button>
				</div>
				<div class="px-1">
					<a href="{{ route('invoices.index') }}" class="btn btn-md btn-secondary" title="Reset"><i class="fa fa-refresh"></i> Reset</a>
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
	                                    <th width="5%">No</th>
	                                    <th>No Invoice</th>
	                                    <th>Total Tagihan</th>
	                                    <th>Sisa Tagihan</th>
	                                    <th>Tanggal Cetak</th>
										<th>Kode Customer</th>
										<th>Nama Customer</th>
										<th>Status Pembayaran</th>
										<th>Status</th>
										@if (isOwner())
											<th class="text-center">
												<input type="checkbox" id="checkAll" title="Pilih Semua">
											</th>
										@endif
										<th width="20%">Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                @foreach ($data as $data)
										<tr>
											<td>{{ $loop->iteration; }}</td>
											<td>
												<a class="text-light" href="{{ route('invoice.hasil-transaksi', ['id' => $data->id, 'invoiceId' => $data->invoiceId]) }}">
													{{ $data->invoice_no }}
												</a>
											</td>
											<td>Rp {{ number_format($data->totalBersih, 0, '.', '.') }}</td>
											<td>Rp {{ number_format($data->sisa, 0, '.', '.') }}</td>
											<td>{{ formatTanggalIndonesia($data->created_at) }}</td>
											<td>{{ $data->kode_customer }}</td>
											<td>{{ $data->nama }}</td>
											<td class="text-center">
												<span class="badge {{ $data->sisa == 0 ? 'badge-primary' : 'badge-warning' }}">
													<i class="fa {{ $data->sisa == 0 ? 'fa-check' : 'fa-warning' }}"></i>
													{{ $data->sisa == 0 ? 'Lunas' : 'Belum Lunas'; }}
												</span>
											</td>
											<td class="text-center">
												<span class="badge {{ $data->status == 1 ? 'badge-primary' : 'badge-warning' }}">
													<i class="fa {{ $data->status == 1 ? 'fa-check' : 'fa-warning' }}"></i>
													{{ $data->status == 1 ? 'Approved' : 'Pending'; }}
												</span>
											</td>
											@if (isOwner())
												<td class="text-center">
													<input type="checkbox" value="{{ $data->invoiceId }}" class="checkbox-item" id="checkbox-{{ $data->invoiceId }}" onclick="ceklis({{ $data->invoiceId }})">
												</td>
											@endif
											<td>
												<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
													<div class="btn-group" role="group">
														<button class="btn btn-secondary btn-sm dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
														<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
															@if ($data->status != 1 && isOwner())
																<a class="dropdown-item" href="{{ route('invoice.approve', $data->invoiceId) }}" onclick="return confirm('Approve Data Invoice?')"><span><i class="pt-2 pe-2" data-feather="check-square"></i> Approve</span></a>
															@endif
															
															<a class="dropdown-item" href="{{ route('invoice.hasil-transaksi', ['id' => $data->id, 'invoiceId' => $data->invoiceId]) }}">
																<span><i class="pt-2 pe-2" data-feather="eye"></i> Detail</span>
															</a>

															@if (isOwner())
																<a class="dropdown-item" href="{{ route('invoice.delete', $data->invoiceId) }}" onclick="return confirm('Anda Yakin Ingin Menghapus Invoice?')">
																	<span><i class="pt-2 pe-2" data-feather="delete"></i> Delete</span>
																</a>
															@endif

															@if ($data->sisa != 0 && isAdmin())
																<a class="dropdown-item" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#pembayaranInvoice{{ $data->invoiceId }}">
																	<span><i class="pt-2 pe-2" data-feather="dollar-sign"></i> Pembayaran</span>
																</a>
															@endif

															<a class="dropdown-item" href="{{ route('invoice.transaksi-pembayaran.detail', $data->invoiceId) }}">
																<span><i class="pt-2 pe-2" data-feather="eye"></i> History Pembayaran</span>
															</a>
														</div>
													</div>
												</div>
												@include('invoice.pembayaran')

														{{-- <form method="GET" action="{{ route('invoice.hasil-transaksi', ['id' => $data->id, 'invoiceId' => $data->invoiceId]) }}">
															<button class="btn btn-warning" type="submit">Detail</button>
														</form> --}}
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
	<script>
		document.addEventListener('input', function (e) {
			if (e.target.name === 'nominal') {
				const typedValue = e.target.value;
				const formattedValue = new Intl.NumberFormat('id-ID').format(typedValue);
				const displayElement = e.target.parentNode.querySelector('.typed-value');
				
				if (displayElement) {
					displayElement.innerHTML = '<strong>RP. ' + formattedValue + '</strong>';
				} else {
					const newDisplayElement = document.createElement('div');
					newDisplayElement.className = 'typed-value';
					newDisplayElement.innerHTML = '<strong>RP. ' + formattedValue + '</strong>';
					e.target.parentNode.appendChild(newDisplayElement);
				}
			}
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
							$('.inner').append("<input type='hidden' value='"+id+"' name='id_invoice[]'>");
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
						$('.inner').append("<input type='hidden' value='"+id+"' name='id_invoice[]'>");
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
					$('.inner').append("<input type='hidden' value='"+id+"' name='id_invoice[]'>");
				}
			} else {
				$('.inner input[value="'+id+'"]').remove();
			}
		}
	</script>
	@endpush

@endsection