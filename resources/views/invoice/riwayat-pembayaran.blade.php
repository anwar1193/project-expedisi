@extends('layouts.admin.master')

@section('title')Detail Riwayat Pembayaran
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
			<h3>Detail Riwayat Pembayaran</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('invoices.index') }}">All Invoice</a></li>
		<li class="breadcrumb-item active">Table</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="d-flex justify-content-end">
			<div class="px-1 mb-3">
				<a href="{{ route('invoices.index') }}" class="btn btn-md btn-secondary" title="Kembali">Kembali</a>
			</div>
		</div>
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
	                                    <th>Tanggal Pembayaran</th>
	                                    <th>Nominal Pembayaran</th>
	                                    <th>Bukti Pembayaran</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                @foreach ($datas as $data)
										<tr>
											<td>{{ $loop->iteration; }}</td>
											<td>{{ $data->invoice_no }}</td>
											<td>{{ formatTanggalIndonesia($data->tanggal_bayar) }}</td>
											<td>Rp {{ number_format($data->nominal, 0, '.', '.') }}</td>
											<td onmouseover="showBukti({{ $data->id }})" onmouseout="hideBukti({{ $data->id }})">
                                                @if ($data->bukti_bayar != '')
												    <div id="view-bukti{{ $data->id }}" class="mb-3">
                                                        <img src="{{ asset('storage/invoice-bukti-bayar/'.$data->bukti_bayar) }}" alt="" width="200px" class="img-fluid mt-2">
                                                        <a class="btn btn-primary" href="{{ asset('storage/invoice-bukti-bayar/'.$data->bukti_bayar)}}" target="_blank">View Image</a>
                                                    </div>
                                                @endif
                                                <div id="icon-view{{ $data->id }}">
                                                    <i data-feather="link"></i> Gambar
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
			$('#view-bukti'+id).show();
			$('#icon-view'+id).hide();
		}

		function hideBukti(id) {
			$('#view-bukti'+id).hide();
			$('#icon-view'+id).show();
		}
	</script>
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