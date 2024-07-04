@extends('layouts.admin.master')

@section('title')Pesan
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Pesan</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('pesan') }}">Pesan</a></li>
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
	                                    <th>Kode Pesan</th>
	                                    <th>Judul</th>
										<th>Isi Pesan</th>
										<th width="20%">Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>
	                                @foreach ($pesan as $data)
										<tr>
											<td>{{ $loop->iteration; }}</td>
											<td>{{ $data->kode_pesan }}</td>
											<td>{{ $data->judul }}</td>
											<td>{{ $data->isi_pesan }}</td>
											<td>
                                                <button class="btn btn-warning" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#pesan{{ $data->id }}"">Edit</button>
											</td>
										</tr>

                                        @include('pesan.edit')
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