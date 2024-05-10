@extends('layouts.admin.master')

@section('title')Role Management
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Role Management For {{ $level->level }}</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('role-management') }}">Role Management</a></li>
		<li class="breadcrumb-item active">Table</li>
	@endcomponent

    <nav class="page-breadcrumb">
        <ol class="breadcrumb align-items-center">
            <div class="d-grid gap-2 d-md-block mx-2">
                {{-- @if (isAdmin()) --}}
                    
                {{-- @endif --}}
            </div>
        </ol>
    </nav>
	
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
						
						@if (session()->has('error'))
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Gagal <i class="fa fa-info-circle"></i></strong> 
								{{ session('error') }}
								<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif
	                    
                        <form action="{{ route('role.add-permission') }}" method="post">
                            @csrf
                            <input type="hidden" value="{{ $level->id }}" name="level_id">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Modul Name</th>
                                            <th width="35%" class="text-center">Select</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                        
                                        @foreach ($menu as $data)
                                            <tr>
                                                <td>{{ $loop->iteration; }}</td>
                                                <td>{{ $data->menu }}</td>
                                                <td class="text-center">
                                                    <div class="form-check">
                                                        @php
                                                            $cek_module = HApp::cekModule($data->id, $level->id);
                                                        @endphp
                                                        <input type="checkbox" value="{{ $data->id }}" name="menu_id[]" id="flexCheckDefault" {{ $cek_module ? 'checked' : NULL }}>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-end mt-4">
                                <a href="{{ route('role-management') }}" class="btn btn-light">
                                    <i class="fa fa-backward"></i> Back
                                </a>

                                <button class="btn btn-primary" type="submit">
                                    <i class="fa fa-save"></i> Save Change
                                </button>
                            </div>
                        </form>
                        

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