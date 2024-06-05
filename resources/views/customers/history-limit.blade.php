@extends('layouts.admin.master')

@section('title')History Limit
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>History Penambahan Kredit {{ $customer->nama }}</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('customers.index') }}">Customer</a></li>
		<li class="breadcrumb-item active">History Kredit</li>
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
						<div class="table-responsive px-5">
	                        <table class="display" id="basic-1">
	                            <thead>
	                                <tr>
	                                    <th width="5%">No</th>
	                                    <th width="40%">Nominal Yang Ditambahkan</th>
	                                    <th>Tanggal Ditambahakan</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                @foreach ($data as $data)
										<tr>
											<td>{{ $loop->iteration; }}</td>
											<td>{{ 'Rp '.number_format($data->limit_kredit, 0, '.', '.') }}</td>
											<td>{{ $data->created_at }}</td>
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