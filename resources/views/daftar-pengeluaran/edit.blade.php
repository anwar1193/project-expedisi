@extends('layouts.admin.master')

@section('title')Edit Daftar Pengeluaran
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Daftar Pengeluaram</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('daftar-pengeluaran') }}">Daftar Pengeluaran</a></li>
        <li class="breadcrumb-item active">Edit</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Form Edit Daftar Pengeluaran</h5>
					</div>
					<form class="form theme-form" method="POST" action="{{ route('daftar-pengeluaran.update', $datas->id) }}" enctype="multipart/form-data">
                        @csrf
						<div class="card-body">
							
                            <div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Keterangan</label>
										<input class="form-control @error('keterangan') is-invalid @enderror" type="text" name="keterangan" autocomplete="off" value="{{ old('keterangan', $datas->keterangan) }}"/>

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
										<input class="form-control @error('jumlah_pembayaran') is-invalid @enderror" type="number" name="jumlah_pembayaran" autocomplete="off" value="{{ old('jumlah_pembayaran', $datas->jumlah_pembayaran) }}"/>

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
										<label class="form-label" for="">Yang Menerima</label>
										<input class="form-control @error('yang_menerima') is-invalid @enderror" type="text" name="yang_menerima" autocomplete="off" value="{{ old('yang_menerima', $datas->yang_menerima) }}"/>

										@error('yang_menerima')
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
											<option value="tunai" {{ $datas->metode_pembayaran == 'tunai' ? 'selected' : NULL }}>Tunai</option>
											<option value="transfer" {{ $datas->metode_pembayaran == 'transfer' ? 'selected' : NULL }}>Transfer</option>
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
                                        <div class="mb-3">
                                            <label class="form-label" for="">Bukti Pembayaran</label>
											<textarea class="form-control @error('bukti_pembayaran') is-invalid @enderror" cols="100" rows="5" name="bukti_pembayaran">{{ old('bukti_pembayaran', $datas->bukti_pembayaran) }}</textarea>
											
                                            @error('bukti_pembayaran')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror
    
                                        </div>
									</div>
								</div>
							</div>

							{{-- <div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Status Pengeluaran</label>
										<select name="status_pengeluaran" id="status_pengeluaran" class="form-control @error('status_pengeluaran') is-invalid @enderror">
											<option value="1" {{ $datas->status_pembayaran == 1 ? 'selected' : NULL }}>Disetujui</option>
											<option value="2" {{ $datas->status_pembayaran == 2 ? 'selected' : NULL }}>Pending</option>
										</select>

										@error('status_pembayaran')
										<div class="text-danger">
											{{ $message }}
										</div>
										@enderror
									</div>
								</div>
							</div> --}}

							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Jenis Pengeluaran</label>
                                        <select name="jenis_pengeluaran" id="jenis_pengeluaran" class="form-control @error('jenis_pengeluaran') is-invalid @enderror">
											@foreach ($jenis_pengeluaran as $jenis_pengeluaran)
												<option value="{{ $jenis_pengeluaran->id }}" {{ $datas->jenis_pengeluaran == $jenis_pengeluaran->id ? 'selected' : NULL }}>{{ $jenis_pengeluaran->jenis_pengeluaran }}</option>
											@endforeach
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
							<a href="{{ route('daftar-pengeluaran') }}" class="btn btn-light">Kembali</a>
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