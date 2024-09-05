@extends('layouts.admin.master')

@section('title')Tambah Data Pengeluaran
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Data Pengeluaran</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('daftar-pengeluaran') }}">Data Pengeluaran</a></li>
        <li class="breadcrumb-item active">Tambah</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Form Data Pengeluaran</h5>
					</div>
					<form class="form theme-form" method="POST" action="{{ route('daftar-pengeluaran.store') }}" enctype="multipart/form-data">
                        @csrf
						<div class="card-body">

							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Tanggal Pengeluaran</label>
										<input class="form-control @error('tgl_pengeluaran') is-invalid @enderror" type="date" name="tgl_pengeluaran" autocomplete="off" value="{{ old('tgl_pengeluaran') }}"/>

										@error('tgl_pengeluaran')
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
										<input class="form-control @error('jumlah_pembayaran') is-invalid @enderror" type="text" name="jumlah_pembayaran" autocomplete="off" value="{{ old('jumlah_pembayaran') }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"/>

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
										<label class="form-label" for="">Yang Menerima Pembayaran</label>
										<input class="form-control @error('yang_menerima') is-invalid @enderror" type="text" name="yang_menerima" autocomplete="off" value="{{ old('yang_menerima') }}"/>

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
										<label class="form-label" for="">Jenis Pengeluaran</label>
                                        <select name="jenis_pengeluaran" id="jenis_pengeluaran" class="form-control @error('jenis_pengeluaran') is-invalid @enderror">
											<option value="">- Pilih Jenis Pengeluaran -</option>
											@foreach ($jenis_pengeluaran as $jenis)
												<option value="{{ $jenis->id }}">{{ $jenis->jenis_pengeluaran }}</option>
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
										<input class="form-control @error('keterangan_tambahan') is-invalid @enderror" type="text" name="keterangan_tambahan" autocomplete="off" value="{{ old('keterangan_tambahan') }}" maxlength="255"/>

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
									<div class="mb-2">
										<label class="form-label" for="">Bukti Pembayaran</label>
										<input class="form-control @error('bukti_pembayaran') is-invalid @enderror" id="buktiBayar" style="display: block" type="file" width="48" height="48" name="bukti_pembayaran" />
										<textarea class="form-control @error('nota') is-invalid @enderror" cols="100" rows="5" id="linkId" name="link">{{ old('bukti_pembayaran') }}</textarea>

										@error('bukti_pembayaran')
										<div class="text-danger">
											{{ $message }}
										</div>
										@enderror
									</div>
									<div>										
										<input class="form-check-input" id="takeImage" type="checkbox" name="takeImage" />
										<label class="form-check-label" for="takeImage">Ambil Gambar</label>

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
									<div>										
										<input class="form-check-input" id="addLink" type="checkbox" name="addLink" />
										<label class="form-check-label" for="addLink">Sisipkan Link Gdrive</label>
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
		document.addEventListener('input', function (e) {
			if (e.target.name === 'jumlah_pembayaran') {
				const typedValue = e.target.value;
				const formattedValue = new Intl.NumberFormat('id-ID').format(typedValue);
				const displayElement = e.target.parentNode.querySelector('.typed-value');
				
				if (displayElement) {
					displayElement.innerHTML = 'Number Format: <strong>RP. ' + formattedValue + '</strong>';
				} else {
					const newDisplayElement = document.createElement('div');
					newDisplayElement.className = 'typed-value';
					newDisplayElement.innerHTML = 'Number Format: <strong>RP. ' + formattedValue + '</strong>';
					e.target.parentNode.appendChild(newDisplayElement);
				}
			}
		});
	</script>

	<script>
		function toggleUserFields() {
			var takeImageCheckbox = document.getElementById('takeImage');
			var addLinkCheckbox = document.getElementById('addLink');
			var image = document.getElementById('image');
			var link = document.getElementById('linkId');
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
				video.srcObject = null;
				console.log(`Video element not found!`);
			}

			takeImageCheckbox.addEventListener('change', function() {
				updateVisibility();
			});

			addLinkCheckbox.addEventListener('change', function() {
				updateVisibility();
			});

			function updateVisibility() {
				if (takeImageCheckbox.checked) {
					image.style.display = 'block';
					captureButton.style.display = 'block';
					cancelButton.style.display = 'block';
					buktiBayar.style.display = 'none';
					link.style.display = 'none';
				} else if (addLinkCheckbox.checked) {
					image.style.display = 'none';
					captureButton.style.display = 'none';
					cancelButton.style.display = 'none';
					buktiBayar.style.display = 'none';
					link.style.display = 'block';
				} else {
					image.style.display = 'none';
					captureButton.style.display = 'none';
					cancelButton.style.display = 'none';
					buktiBayar.style.display = 'block';
					link.style.display = 'none';
				}
			}

			updateVisibility();
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
