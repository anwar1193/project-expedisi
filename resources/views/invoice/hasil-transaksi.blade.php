@extends('layouts.admin.master')

@section('title')Invoice
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<style>
	.dataTables_filter {
		display: none;
	}

    .dataTables_length label {
        display: none
    }
</style> 
@endpush

@section('content')
	
	<div class="container invoice">
	    <div class="row">
	        <div class="col-sm-12">
				<form action="{{ route('invoice.customer-pdf', ['id' => $customer->id, 'invoiceId' => $customer->invoiceId]) }}" method="GET" target="_blank">
	            <div class="card">
	                <div class="card-body">	
						@if (session()->has('success'))
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>Berhasil <i class="fa fa-info-circle"></i></strong> 
								{{ session('success') }}
								<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif
											
						@if (session()->has('error'))
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Gagal <i class="fa fa-info-circle"></i></strong> 
								{{ session('error') }}
								<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif
						
	                    <div>
	                        <div>
	                            <div class="row invo-header">
	                                <div class="col-sm-5">
	                                    <div class="media">
	                                        <div class="media-left">
												<img src="{{  asset('assets/lionparcel.png') }}" alt="Lion Parcel" style="width: 200px; height: 60px;" />
												<h4 class="text-danger ps-2 fw-bold">D Angel Express</h4>	                                        </div>
	                                    </div>
	                                    <!-- End Info-->
	                                </div>
	                                <div class="col-sm-3 d-flex align-items-end">
	                                    <div class="text-md-end text-xs-center">
	                                        <h3>Invoice</h3>
	                                    </div>
	                                </div>
	                                <div class="col-sm-3 d-flex align-items-end">
	                                    <div class="text-md-end text-xs-center">
	                                        <p>Makassar, {{ formatTanggalIndonesia($customer->created_at) }}</p>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <!-- End InvoiceTop-->
	                        <div class="row invo-profile py-2 my-2" style="border: 0.5px solid; width: 70%">
	                            <div class="col-xl-8">
	                                <div class="text-xl-start" id="project">
                                        <div class="row d-flex py-1 text-start justify-content-start">
                                            <div class="col-4 col-lg-4">Invoice No</div>
                                            <div class="col-1 col-lg-2">:</div>
                                            <div class="col-6 col-lg-6 text-capitalize">{{ $customer->invoice_no }}</div>
                                        </div>
                                        <div class="row d-flex py-1 text-start justify-content-start">
                                            <div class="col-4 col-lg-4">Customer Name</div>
                                            <div class="col-1 col-lg-2">:</div>
                                            <div class="col-6 col-lg-6 text-capitalize">{{ $customer->nama }}</div>
                                        </div>
                                        <div class="row d-flex py-1 text-start justify-content-start">
                                            <div class="col-4 col-lg-4">Address</div>
                                            <div class="col-1 col-lg-2">:</div>
                                            <div class="col-6 col-lg-6 text-capitalize">{{ $customer->alamat }}</div>
                                        </div>
	                                </div>
	                            </div>
	                        </div>
							<div class="my-2 py-2">
								<small>Biaya Pengiriman</small> {{ $customer->perusahaan != NULL ? $customer->perusahaan : $customer->nama }}
							</div>
	                        <!-- End Invoice Mid-->
	                        <div>
	                            <div class="table-responsive" id="table">
	                                <table class="display" id="basic-1">
	                                    <thead class="text-center">
											<tr>
												<th width="5%" style="border: 1px solid">No</th>
												<th style="border: 1px solid">No STT</th>
												<th width="10%" style="border: 1px solid">Tanggal</th>
												<th style="border: 1px solid">Pengirim</th>
												<th style="border: 1px solid">Penerima</th>
												<th style="border: 1px solid">Tujuan</th>
												<th style="border: 1px solid">Jumlah Pembayaran</th>
											</tr>
										</thead>
										<tbody style="font-size: 14px">
                                            @forelse ($data as $data)
                                                <tr>
                                                    <td style="border: 1px solid; padding: 5px; text-align: center">{{ $loop->iteration; }}</td>
                                                    <td style="border: 1px solid; padding: 5px; text-align: center">{{ $data->no_resi }}</td>
                                                    <td style="border: 1px solid; padding: 5px; text-align: center">{{ $data->created_at }}</td>
                                                    <td style="border: 1px solid; padding: 5px; text-align: center">{{ $data->nama_pengirim }}</td>
                                                    <td style="border: 1px solid; padding: 5px; text-align: center">{{ $data->nama_penerima }}</td>
                                                    <td style="border: 1px solid; padding: 5px; text-align: center">{{ $data->kota_tujuan }}</td>
                                                    <td style="border: 1px solid; padding: 5px; text-align: center">Rp {{ number_format($data->ongkir, 0, '.', '.') }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan={{ !isCustomer() ? "7" : "6" }} class="text-center">
                                                        <p class="fw-semibold">Belum Ada Data Transaksi</p>
                                                    </td>
                                                </tr>
                                            @endforelse 
										</tbody>
										@if (!isCustomer())
											<tfoot>
												<tr>
													<td style="border: 1px solid; padding: 5px; text-align: center"></td>
													<td colspan="5" style="border: 1px solid; padding: 5px; text-align: center">
														<p class="fw-semibold">Sub Total</p>
													</td>
													<td style="border: 1px solid; padding: 5px; text-align: center">
														Rp {{ number_format($total->total, 0, '.', '.') }}
													</td>
												</tr>
												<tr>
													<td style="border: 1px solid; padding: 5px; text-align: center"></td>
													<td colspan="5" style="border: 1px solid; padding: 5px; text-align: center">
														<p class="fw-semibold">Diskon Customer ({{ $customer->diskon_customer }}%)</p>
													</td>
													<td style="border: 1px solid; padding: 5px; text-align: center">
														Rp {{ number_format($diskon, 0, '.', '.') }}
													</td>
												</tr>
												<tr>
													<td style="border: 1px solid; padding: 5px; text-align: center"></td>
													<td colspan="5" style="border: 1px solid; padding: 5px; text-align: center">
														<p class="fw-semibold">Diskon</p>
													</td>
													<td style="border: 1px solid; padding: 5px; text-align: center">
														Rp {{ number_format($customer->diskon, 0, '.', '.') }}
													</td>
												</tr>
												<tr>
													<td style="border: 1px solid; padding: 5px; text-align: center"></td>
													<td colspan="5" style="border: 1px solid; padding: 5px; text-align: center">
														<p class="fw-semibold">Total</p>
													</td>
													<td style="border: 1px solid; padding: 5px; text-align: center">
														Rp {{ number_format($totalBersih, 0, '.', '.') }}
													</td>
												</tr>
											</tfoot>											
										@endif
	                                </table>
	                            </div>

								{{-- Pilihan Bank --}}
								<div class="pilihan-bank mt-3">
									<p>Pembayaran dapat di transfer ke rekening :</p>

									@foreach ($bank as $item)
										<table width="40%">
											<tr>
												<th>Bank</th>
												<th class="text-center">:</th>
												<th>{{ $item->bank }}</th>
											</tr>

											<tr>
												<th>Cabang</th>
												<th class="text-center">:</th>
												<th>{{ $item->cabang }}</th>
											</tr>

											<tr>
												<th>Nomor Rekening</th>
												<th class="text-center">:</th>
												<th>{{ $item->nomor_rekening }}</th>
											</tr>

											<tr>
												<th>Atas Nama</th>
												<th class="text-center">:</th>
												<th>{{ $item->atas_nama }}</th>
											</tr>
										</table>
										<br>
									@endforeach
								</div>

	                            <!-- End Table-->
	                            <div class="text-center mt-3">
									<p>Lion parcel - D Angel Express</p>
									<p>Jl. Onta Baru no 51, Kelurahan Mandala, Kecamatan Mamajang, Kota Makassar – 90135, Sulawesi Selatan</p>
									<p>Telp : 0411 – 8918311 , 082110071565</p>
									<p>Website : http://lionparcel.com</p>
								</div>
	                        </div>
	                        <!-- End InvoiceBot-->
	                    </div>
	                    <!-- End Invoice-->
	                    <!-- End Invoice Holder-->
	                </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center">
							<div class="px-2">
								<button type="submit" class="btn btn-primary">Cetak Invoice</button>
							</div>
							</form>
                            <div class="px-2">
                                <form action="{{ route('invoice.send-wa') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $customer->id }}">
                                    <input type="hidden" name="invoice_id" value="{{ $customer->invoiceId }}">
                                    <button type="submit" class="btn btn-success">Kirim Ke Whatsapp</button>
                                </form>
                            </div>
                            <div class="pz-2">
                                <form action="{{ route('invoice.send-email') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $customer->id }}">
                                    <input type="hidden" name="invoice_id" value="{{ $customer->invoiceId }}">
                                    <button type="submit" class="btn btn-success">Kirim Ke Email</button>
                                </form>
                            </div>
                            {{-- <a href="{{ route('invoice.customer-pdf', $customer->id) }}" class="btn btn btn-primary me-2">Cetak Invoice</a> --}}
	                    </div>
                    </div>
	            </div>
	        </div>
	    </div>
	</div>
	
	@push('scripts')
    <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
	<script src="{{asset('assets/js/counter/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('assets/js/counter/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('assets/js/counter/counter-custom.js')}}"></script>
    <script src="{{asset('assets/js/print.js')}}"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const diskonInput = document.querySelector('input[name="diskon"]');
			const totalDisplay = document.getElementById('totalDisplay');
			const totalAwal = {{ $total->total ?? 0 }};
			
			function updateTotal() {
				const diskon = parseInt(diskonInput.value) || 0;
				const totalAkhir = totalAwal - diskon;
				totalDisplay.innerHTML = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalAkhir);
			}

			// Tampilkan total awal
			updateTotal();

			// Event listener untuk perubahan diskon
			diskonInput.addEventListener('input', function() {
				updateTotal();
			});
		});
	</script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const diskonInput = document.querySelector('input[name="diskon"]');
			const displayElement = document.createElement('div');
			displayElement.innerHTML = '<strong>RP. ' + new Intl.NumberFormat('id-ID').format(diskonInput.value) + '</strong>';
			diskonInput.parentNode.appendChild(displayElement);

			diskonInput.addEventListener('input', function() {
				const typedValue = diskonInput.value;
				displayElement.innerHTML = '<strong>RP. ' + new Intl.NumberFormat('id-ID').format(typedValue) + '</strong>';
			});

			function toggleCheckAllSelect() {
				const checkAll = document.getElementById('checkAll');
				const checkPengiriman = document.getElementsByName('id_pengiriman[]');
				if (checkAll.checked) {
						checkPengiriman.forEach(item => {
						item.checked = true; 
					});
				} else {
					checkPengiriman.forEach(item => {
						item.checked = false; 
					});
				}
			}

			checkAll.addEventListener('change', toggleCheckAllSelect);

			toggleCheckAllSelect();
		});
	</script>
	@endpush

@endsection
