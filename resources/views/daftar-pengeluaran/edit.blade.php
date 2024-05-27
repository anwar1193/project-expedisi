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

							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Keterangan Tambahan</label>
										<input class="form-control @error('keterangan_tambahan') is-invalid @enderror" type="text" name="keterangan_tambahan" autocomplete="off" value="{{ old('keterangan_tambahan', $datas->keterangan_tambahan) }}" maxlength="255"/>

										@error('keterangan_tambahan')
										<div class="text-danger">
											{{ $message }}
										</div>
										@enderror
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col">
									<div class="mb-1">
                                        <div class="mb-3">
                                            <label class="form-label" for="">Bukti Pembayaran</label>
											<input class="form-control @error('bukti_pembayaran') is-invalid @enderror" id="buktiBayar" type="file" width="48" height="48" name="bukti_pembayaran" />

                                            @error('bukti_pembayaran')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                            @enderror 
																						
                                        </div>
										<div>										
											<input class="form-check-input" id="takeImage" type="checkbox" name="takeImage" />
											<label class="form-check-label" for="takeImage">Ambil Gambar</label>
	
											<div>
												<img src="{{ asset('storage/daftar-pengeluaran/'.$datas->bukti_pembayaran) }}" alt="" width="200px" class="img-fluid mt-2">
											</div>


											<div id="image" style="display:none">
												<div>
													<input type="hidden" id="bukti_pembayaran" name="image">
													<video width="250" height="200" autoplay="true" id="videoElement">
													</video>
													<canvas width="250" height="200" id="canvas"></canvas>
												</div>
											</div>
	
											@error('bukti_pembayaran')
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
							<a href="{{ route('daftar-pengeluaran') }}" class="btn btn-light">Kembali</a>
						</div>
					</form>

					<div class="d-flex ps-3 pb-3 mb-3">
						<div>
							<button class="btn btn-success" id="captureButton">Capture Image</button>
						</div>
						<div>
							<button class="btn btn-warning" id="cancelButton" onclick="cancelCapture()">Cancel Capture</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	
	@push('scripts')
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const jumlahPembayaranInput = document.querySelector('input[name="jumlah_pembayaran"]');
			const displayElement = document.createElement('div');
			displayElement.innerHTML = 'Number Format: <strong>RP. ' + new Intl.NumberFormat('id-ID').format(jumlahPembayaranInput.value) + '</strong>';
			jumlahPembayaranInput.parentNode.appendChild(displayElement);

			jumlahPembayaranInput.addEventListener('input', function() {
				const typedValue = jumlahPembayaranInput.value;
				displayElement.innerHTML = 'Number Format: <strong>RP. ' + new Intl.NumberFormat('id-ID').format(typedValue) + '</strong>';
			});
		});
	</script>

	<script>
		function toggleUserFields() {
			var takeImageCheckbox = document.getElementById('takeImage');
			var image = document.getElementById('image');
			var buktiBayar = document.getElementById('buktiBayar');
			const video = document.querySelector(`#videoElement`);
			const canvas = document.getElementById('canvas');
			const captureButton = document.getElementById('captureButton');
			const cancelButton = document.getElementById('cancelButton');
			const imageInput = document.getElementById('bukti_pembayaran');
		
			if (video && takeImageCheckbox.checked) {
				if (navigator.mediaDevices.getUserMedia) {
					navigator.mediaDevices.getUserMedia({ video: true })
						.then(function (stream) {
							video.srcObject = stream;
						})
						.catch(function (error) {
							console.log("Something went wrong!", error);
						});

					captureButton.addEventListener('click', function() {
						const context = canvas.getContext('2d');
						context.drawImage(video, 0, 0, canvas.width, canvas.height);

						const imgData = canvas.toDataURL('image/png');
						imageInput.value = imgData;
					});
				} else {
					console.log("getUserMedia not supported on your browser!");
				}
			} else {
				console.log(`Video element not found!`);
			}

			if (takeImageCheckbox.checked) {
				image.style.display = 'block';
				captureButton.style.display = 'block';
				cancelButton.style.display = 'block';
				buktiBayar.style.display = 'none';
			} else {
				image.style.display = 'none';
				captureButton.style.display = 'none';
				cancelButton.style.display = 'none';
				buktiBayar.style.display = 'block';
			}
		}

		function cancelCapture() {
			const video = document.querySelector(`#videoElement`);
			const imageInput = document.getElementById('bukti_pembayaran');
			const image = document.getElementById('image');
			const captureButton = document.getElementById('captureButton');
			const buktiBayar = document.getElementById('buktiBayar');
			
			video.srcObject = null;
			imageInput.value = '';
			image.style.display = 'none';
			captureButton.style.display = 'none';
			buktiBayar.style.display = 'block';

			const context = canvas.getContext('2d');
    		context.clearRect(0, 0, canvas.width, canvas.height);
		}

		document.getElementById('takeImage').addEventListener('change', toggleUserFields);

		document.addEventListener('DOMContentLoaded', toggleUserFields);
	</script>
	@endpush

@endsection