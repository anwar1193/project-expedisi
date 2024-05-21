@extends('layouts.admin.master')

@section('title')Konversi Point
 {{ $title }}
@endsection

@push('css')
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Konversi Point</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('konversi-point') }}">Konversi Point</a></li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row d-flex justify-content-center">
			<div class="col-sm-12 col-xl-6">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Edit Konversi Point</h5>
					</div>
                    <form class="needs-validation" method="POST" action="{{ route('konversi-point.update') }}">
                        @csrf
                        <div class="card-body megaoptions-border-space-sm">
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
                                <input type="text" name="id" value="{{ $konversiPoints->id }}" hidden>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="form-label" for="nominal">Nominal Untuk 1 Point</label>
                                        <input class="form-control @error('nominal') is-invalid @enderror" id="nominal" type="text" name="nominal" value="{{ old('nominal', $konversiPoints->nominal) }}" />
                                        <div id="nominal" class="form-text text-danger">*Default 1 Point = Rp. 1000</div>

                                        @error('nama')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-primary m-r-15" type="submit">Update</button>
                        </div>
                    </form>

				</div>
			</div>
		</div>
	</div>
	
	
	@push('scripts')
	<script src="{{ asset('assets/js/height-equal.js') }}"></script>
	@endpush

@endsection