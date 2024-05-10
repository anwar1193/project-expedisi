@extends('layouts.admin.master')

@section('title')Tambah Role
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Role</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('role-management') }}">Role</a></li>
        <li class="breadcrumb-item active">Tambah</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Form Role</h5>
					</div>
					<form class="form theme-form" method="POST" action="{{ route('role.store') }}">
                        @csrf
						<div class="card-body">
							
							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Level</label>
										<input class="form-control @error('level') is-invalid @enderror" type="text" name="level" autocomplete="off" value="{{ old('level') }}" autofocus/>

										@error('level')
										<div class="text-danger">
											{{ $message }}
										</div>
										@enderror
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Deskripsi</label>
										{{-- <input class="form-control @error('level') is-invalid @enderror" type="text" name="level" autocomplete="off" value="{{ old('level') }}" autofocus/> --}}

										<textarea name="deskripsi" class="form-control">{{ old('deskripsi') }}</textarea>
									</div>
								</div>
							</div>

						</div>
						<div class="card-footer text-end">
							<a href="{{ route('role-management') }}" class="btn btn-light">
								<i class="fa fa-backward"></i> Back
							</a>

							<button class="btn btn-primary" type="submit">
								<i class="fa fa-save"></i> Save Data
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	
	@push('scripts')
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
	@endpush

@endsection