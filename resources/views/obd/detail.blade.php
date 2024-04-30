@extends('layouts.admin.master')

@section('title')Detail OBD
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>OBD</h3>
		@endslot
        <li class="breadcrumb-item active"><a href="{{ route('obd') }}">OBD</a></li>
        <li class="breadcrumb-item active">Detail</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					
                    <table class="table">
                        <tr>
                            <th>Merk</th>
                            <th class="text-center">:</th>
                            <td>{{ $obd->merk }}</td>
                        </tr>

                        <tr>
                            <th>Tipe</th>
                            <th class="text-center">:</th>
                            <td>{{ $obd->type }}</td>
                        </tr>

                        <tr>
                            <th>Serial Number</th>
                            <th class="text-center">:</th>
                            <td>{{ $obd->serial_number }}</td>
                        </tr>

                        <tr>
                            <th>Foto</th>
                            <th class="text-center">:</th>
                            <td><img src="{{ asset('storage/obd/'.$obd->foto) }}" alt="" width="200px" class="img-fluid mt-2"></td>
                        </tr>

                    </table>

                    <div class="card-footer text-end">
                        <a href="{{ route('obd') }}" class="btn btn-light">Kembali</a>
                        {{-- <input class="btn btn-light" type="button" value="Cancel" /> --}}
                    </div>

				</div>
			</div>
		</div>
	</div>
	
	
	@push('scripts')
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
	@endpush

@endsection