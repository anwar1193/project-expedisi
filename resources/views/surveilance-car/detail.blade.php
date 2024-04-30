@extends('layouts.admin.master')

@section('title')Detail Surveilance Car
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Surveilance Car</h3>
		@endslot
        <li class="breadcrumb-item active"><a href="{{ route('surveilance-car') }}">Surveilance Car</a></li>
        <li class="breadcrumb-item active">Detail</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					
                    <table class="table">
                        <tr>
                            <th>Nomor Polisi</th>
                            <th class="text-center">:</th>
                            <td>{{ $surveilance_car->nopol }}</td>
                        </tr>

                        <tr>
                            <th>Warna</th>
                            <th class="text-center">:</th>
                            <td>{{ $surveilance_car->warna }}</td>
                        </tr>

                        <tr>
                            <th>Merk</th>
                            <th class="text-center">:</th>
                            <td>{{ $surveilance_car->merk }}</td>
                        </tr>

                        <tr>
                            <th>Kapasitas</th>
                            <th class="text-center">:</th>
                            <td>{{ $surveilance_car->kapasitas }}</td>
                        </tr>

                        <tr>
                            <th>Transmisi</th>
                            <th class="text-center">:</th>
                            <td>{{ $surveilance_car->transmisi }}</td>
                        </tr>

                        <tr>
                            <th>Bahan Bakar</th>
                            <th class="text-center">:</th>
                            <td>{{ $surveilance_car->bahan_bakar }}</td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <th class="text-center">:</th>
                            <td>{{ $surveilance_car->status }}</td>
                        </tr>

                        <tr>
                            <th>Kondisi</th>
                            <th class="text-center">:</th>
                            <td>{{ $surveilance_car->kondisi }}</td>
                        </tr>

                        <tr>
                            <th>Foto</th>
                            <th class="text-center">:</th>
                            <td>
                                <img src="{{ asset('storage/surveilance-car/'.$surveilance_car->foto) }}" alt="" width="200px" class="img-fluid mt-2">
                            </td>
                        </tr>

                    </table>

                    <div class="card-footer text-end">
                        <a href="{{ route('surveilance-car') }}" class="btn btn-light">Kembali</a>
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