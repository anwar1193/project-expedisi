@extends('layouts.admin.master')

@section('title')Invoice Customer
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<style>
	th {
		background-color: rgb(200, 75, 75)
	}
</style>
@endpush

@section('content')
	
	<div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Invoice Customer</h3>
                </div>
            </div>
        </div>
	    <div class="row">
	        <!-- Server Side Processing start-->
	        <div class="col-sm-12">
	            <div class="card">
	                <div class="card-body">
						{{-- Table --}}
						<div class="table-responsive">
                            <div class="float-end">
                                <h5>Total Tagihan: Rp {{ number_format($total, 0, '.', '.') }}</h5>
                            </div>
	                        <table class="display" id="basic-1">
	                            <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>No Invoice</th>
                                        <th>Tanggal Cetak</th>
                                        <th>Kode Customer</th>
                                        <th>Nama Customer</th>
                                        <th>Status</th>
                                        <th width="20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($invoice as $data)
                                        <tr>
                                            <td>{{ $loop->iteration; }}</td>
                                            <td>{{ $data->invoice_no }}</td>
                                            <td>{{ formatTanggalIndonesia($data->created_at) }}</td>
                                            <td>{{ $data->kode_customer }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td class="text-center">
                                                <span class="badge {{ $data->sisa == 0 ? 'badge-primary' : 'badge-warning' }}">
                                                    <i class="fa {{ $data->sisa == 0 ? 'fa-check' : 'fa-warning' }}"></i>
                                                    {{ $data->status }}
                                                </span>
                                            </td>
                                            <td>
                                                <form method="GET" action="{{ route('invoice.hasil-transaksi', ['id' => $data->id, 'invoiceId' => $data->invoiceId]) }}">
                                                    <button class="btn btn-warning" type="submit" name="customer" value="{{ $data->id }}">Detail</button>
                                                </form>
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
	@endpush

@endsection