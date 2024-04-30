@extends('layouts.admin.master')

@section('title')Riwayat Armada
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Data Riwayat Armada</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('riwayat-armada') }}">Riwayat Armada</a></li>
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
	                    
						{{-- Table --}}
						<div class="table-responsive">
	                        <table class="display" id="basic-1">
	                            <thead>
	                                <tr>
	                                    <th>No</th>
	                                    <th>Merk</th>
	                                    <th>Nopol</th>
	                                    <th>Latitude</th>
	                                    <th>Langitude</th>
	                                    <th>Waktu</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                @foreach ($riwayat as $data)
										<tr>
											<td>{{ $loop->iteration; }}</td>
											<td>{{ $data->merk }}</td>
											<td>{{ $data->nopol }}</td>
											<td>{{ $data->lat  }}</td>
											<td>{{ $data->lang  }}</td>
											<td>{{ $data->created_at  }}</td>
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