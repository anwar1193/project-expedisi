@extends('layouts.admin.master')

@section('title')Pemantauan Kamera
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Pemantauan Kamera</h3>
		@endslot
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
	                                    <th width="5%">No</th>
	                                    <th>Nopol</th>
	                                    <th>Merk</th>
										<th width="5%">Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                @foreach ($item as $data)
										<tr>
											<td>{{ $loop->iteration; }}</td>
											<td>{{ $data->nopol }}</td>
											<td>{{ $data->merk }}</td>
											<td>
												<a href="{{ route('pemantauan-camera.detail', $data->id) }}" class="btn btn-square btn-info btn-xs">
													<i class="fa fa-eye"></i>
												</a>
												{{-- <a href="{{ route('surveilance-car.detail', $data->id) }}" class="btn btn-square btn-info btn-xs">
													<i class="fa fa-eye"></i>
												</a> --}}
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