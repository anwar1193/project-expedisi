@extends('layouts.admin.master')

@section('title')Lacak Resi
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
                    <h3>Lacak Resi</h3>
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
	                        <table class="display" id="basic-1">
	                            <thead>
                                    <tr>
                                        <th width="5%">No</th>
                                        <th>No Resi</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Pengirim</th>
                                        <th>Penerima</th>
                                        <th>Status Pengiriman</th>
                                        <th width="20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $data)
                                        <tr>
                                            <td>{{ $loop->iteration; }}</td>
                                            <td>{{ $data->no_resi }}</td>
                                            <td>{{ formatTanggalIndonesia($data->tgl_transaksi) }}</td>
                                            <td>{{ $data->nama_pengirim }}</td>
                                            <td>{{ $data->nama_penerima }}</td>
                                            <td>{{ $data->status_pengiriman }} - {{ $data->keterangan_pengiriman }}</td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                    <div class="btn-group" role="group">
                                                        <button class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modalDataPengiriman{{ $data->id }}" title="Detail Data">Detail</button>
                                                        {{-- <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modalDataPengiriman{{ $data->id }}" title="Detail Data"><span><i data-feather="eye"></i> Detail</span></a>
                                                        </div> --}}
                                                    </div>
                                                </div>
                                                @include('customers.component.detail-tagihan')
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