@extends('layouts.admin.master')

@section('title')Konfigurasi WA
 {{ $title }}
@endsection

@push('css')
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Konfigurasi WA</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('setting-wa') }}">Konfigurasi WA</a></li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row d-flex justify-content-center">
			<div class="col-sm-12 col-xl-6">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Edit Konfigurasi WA</h5>
					</div>
                    <form class="needs-validation" method="POST" action="{{ route('setting-wa.update') }}">
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
                            <input type="text" name="id" value="{{ $settings->id }}" hidden>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="form-label" for="api_key">API Key</label>
                                    <input class="form-control @error('api_key') is-invalid @enderror" type="text" name="api_key" value="{{ old('api_key', $settings->api_key) }}" />

                                    @error('api_key')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <label class="form-label" for="sender">Sender</label>
                                    <input class="form-control @error('sender') is-invalid @enderror" type="text" name="sender" value="{{ old('sender', $settings->sender) }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />

                                    @error('sender')
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