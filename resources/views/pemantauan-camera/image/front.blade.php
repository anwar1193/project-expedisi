@extends('layouts.admin.master')

@section('title')Daftar Gambar Front Camera
 {{ $title }}
@endsection

@push('css')
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Daftar Gambar Front Camera</h3>
		@endslot
		<li class="breadcrumb-item active">Pemanatauan Kamera</li>
		<li class="breadcrumb-item active">Front Camera</li>
	@endcomponent

	<div class="container-fluid">
		<div class="row mb-3">
			<div class="d-flex justify-content-end">
				<button class="btn btn-light col-12 col-sm-12 col-md-4 col-xl-3" onclick="history.back()">Kembali</button>
			</div>
		</div>
		<div class="row">
			@forelse ($item as $data)
			<div class="col-3 col-sm-12 col-md-4 col-xl-3 mb-3">
				<img src="{{ asset('storage/front-camera/'.$data->foto) }}" alt="{{ $data->foto }}" width="250px">
			</div>
			@empty
			<div class="col-sm-12 col-xl-12">
				<div class="card">
					<div class="card-header text-center">
						Tidak Ada Gambar
					</div>
				</div>
			</div>
			@endforelse 
		</div>
	</div>
	

@push('scripts') 
@endpush

@endsection