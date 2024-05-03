@extends('layouts.admin.master')

@section('title')Tambah Daftar Pengeluaran
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Daftar Pengeluaran</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('daftar-pengeluaran') }}">Daftar Pengeluaran</a></li>
        <li class="breadcrumb-item active">Tambah</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Form Daftar Pengeluaran</h5>
					</div>
					<form class="form theme-form" method="POST" action="{{ route('daftar-pengeluaran.store') }}" enctype="multipart/form-data">
                        @csrf
						<div class="card-body">

							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Keterangan</label>
										<input class="form-control @error('keterangan') is-invalid @enderror" type="text" name="keterangan" autocomplete="off" value="{{ old('keterangan') }}"/>

										@error('keterangan')
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
										<label class="form-label" for="">Jumlah Pembayaran</label>
										<input class="form-control @error('jumlah_pembayaran') is-invalid @enderror" type="number" name="jumlah_pembayaran" autocomplete="off" value="{{ old('jumlah_pembayaran') }}"/>

										@error('jumlah_pembayaran')
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
										<label class="form-label" for="">Pengguna Terkait</label>
										<input class="form-control @error('pengguna_terkait') is-invalid @enderror" type="text" name="pengguna_terkait" autocomplete="off" value="{{ old('pengguna_terkait') }}"/>

										@error('pengguna_terkait')
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
										<label class="form-label" for="">Metode Pembayaran</label>
										<select name="metode_pembayaran" id="metode_pembayaran" class="form-control @error('metode_pembayaran') is-invalid @enderror">
											<option value="">- Pilih Metode Pembayaran -</option>
											<option value="tunai">Tunai</option>
											<option value="transfer">Transfer</option>
										</select>

										@error('metode_pembayaran')
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
										<label class="form-label" for="">Bukti Pembayaran</label>
										<input class="form-control @error('bukti_pembayaran') is-invalid @enderror" type="file" width="48" height="48" name="bukti_pembayaran" />

										@error('bukti_pembayaran')
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
										<label class="form-label" for="">Status Pengeluaran</label>
										<select name="status_pengeluaran" id="status_pstatus_pengeluaranembayaran" class="form-control @error('status_pengeluaran') is-invalid @enderror">
											<option value="">- Pilih Status Pengeluaran -</option>
											<option value="1">Disetujui</option>
											<option value="2">Pending</option>
										</select>

										@error('status_pengeluaran')
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
										<label class="form-label" for="">Jenis Pengeluaran</label>
                                        <select name="jenis_pengeluaran" id="jenis_pengeluaran" class="form-control @error('jenis_pengeluaran') is-invalid @enderror">
											<option value="">- Pilih Jenis Pengeluarab -</option>
											<option value="operasional">Operasional</option>
											<option value="pengeluaran lain">Pengeluaran Lain</option>
										</select>

										@error('jenis_pengeluaran')
										<div class="text-danger">
											{{ $message }}
										</div>
										@enderror
									</div>
								</div>
							</div>

						</div>
						<div class="card-footer text-end">
							<button class="btn btn-primary" type="submit">Simpan Data</button>
							<a href="{{ route('data-pengiriman') }}" class="btn btn-light">Kembali</a>
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