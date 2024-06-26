@extends('layouts.admin.master')

@section('title')Tambah Data Pengiriman
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Data Pengiriman</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('data-pengiriman') }}">Data Pengiriman</a></li>
        <li class="breadcrumb-item active">Tambah</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Form Data Pengirman</h5>
					</div>
					<form class="form theme-form" method="POST" action="{{ route('data-pengiriman.store') }}" enctype="multipart/form-data">
                        @csrf
						<div class="card-body">
							
							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">No Resi</label>
										<input class="form-control @error('no_resi') is-invalid @enderror" type="text" name="no_resi" autocomplete="off" value="{{ old('no_resi') }}"/>

										@error('no_resi')
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
										<label class="form-label" for="">Tanggal Transaksi</label>
										<input class="form-control @error('tgl_transaksi') is-invalid @enderror" type="date" name="tgl_transaksi" autocomplete="off" value="{{ old('tgl_transaksi') }}"/>

										@error('tgl_transaksi')
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
										<label class="form-label" for="">Nama Pengirim</label>
										<input class="form-control @error('nama_pengirim') is-invalid @enderror" type="text" name="nama_pengirim" autocomplete="off" value="{{ old('nama_pengirim') }}"/>

										@error('nama_pengirim')
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
										<label class="form-label" for="">Nama Penerima</label>
										<input class="form-control @error('nama_penerima') is-invalid @enderror" type="text" name="nama_penerima" autocomplete="off" value="{{ old('nama_penerima') }}"/>

										@error('nama_penerima')
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
										<label class="form-label" for="">Kota Tujuan</label>
										<input class="form-control @error('kota_tujuan') is-invalid @enderror" type="text" name="kota_tujuan" autocomplete="off" value="{{ old('kota_tujuan') }}"/>

										@error('kota_tujuan')
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
										<label class="form-label" for="">No HP Pengirim</label>
										<input class="form-control @error('no_hp_pengirim') is-invalid @enderror" type="text" name="no_hp_pengirim" autocomplete="off" value="{{ old('no_hp_pengirim') }}"/>

										@error('no_hp_pengirim')
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
										<label class="form-label" for="">No HP Penerima</label>
										<input class="form-control @error('no_hp_penerima') is-invalid @enderror" type="text" name="no_hp_penerima" autocomplete="off" value="{{ old('no_hp_penerima') }}"/>

										@error('no_hp_penerima')
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
										<label class="form-label" for="">Berat Barang (Dalam Kg)</label>
										<input class="form-control @error('berat_barang') is-invalid @enderror" type="text" name="berat_barang" autocomplete="off" value="{{ old('berat_barang') }}"/>

										@error('berat_barang')
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
										<label class="form-label" for="">Ongkir</label>
										<input class="form-control @error('ongkir') is-invalid @enderror" type="text" name="ongkir" autocomplete="off" value="{{ old('ongkir') }}"/>

										@error('ongkir')
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
										<label class="form-label" for="">Komisi</label>
										<input class="form-control @error('komisi') is-invalid @enderror" type="text" name="komisi" autocomplete="off" value="{{ old('komisi') }}"/>

										@error('komisi')
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
										<label class="form-label" for="">Status Pembayaran</label>
										<select name="status_pembayaran" id="status_pembayaran" class="form-control @error('status_pembayaran') is-invalid @enderror">
											<option value="">- Pilih Status Pembayaran -</option>
											<option value="1">Lunas</option>
											<option value="2">Pending</option>
										</select>

										@error('status_pembayaran')
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
											<option value="Tunai">Tunai</option>
											<option value="Transfer">Transfer</option>
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