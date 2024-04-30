@extends('layouts.admin.master')

@section('title')Detail Perangkat
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Perangkat</h3>
		@endslot
        <li class="breadcrumb-item active"><a href="{{ route('perangkat') }}">Perangkat</a></li>
        <li class="breadcrumb-item active">Detail</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					
                    <table class="table">
                        <tr>
                            <th>Kode Perangkat</th>
                            <th class="text-center">:</th>
                            <td>{{ $perangkat->kode_perangkat }}</td>
                        </tr>

                        <tr>
                            <th>Nama Perangkat</th>
                            <th class="text-center">:</th>
                            <td>{{ $perangkat->nama_perangkat }}</td>
                        </tr>

                        <tr>
                            <th>Jenis Perangkat</th>
                            <th class="text-center">:</th>
                            <td>{{ $perangkat->nama_jenis }}</td>
                        </tr>

                        <tr>
                            <th>Serial Number</th>
                            <th class="text-center">:</th>
                            <td>{{ $perangkat->serial_number }}</td>
                        </tr>

                        <tr>
                            <th>Kondisi Perangkat</th>
                            <th class="text-center">:</th>
                            <td>{{ $perangkat->kondisi_perangkat }}</td>
                        </tr>

                        <tr>
                            <th>Foto</th>
                            <th class="text-center">:</th>
                            <td>
                                <img src="{{ asset('storage/perangkat/'.$perangkat->foto) }}" alt="" width="200px" class="img-fluid mt-2">
                            </td>
                        </tr>

                    </table>

                    <div class="card-footer text-end">
                        <a href="{{ route('perangkat') }}" class="btn btn-light">Kembali</a>
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