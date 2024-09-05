@extends('layouts.admin.master')

@section('title')Tambah Data Pemasukan
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/select2.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Data Pemasukan</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('data-pemasukan') }}">Data Pemasukan</a></li>
        <li class="breadcrumb-item active">Tambah</li>
	@endcomponent
	
	<div class="container-fluid">
		<div class="row">
			@if (session()->has('error'))
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Gagal <i class="fa fa-info-circle"></i></strong> 
					{{ session('error') }}
					<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			@endif
			<div class="col-sm-12">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Form Data Pemasukan</h5>
					</div>
					<form class="form theme-form" method="POST" action="{{ route('data-pemasukan.store') }}" enctype="multipart/form-data">
                        @csrf
						<div class="card-body">

							<div class="row">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Tanggal Pemasukan</label>
										<input class="form-control @error('tgl_pemasukkan') is-invalid @enderror" type="date" name="tgl_pemasukkan" autocomplete="off" value="{{ old('tgl_pemasukkan') }}"/>

										@error('tgl_pemasukkan')
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
										<label class="form-label" for="">No Resi Pengiriman</label>
										
										<select name="no_resi_pengiriman" id="no_resi_pengiriman" class="form-control @error('no_resi_pengiriman') is-invalid @enderror js-example-basic-single">
											<option value="" selected>- Pilih Resi -</option>
											@foreach ($resi as $item)
												<option value="{{ $item->no_resi }}">
													{{ $item->no_resi }} - {{ $item->nama_pengirim }} To {{ $item->nama_penerima }}
												</option>
											@endforeach
										</select>

										@error('no_resi_pengiriman')
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
										<label class="form-label" for="">Kategori</label>
										<select name="kategori" id="kategori" class="form-control @error('kategori') is-invalid @enderror">
											<option value="">- Pilih Kategori -</option>
											<option value="barang" {{ old('kategori') == 'barang' ? 'selected' : '' }}>Barang</option>
											<option value="jasa" {{ old('kategori') == 'jasa' ? 'selected' : '' }}>Jasa</option>
										</select>
										@error('kategori')
										<div class="text-danger">
											{{ $message }}
										</div>
										@enderror
									</div>
								</div>
							</div>
							
							<div id="barang" class="row" style="display: none">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Barang</label>
										<select name="barang" id="barangs" class="form-control @error('barang') is-invalid @enderror">
											<option value="">- Pilih Barang -</option>
											@foreach ($barangs as $item)
												<option value="{{ $item->id }}" {{ old('id') == $item->id ? 'selected' : '' }}>
													{{ $item->nama_barang }}
												</option>
											@endforeach
										</select>
										@error('barang')
										<div class="text-danger">
											{{ $message }}
										</div>
										@enderror
									</div>
								</div>
							</div>
							
							<div id="jumlahBarang" class="row" style="display: none">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Jumlah Barang</label>
										<input type="number" name="jumlah_barang" id="" class="form-control @error('jumlah_barang') is-invalid @enderror" value="{{ old('jumlah_barang') }}">
										<p id="stokBarang" class="text-muted" style="font-size: 12px"></p>
										@error('jumlah_barang')
										<div class="text-danger">
											{{ $message }}
										</div>
										@enderror
									</div>
								</div>
							</div>
							
							<div id="jasa" class="row" style="display: none">
								<div class="col">
									<div class="mb-3">
										<label class="form-label" for="">Jasa</label>
										<select name="jasa" id="jasa" class="form-control @error('jasa') is-invalid @enderror">
											<option value="">- Pilih Jasa -</option>
											@foreach ($jasas as $item)
												<option value="{{ $item->id }}" {{ old('id') == $item->id ? 'selected' : '' }}>
													{{ $item->nama_jasa }}
												</option>
											@endforeach
										</select>
										@error('jasa')
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
										<label class="form-label" for="">Modal</label>
										<input class="form-control @error('modal') is-invalid @enderror" type="text" name="modal" autocomplete="off" value="{{ old('modal') }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"/>

										@error('modal')
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
										<label class="form-label" for="">Jumlah Pemasukan</label>
										<input class="form-control @error('jumlah_pemasukkan') is-invalid @enderror" type="text" name="jumlah_pemasukkan" autocomplete="off" value="{{ old('jumlah_pemasukkan') }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"/>

										@error('jumlah_pemasukkan')
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
										<div class="row">
											<div class="col-3">
												<label class="form-label" for="">Sumber Pemasukan</label>
											</div>
											<div class="col">
												<input class="form-check-input" id="dataCustomer" type="checkbox" name="dataCustomer" />
												<label class="form-check-label" for="dataCustomer">Pilih Customer</label>
											</div>
										</div>
										<input class="form-control @error('sumber_pemasukkan') is-invalid @enderror" style="display: block" id="sumberPemasukkan" type="text" name="sumber_pemasukkan" autocomplete="off" value="{{ old('sumber_pemasukkan') }}"/>

										@error('sumber_pemasukkan')
										<div class="text-danger">
											{{ $message }}
										</div>
										@enderror
									</div>
									<div class="mb-3">

										<select name="customer" id="customer" class="form-control @error('customer') is-invalid @enderror" style="display: none">
											<option value="">- Pilih Customer -</option>
											@foreach ($customer as $item)
												<option value="{{ $item->nama }}" {{ old('nama') == $item->nama ? 'selected' : '' }}>
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
										<label class="form-label" for="">Metode Pembayaran</label>
										<select name="metode_pembayaran" id="metode_pembayaran" class="form-control @error('metode_pembayaran') is-invalid @enderror">
											<option value="">- Pilih Metode Pembayaran -</option>
											@foreach ($metode as $item)
												<option value="{{ $item->metode }}" {{ old('metode_pembayaran') == $item->metode ? 'selected' : '' }}>
													{{ $item->metode }}
												</option>
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

							<div class="row" id="banks" style="display: none">
								<div class="col">
									<div class="mb-2">
										<label for="" class="form-label">Bank</label>
										<select name="bank" class="form-control @error('bank') is-invalid @enderror js-example-basic-single">
											<option value="">- Pilih Bank -</option>
											@foreach ($bank as $item)
												<option value="{{ $item->bank }}" {{ old('bank') == $item->bank ? 'selected' : '' }}>
													{{ $item->bank }}
												</option>
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
									<div class="mb-2">
										<label class="form-label" for="">Bukti Pembayaran</label>
										<input class="form-control @error('bukti_pembayaran') is-invalid @enderror" id="buktiBayar" style="display: block" type="file" width="48" height="48" name="bukti_pembayaran" />
									
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
								</div>
							</div>

							<div class="row mt-2">
								<div class="col">
									<input class="form-check-input" id="multi_payment" type="checkbox" name="multi_payment" />
									<label class="form-check-label" for="multi_payment">Multi Payment</label>
								</div>
							</div>

							<div id="pembayaran2" style="display: none">
								<div class="row">
									<div class="col">
										<div class="mb-3">
											<label class="form-label" for="">Metode Pembayaran 2</label>
											<select name="metode_pembayaran2" id="metode_pembayaran2" class="form-control @error('metode_pembayaran2') is-invalid @enderror">
												<option value="">- Pilih Metode Pembayaran -</option>
	]											@foreach ($metode as $item)
													<option value="{{ $item->metode }}" {{ old('metode_pembayaran2') == $item->metode ? 'selected' : '' }}>
														{{ $item->metode }}
													</option>
												@endforeach	
											</select>
	
											@error('metode_pembayaran2')
											<div class="text-danger">
												{{ $message }}
											</div>
											@enderror
										</div>
									</div>
								</div>

								<div class="row" id="banks2" style="display: none">
									<div class="col">
										<div class="mb-2">
											<label for="" class="form-label">Bank</label>
											<select name="bank2" class="form-control @error('bank2') is-invalid @enderror js-example-basic-single">
												<option value="">- Pilih Bank -</option>
												@foreach ($bank as $item)
													<option value="{{ $item->bank }}" {{ old('bank') == $item->bank ? 'selected' : '' }}>
														{{ $item->bank }}
													</option>
												@endforeach	
											</select>

											@error('bank2')
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
											<label class="form-label" for="">Bukti Pembayaran 2</label>
											<input class="form-control @error('bukti_pembayaran2') is-invalid @enderror" id="buktiBayar2" type="file" width="48" height="48" name="bukti_pembayaran2" />
										
											@error('bukti_pembayaran2')
											<div class="text-danger">
												{{ $message }}
											</div>
											@enderror
										</div>
										<div>										
											<input class="form-check-input" id="takeImage2" type="checkbox" name="takeImage2" />
											<label class="form-check-label" for="takeImage2">Ambil Gambar</label>
	
											<div id="image2" style="display:none">
												<div>
													<input type="hidden" id="bukti_pembayaran_2" name="image2">
													<video width="250" height="200" autoplay="true" id="videoElement2">
													</video>
													<canvas width="250" height="200" id="canvas2"></canvas>
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

							<div class="row mt-2">
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

						</div>
						<div class="card-footer text-end">
							<button class="btn btn-primary" type="submit">Simpan Data</button>
							<a href="{{ route('data-pemasukan') }}" class="btn btn-light">Kembali</a>
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
					<div class="d-flex ps-3 pb-3 mb-3">
						<div>
							<button class="btn btn-success" id="captureButton2">Capture Image 2</button>
						</div>
						<div>
							<button class="btn btn-warning" id="cancelButton2" onclick="cancelCapture()">Cancel Capture</button>
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
			if (e.target.name === 'jumlah_pemasukkan') {
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
			
			if (e.target.name === 'modal') {
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
			var image = document.getElementById('image');
			var buktiBayar = document.getElementById('buktiBayar');
			var dataCustomer = document.getElementById('dataCustomer');
			var sumberPemasukkan = document.getElementById('sumberPemasukkan');
			var customer = document.getElementById('customer');
			var kredit = document.getElementById('kredit');
			const video = document.querySelector(`#videoElement`);
			const canvas = document.getElementById('canvas');
            const captureButton = document.getElementById('captureButton');
            const cancelButton = document.getElementById('cancelButton');
            const imageInput = document.getElementById('bukti_pembayaran');

			if (dataCustomer.checked) {
				customer.style.display = 'block';
				sumberPemasukkan.style.display = 'none';
			} else {
				sumberPemasukkan.style.display = 'block';
				customer.style.display = 'none';
			}
		
			if (video && takeImageCheckbox.checked) {
				if (navigator.mediaDevices.getUserMedia) {
					navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment'}  })
					// navigator.mediaDevices.getUserMedia({ video: true })
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
		
		function toggleUserFields2() {
			var takeImageCheckbox = document.getElementById('takeImage2');
			var image = document.getElementById('image2');
			var buktiBayar = document.getElementById('buktiBayar2');
			const video = document.querySelector(`#videoElement2`);
			const canvas = document.getElementById('canvas2');
            const captureButton = document.getElementById('captureButton2');
            const cancelButton = document.getElementById('cancelButton2');
            const imageInput = document.getElementById('bukti_pembayaran_2');
		
			if (video && takeImageCheckbox.checked) {
				if (navigator.mediaDevices.getUserMedia) {
					navigator.mediaDevices.getUserMedia({ video: { facingMode: 'environment'}  })
					// navigator.mediaDevices.getUserMedia({ video: true })
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
		
		function cancelCapture2() {
			const video = document.querySelector(`#videoElement2`);
			const imageInput = document.getElementById('bukti_pembayaran2');
			const image = document.getElementById('image2');
			const captureButton = document.getElementById('captureButton2');
			const buktiBayar = document.getElementById('buktiBayar2');
			
			video.srcObject = null;
			imageInput.value = '';
			image.style.display = 'none';
			captureButton.style.display = 'none';
			buktiBayar.style.display = 'block';

			const context = canvas.getContext('2d');
    		context.clearRect(0, 0, canvas.width, canvas.height);
		}

		document.getElementById('takeImage').addEventListener('change', toggleUserFields);
		document.getElementById('takeImage2').addEventListener('change', toggleUserFields2);

		document.addEventListener('DOMContentLoaded', toggleUserFields);
		document.addEventListener('DOMContentLoaded', toggleUserFields2);
	</script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
        const dataCustomerCheckbox = document.getElementById('dataCustomer');
        const customerSelect = document.getElementById('customer');
        const kredit = document.getElementById('kredit');
		const sumberPemasukkan = document.getElementById('sumberPemasukkan');
		const kategori = document.getElementById('kategori');
		const barang = document.getElementById('barang');
		const barangs = document.getElementById('barangs');
		const jumlahBarang = document.getElementById('jumlahBarang');
		const jasa = document.getElementById('jasa');
		const metodePembayaran = document.getElementById('metode_pembayaran');
		const metodePembayaran2 = document.getElementById('metode_pembayaran2');
		const bank = document.getElementById('banks');
		const bank2 = document.getElementById('banks2');
		const stokBarang = document.getElementById('stokBarang');
		const modalInput = document.querySelector('input[name="modal"]');
		const multiPaymentCheckbox = document.getElementById('multi_payment');
		const pembayaranKeDua = document.getElementById('pembayaran2');

        // Fungsi untuk mengubah visibilitas elemen select
        function toggleCustomerSelect() {
            if (dataCustomerCheckbox.checked) {
                customerSelect.style.display = 'block';
				kredit.style.display = 'block';
				sumberPemasukkan.style.display = 'none';
            } else {
                customerSelect.style.display = 'none';
                kredit.style.display = 'none';
				sumberPemasukkan.style.display = 'block';
            }
        }

		function toggleCategorySelect() {
			const value = kategori.value;
			console.log(value);
			
			if (value === "barang") {
				barang.style.display = 'block';
				jumlahBarang.style.display = 'block';
				jasa.style.display = 'none';
			} else if (value === "jasa") {
				jasa.style.display = 'block';
				barang.style.display = 'none';
				jumlahBarang.style.display = 'none';
				modalInput.value = "";
			}
		}
		
		function toggleBarangSelect() {
			const value = barangs.value;

			const barangData = {!! json_encode($barangs) !!};
			
			const valueBarang = barangData.find(item => item.id == value);
			
			stokBarang.textContent = 'Stok Barang Tersedia: ' + valueBarang.stok;
			modalInput.value = valueBarang.harga_jual;
		}

		function toggleMultiPayment() {
			if (multiPaymentCheckbox.checked) {
                pembayaranKeDua.style.display = 'block';
            } else {
                pembayaranKeDua.style.display = 'none';
            }
		}

		function toggleMetodeTransfer() {
			const metode = (metodePembayaran.value).toLowerCase();

			 (metode == 'transfer') ? bank.style.display = 'block' : bank.style.display = 'none';

		}
		
		function toggleMetodeTransfer2() {
			const metode = (metodePembayaran2.value).toLowerCase();

			 (metode == 'transfer') ? bank2.style.display = 'block' : bank2.style.display = 'none';

		}

		barang.addEventListener('change', toggleBarangSelect);
		kategori.addEventListener('change', toggleCategorySelect);
		metodePembayaran.addEventListener('change', toggleMetodeTransfer);
		metodePembayaran2.addEventListener('change', toggleMetodeTransfer2);

        // Tambahkan event listener ke checkbox
        dataCustomerCheckbox.addEventListener('change', toggleCustomerSelect);
		multiPaymentCheckbox.addEventListener('change', toggleMultiPayment)
		
        // Panggil fungsi saat halaman pertama kali dimuat
        toggleCustomerSelect();
		toggleCategorySelect();
		toggleBarangSelect();
		toggleMultiPayment();
		toggleMetodeTransfer();
		toggleMetodeTransfer2();

    });
	</script>
	@endpush

@endsection