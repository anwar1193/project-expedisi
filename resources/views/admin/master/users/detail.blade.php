@extends('layouts.admin.master')

@section('title')Detail Pengguna
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Pengguna</h3>
		@endslot
        <li class="breadcrumb-item active"><a href="{{ route('users') }}">Pengguna</a></li>
        <li class="breadcrumb-item active">Detail</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					
                    <table class="table">
                        <tr>
                            <th>Nama</th>
                            <th class="text-center">:</th>
                            <td>{{ $user->nama }}</td>
                        </tr>

                        <tr>
                            <th>NIP</th>
                            <th class="text-center">:</th>
                            <td>{{ $user->nip }}</td>
                        </tr>

                        <tr>
                            <th>Kode Satker</th>
                            <th class="text-center">:</th>
                            <td>{{ $user->kode_satker }}</td>
                        </tr>

                        <tr>
                            <th>Nama Satker</th>
                            <th class="text-center">:</th>
                            <td>{{ $user->nama_satker }}</td>
                        </tr>

                        <tr>
                            <th>Username</th>
                            <th class="text-center">:</th>
                            <td>{{ $user->username }}</td>
                        </tr>

                        <tr>
                            <th>Email</th>
                            <th class="text-center">:</th>
                            <td>{{ $user->email }}</td>
                        </tr>

                        <tr>
                            <th>Nomor Telepon</th>
                            <th class="text-center">:</th>
                            <td>{{ $user->nomor_telepon }}</td>
                        </tr>

                        <tr>
                            <th>User Level</th>
                            <th class="text-center">:</th>
                            <td>{{ $user->nama_level }}</td>
                        </tr>

                        <tr>
                            <th>Status</th>
                            <th class="text-center">:</th>
                            <td>{{ $user->status == 1 ? 'Aktif' : 'Non Aktif' }}</td>
                        </tr>

                        <tr>
                            <th>Tanggal Kadaluarsa</th>
                            <th class="text-center">:</th>
                            <td>{{ date("d-m-Y", strtotime($user->tgl_kadaluarsa)) }}</td>
                        </tr>

                        <tr>
                            <th>Foto</th>
                            <th class="text-center">:</th>
                            <td>
                                <img src="{{ asset('storage/foto_profil/'.$user->foto) }}" alt="" width="200px" class="img-fluid mt-2">
                            </td>
                        </tr>
                    </table>

                    <div class="card-footer text-end">
                        <a href="{{ route('users') }}" class="btn btn-light">Kembali</a>
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