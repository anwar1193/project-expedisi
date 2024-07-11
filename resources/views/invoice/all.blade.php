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
	
	<div class="container-fluid">
        <form class="d-flex flex-column col-12" role="search" action="" method="GET">
			<div class="d-flex justify-content-end">
                <div id="customer_id">
                    <input class="form-control" type="date" name="tanggal" value="{{ request('tanggal') ? request('tanggal') : date('Y-m-d') }}" />
                </div>
                <div id="customer_id" class="px-2">
                    <select name="customer_id" class="form-control py-2">
                        <option value="">- Pilih Customer -</option>
                        @foreach($customers as $customer)
                            <option value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->nama }}</option>
                        @endforeach
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
	                                    <th>Tanggal Cetak</th>
										<th>Kode Customer</th>
										<th>Nama Customer</th>
										<th>Status</th>
										<th width="20%">Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                @foreach ($data as $data)
										<tr>
											<td>{{ $loop->iteration; }}</td>
											<td>{{ $data->invoice_no }}</td>
											<td>Rp {{ number_format($data->totalBersih, 0, '.', '.') }}</td>
											<td>{{ formatTanggalIndonesia($data->created_at) }}</td>
											<td>{{ $data->kode_customer }}</td>
											<td>{{ $data->nama }}</td>
											<td class="text-center">
												<span class="badge {{ $data->totalBersih == 0 ? 'badge-primary' : 'badge-warning' }}">
													<i class="fa {{ $data->totalBersih == 0 ? 'fa-check' : 'fa-warning' }}"></i>
													{{ $data->totalBersih == 0 ? 'Lunas' : 'Belum Lunas'; }}
												</span>
											</td>
											<td>
												<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
													<div class="btn-group" role="group">
														<button class="btn btn-secondary btn-sm dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
														<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
															<a class="dropdown-item" href="{{ route('invoice.hasil-transaksi', ['id' => $data->id, 'invoiceId' => $data->invoiceId]) }}">
																<span><i class="pt-2 pe-2" data-feather="eye"></i> Detail</span>
															</a>

															<a class="dropdown-item" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#pembayaranInvoice{{ $data->id }}">
																<span><i class="pt-2 pe-2" data-feather="dollar-sign"></i> Pembayaran</span>
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
		document.addEventListener('DOMContentLoaded', function() {
			const jumlahPembayaranInput = document.querySelector('input[name="nominal"]');
			const displayElement = document.createElement('div');
			displayElement.innerHTML = '<strong>RP. ' + new Intl.NumberFormat('id-ID').format(jumlahPembayaranInput.value) + '</strong>';
			jumlahPembayaranInput.parentNode.appendChild(displayElement);

			jumlahPembayaranInput.addEventListener('input', function() {
				const typedValue = jumlahPembayaranInput.value;
				displayElement.innerHTML = '<strong>RP. ' + new Intl.NumberFormat('id-ID').format(typedValue) + '</strong>';
			});
		});
	</script>
	@endpush

@endsection