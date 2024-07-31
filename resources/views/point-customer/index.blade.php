@extends('layouts.admin.master')

@section('title')Point Customer
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
	
	<div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Point Customer</h3>
                </div>
            </div>
        </div>
	    <div class="row">
	        <!-- Server Side Processing start-->
	        <div class="col-sm-12">
	            <div class="card">
	                <div class="card-body">
                        <div class="row ps-3 ms-3 py-3 my-3 d-flex justify-content-evenly">
                            <div class="col-xl-5 col-md-5 col-sm-5 box-col-5 des-xl-25 rate-sec">
                                <div class="card shadow-lg" style="width: 20rem; border-radius:15px; background-color: rgb(33, 174, 47)">
                                    <div class="card-body text-center fw-bold">
                                    <h5 class="card-title pb-3 text-center fw-bold">Point</h5>
                                    <h4><i class="icofont icofont-ui-pointer "></i></h4>
                                    <h3 class="fw-bold">{{ $customer->point }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-5 col-md-5 col-sm-5 box-col-5 des-xl-25 rate-sec">
                                <div class="card shadow-lg" style="width: 20rem; border-radius:15px; background-color: rgb(200, 75, 75)">
                                    <div class="card-body text-center fw-bold">
                                        <h5 class="card-title pb-3 text-center fw-bold">Tagihan Belum Lunas</h5>
                                        <h4><i class="icofont icofont-sale-discount"></i></h4>
                                        <h3 class="fw-bold">{{ $data }}</h3>
                                    </div>
                                </div>
                            </div>
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