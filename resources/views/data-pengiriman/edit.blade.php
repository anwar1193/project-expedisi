@extends('layouts.admin.master')

@section('title')Edit Data Pengiriman
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
        <li class="breadcrumb-item active">Edit</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Form Edit Data Pengirman</h5>
					</div>
					<form class="form theme-form" method="POST" action="{{ route('data-pengiriman.update', $datas->id) }}" enctype="multipart/form-data">
                        @csrf
						<div class="card-body">
							
							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Pilih Customer</label>
										
										<select name="kode_customer" id="kode_customer" class="form-control @error('kode_customer') is-invalid @enderror js-example-basic-single">
											<option value="">- Pilih Customer -</option>
											<option value="General" {{ $datas->kode_customer == 'General' ? 'selected' : NULL }}>General</option>
											@foreach ($customer as $item)
												<option value="{{ $item->kode_customer }}" {{ $item->kode_customer == $datas->kode_customer ? 'selected' : '' }}>
													{{ $item->kode_customer }} - {{ $item->nama }}
												</option>
											@endforeach
										</select>

										@error('customer')
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
										<label class="form-label" for="">No Resi</label>
										<input class="form-control @error('no_resi') is-invalid @enderror" type="text" name="no_resi" autocomplete="off" value="{{ old('no_resi', $datas->no_resi) }}"/>

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
										<input class="form-control @error('tgl_transaksi')@enderror" id="example-datetime-local-input" type="datetime-local" name="tgl_transaksi" autocomplete="off" value="{{ old('tgl_transaksi', $datas->tgl_transaksi) }}"/>

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
										<input class="form-control @error('nama_pengirim') is-invalid @enderror" type="text" name="nama_pengirim" autocomplete="off" value="{{ old('nama_pengirim', $datas->nama_pengirim) }}"/>

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
										<input class="form-control @error('nama_penerima') is-invalid @enderror" type="text" name="nama_penerima" autocomplete="off" value="{{ old('nama_penerima', $datas->nama_penerima) }}"/>

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
										<input class="form-control @error('kota_tujuan') is-invalid @enderror" type="text" name="kota_tujuan" autocomplete="off" value="{{ old('kota_tujuan', $datas->kota_tujuan) }}"/>

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
										<input class="form-control @error('no_hp_pengirim') is-invalid @enderror" type="text" name="no_hp_pengirim" autocomplete="off" value="{{ old('no_hp_pengirim', $datas->no_hp_pengirim) }}"/>

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
										<input class="form-control @error('no_hp_penerima') is-invalid @enderror" type="text" name="no_hp_penerima" autocomplete="off" value="{{ old('no_hp_penerima', $datas->no_hp_penerima) }}"/>

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
										<input class="form-control @error('berat_barang') is-invalid @enderror" type="text" name="berat_barang" autocomplete="off" value="{{ old('berat_barang', $datas->berat_barang) }}"/>

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
										<input class="form-control @error('ongkir') is-invalid @enderror" type="text" name="ongkir" autocomplete="off" value="{{ old('ongkir', $datas->ongkir) }}"/>

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
										<input class="form-control @error('komisi') is-invalid @enderror" type="text" name="komisi" autocomplete="off" value="{{ old('komisi', $datas->komisi) }}"/>

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
										<label class="form-label" for="">Metode Pembayaran</label>
                                        <select name="metode_pembayaran" id="metode_pembayaran" class="form-control @error('metode_pembayaran') is-invalid @enderror js-example-basic-single">
											@foreach ($metode as $item)
												<option value="{{ $item->metode }}" {{ $datas->metode_pembayaran == $item->metode ? 'selected' : NULL }}>{{ $item->metode }}</option>
											@endforeach
										</select>

										@error('metode_pembayaran')
										<div class="text-danger">
											{{ $message }}
										</div>
										@enderror
									</div>
								</div>
							</div>
							
							<div class="row" id="bank-row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Bank</label>
                                        <select name="bank" id="bank" class="form-control @error('bank') is-invalid @enderror js-example-basic-single">
											@foreach ($bank as $item)
												<option value="{{ $item->bank }}" {{ $datas->bank == $item->bank ? 'selected' : NULL }}>{{ $item->bank }}</option>
											@endforeach
										</select>

										@error('bank')
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
                                        <div class="mb-3">
                                            <label class="form-label" for="">Bukti Pembayaran (Link Google Drive)</label>
											<textarea name="bukti_pembayaran" id="bukti_pembayaran" class="form-control">{{ $datas->bukti_pembayaran }}</textarea>
                                            {{-- <input class="form-control @error('bukti_pembayaran') is-invalid @enderror" type="file" width="48" height="48" name="bukti_pembayaran" />
    
                                            @error('bukti_pembayaran')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
    
                                            <img src="{{ asset('storage/bukti_pembayaran/'.$datas->bukti_pembayaran) }}" alt="" width="200px" class="img-fluid mt-2"> --}}
                                        </div>
									</div>
								</div>
							</div>
							
							<div class="row">
								<div class="col">
									<div class="mb-3">
                                        <div class="mb-3">
                                            <label class="form-label" for="">Status Kirim WA</label>
											<select name="status_kirim_wa" class="form-control @error('status_kirim_wa')  @enderror js-example-basic-single">
												<option value="{{ $aktif }}" {{ $datas->status_kirim_wa == $aktif ? 'selected' : '' }}>Ya</option>
												<option value="{{ $nonaktif }}" {{ $datas->status_kirim_wa == $nonaktif ? 'selected' : '' }}>Tidak</option>
											</select>

                                            @error('status_kirim_wa')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
    
                                        </div>
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
	<script>
		$(document).ready(function() {
			function toggleBankVisibility() {
				if ($('#metode_pembayaran').val() === 'Transfer') {
					$('#bank').closest('.row').show();
				} else {
					$('#bank').closest('.row').hide();
				}
			}

			toggleBankVisibility();

			$('#metode_pembayaran').change(function() {
				toggleBankVisibility();
			});
		});
	</script>
	@endpush

@endsection