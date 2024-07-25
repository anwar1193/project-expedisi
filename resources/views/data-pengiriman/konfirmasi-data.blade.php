@extends('layouts.admin.master')

@section('title')Data Pengiriman
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<style>
    .dataTables_wrapper {
        overflow-x: auto;
    }

    .is-invalid {
        border: 2px solid red;
    }

    .content {
        flex: 1;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

    .table-container {
        flex: 1;
        overflow: auto;
        max-height: 500px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 8px 12px;
        border: 1px solid #ccc;
        text-align: left;
    }

    .table thead th {
        background-color: #f2f2f2;
        position: sticky;
        top: 0;
        z-index: 1;
    }

    .scrollbar-container {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 20px; /* Adjust height as needed */
        overflow-x: auto;
        background: #f1f1f1;
        z-index: 2; /* Ensure it appears above other content */
    }

    .scrollbar {
        height: 1px; /* Invisible but allows scrolling */
        width: 100%;
    }

    .custom-select2 + .select2-container--default .select2-selection--single .select2-selection__rendered {
        background-color: red;
    }

    /* .scrollbar-container::-webkit-scrollbar {
        height: 20px;
    } */
</style>
@endpush

@section('content')	
	<div class="container-fluid">
        <div class="row">
        </div>
	    <div class="row">
	        <!-- Server Side Processing start-->
	        <div class="col-sm-12">
	            <div class="card">
                    <form id="myForm" method="POST" action="{{ route('data-pengiriman.proses-konfimasi-excel') }}">
                        @csrf
                        <div class="card-body">
                            @if (session()->has('error') && is_string(session('error')))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Gagal <i class="fa fa-info-circle"></i></strong> 
                                    {{ session('error') }}
                                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif


                            @if (session()->has('error') && is_array(session('error')))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Gagal <i class="fa fa-info-circle"></i></strong>
                                    <ul>
                                        @foreach (session('error') as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    @foreach ($errors->all() as $error)
                                        <strong>Gagal <i class="fa fa-info-circle"></i></strong> 
                                        {{ $error }}
                                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                        <br>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Table --}}
                            <div class="content">
                                <div class="table-responsive table-container" id="table-container">
                                    <h5>Silahkan Periksa Data Yang Diimport Terlebih Dahulu</h5>
                                    <p class="mb-2">Jika Sudah Sesuai Silahkan Klik Simpan</p>
                                    <table class="table table-bordered" id="">
                                        <thead>
                                            <tr>
                                                <th>No Resi</th>
                                                <th>Tgl Transaksi</th>
                                                <th>Diinput Oleh</th>
                                                <th>Kode Customer</th>
                                                <th>Nama Pengirim</th>
                                                <th>Nama Penerima</th>
                                                <th>Kota Tujuan</th>
                                                <th>No HP Pengirim</th>
                                                <th>No HP Penerima</th>
                                                <th>Berat Barang</th>
                                                <th>Ongkir</th>
                                                <th>Komisi</th>
                                                <th>Metode Pembayaran</th>
                                                <th>Bank</th>
                                                <th>Bukti Pembayaran</th>
                                                <th>Jenis Pengiriman</th>
                                                <th>Bawa Sendiri</th>
                                                <th>Status Pengiriman</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($formattedData as $row)
                                                <tr>
                                                    <td>
                                                        <input class="@error('no_resi')  @enderror" type="text" name="no_resi[]" value="{{ $row['no_resi'] }}">

                                                        @error('no_resi[]')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input class="@error('tgl_transaksi')  @enderror" type="date" name="tgl_transaksi[]" value="{{ $row['tgl_transaksi'] }}">

                                                        @error('tgl_transaksi[]')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </td>

                                                    <td>
                                                        <select name="input_by[]" class="form-control @error('input_by')  @enderror js-example-basic-single">
                                                            <option value="">-Pilih-</option>
                                                            @foreach ($kasir as $item)
                                                                <option value="{{ $item->nama }}" {{ strtolower($row['diinput_oleh']) == strtolower($item->nama) ? 'selected' : '' }}>
                                                                    {{ $item->nama }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        @error('input_by[]')
                                                        <div class="text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </td>

                                                    <td>
                                                        <select name="kode_customer[]" class="form-select @error('kode_customer')  @enderror js-example-basic-single">
                                                            <option value="">-Pilih-</option>
                                                            <option value="General" {{ $row['kode_customer'] == 'General' ? 'selected' : '' }}> General </option>
                                                            @foreach ($customer as $item)
                                                                <option value="{{ $item->kode_customer }}" {{ $row['kode_customer']== $item->kode_customer ? 'selected' : '' }}>
                                                                    {{ $item->kode_customer }} : {{ $item->nama }} - {{ $item->perusahaan }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        @error('kode_customer[]')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input class="" type="text" name="nama_pengirim[]" value="{{ $row['nama_pengirim'] }}">

                                                        @error('nama_pengirim[]')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input class="@error('nama_penerima')  @enderror" type="text" name="nama_penerima[]" value="{{ $row['nama_penerima'] }}">

                                                        @error('nama_penerima[]')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input class="@error('kota_tujuan')  @enderror" type="text" name="kota_tujuan[]" value="{{ $row['kota_tujuan'] }}">

                                                        @error('kota_tujuan[]')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input class="@error('no_rno_hp_pengirimesi')  @enderror" type="text" name="no_hp_pengirim[]" value="{{ $row['no_hp_pengirim'] }}">

                                                        @error('no_hp_pengirim[]')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input class="@error('no_hp_penerima')  @enderror" type="text" name="no_hp_penerima[]" value="{{ $row['no_hp_penerima'] }}">
                                                        
                                                        @error('no_hp_penerima[]')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input class="@error('berat_barang')  @enderror" type="number" name="berat_barang[]" value="{{ $row['berat_barang'] }}">

                                                        @error('berat_barang[]')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input class="@error('ongkir')  @enderror" type="number" name="ongkir[]" value="{{ $row['ongkir'] }}">

                                                        @error('ongkir[]')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input class="@error('komisi')  @enderror" type="number" name="komisi[]" value="{{ $row['komisi'] }}">

                                                        @error('komisi[]')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <select name="metode_pembayaran[]" class="form-control @error('metode_pembayaran')  @enderror js-example-basic-single" id="metodePembayaran">
                                                            <option value="">-Pilih-</option>
                                                            @foreach ($metode as $item)
                                                                <option value="{{ $item->metode }}" {{ strtolower($row['metode_pembayaran']) == strtolower($item->metode) ? 'selected' : '' }}>
                                                                    {{ $item->metode }} 
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        <div class="py-1">
                                                            <input class="form-check-input tambahPembayaran" id="tambahPembayaran[]" type="checkbox" name="tambahPembayaran[]" />
                                                            <label class="form-check-label" for="">Tambah</label>
                                                        </div>

                                                        <div class="additionalPaymentOptions pt-2" style="display: none;">
                                                            <select name="metode_pembayaran_2[]" class="form-control js-example-basic-single metodePembayaran2">
                                                                <option value="">-Pilih-</option>
                                                                @foreach ($metode as $item)
                                                                <option value="{{ $item->metode }}">
                                                                    {{ $item->metode }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        {{-- <select name="metode_pembayaran2[]" class="form-control @error('metode_pembayaran')  @enderror js-example-basic-single" id="metodePembayaran2">
                                                            <option value="">-Pilih-</option>
                                                            @foreach ($metode as $item)
                                                                <option value="{{ $item->metode }}" {{ strtolower($row['metode_pembayaran']) == strtolower($item->metode) ? 'selected' : '' }}>
                                                                    {{ $item->metode }} 
                                                                </option>
                                                            @endforeach
                                                        </select> --}}

                                                        @error('metode_pembayaran[]')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <select name="bank[]" class="form-control @error('bank')  @enderror js-example-basic-single" id="bankSelect">
                                                            <option value="">-Pilih-</option>
                                                            @foreach ($bank as $item)
                                                                <option value="{{ $item->bank }}" {{ strtolower($row['bank']) == strtolower($item->bank) ? 'selected' : '' }}>
                                                                    {{ $item->bank }}
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        <div class="additionalBankOptions pt-2" style="display: none;">
                                                            <select name="bank_2[]" class="form-control js-example-basic-single bankSelect2">
                                                                <option value="">-Pilih-</option>
                                                                @foreach ($bank as $item)
                                                                <option value="{{ $item->bank }}">
                                                                    {{ $item->bank }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        
                                                        {{-- <select name="bank2[]" class="form-control @error('bank')  @enderror js-example-basic-single" id="bankSelect2">
                                                            <option value="">-Pilih-</option>
                                                            @foreach ($bank as $item)
                                                                <option value="{{ $item->bank }}" {{ $row['bank']== $item->bank ? 'selected' : '' }}>
                                                                    {{ $item->bank }}
                                                                </option>
                                                            @endforeach
                                                        </select> --}}

                                                        @error('bank[]')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input id="bukti_pembayaran" class="@error('bukti_pembayaran')  @enderror" type="text" name="bukti_pembayaran[]" value="{{ $row['bukti_pembayaran'] }}"> 
                                                        
                                                        <div class="additionalBuktiOptions pt-2" style="display: none;">
                                                            <input id="bukti_pembayaran_2" class="@error('bukti_pembayaran')  @enderror" type="text" name="bukti_pembayaran_2[]" value="{{ old('bukti_pembayaran_2[]') }}"> 
                                                        </div>
                                                        @error('bukti_pembayaran[]')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <input class="@error('jenis_pengiriman')  @enderror" type="text" name="jenis_pengiriman[]" value="{{ $row['jenis_pengiriman'] }}"> 

                                                        @error('jenis_pengiriman[]')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <select name="bawa_sendiri[]" class="form-control @error('metode_pembayaran')  @enderror js-example-basic-single">
                                                            <option value="Ya" {{ $row['bawa_sendiri'] == 'Ya' ? 'selected' : '' }}> Ya </option>
                                                            <option value="Di jemput" {{ $row['bawa_sendiri'] == 'Di jemput' ? 'selected' : '' }}> Di jemput </option>
                                                        </select>

                                                        @error('bawa_sendiri[]')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </td>
                                                    <td>
                                                        <select name="status_pengiriman[]" class="form-control @error('status_pengiriman')  @enderror js-example-basic-single">
                                                            @foreach ($status as $item)
                                                                <option value="{{ $item->status_pengiriman }}" {{ strtolower($row['status_pengiriman']) == strtolower($item->status_pengiriman) ? 'selected' : '' }}>
                                                                    {{ $item->status_pengiriman }} 
                                                                </option>
                                                            @endforeach
                                                        </select>

                                                        @error('status_pengiriman[]')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                        {{-- <input type="text" name="status_pengiriman[]" value="{{ $row['status_pengiriman'] }}">  --}}
                                                    </td>
                                                    <td>
                                                        <input class="@error('keterangan')  @enderror" type="text" name="keterangan[]" value="{{ $row['keterangan'] }}"> 

                                                        @error('keterangan[]')
                                                            <div class="text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    
                                </div>
                            </div>

                            <div class="scrollbar-container" id="scrollbar-container">
                                <div class="scrollbar"></div>
                            </div>

                        </div>
                        <div class="card-footer float-end">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                            <a class="btn btn-warning" href="{{ route('data-pengiriman') }}">Kembali</a>
                        </div>
                    </form>
	            </div>
	        </div>
	        <!-- Server Side Processing end-->
	    </div>
	</div>
	
	@push('scripts')
	<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script>
		$(document).ready(function() {
			$('#basic-1').DataTable({
				language: {
					"emptyTable": "Tidak ada data yang tersedia pada tabel ini",
					"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
					"infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
					"infoFiltered": " (disaring dari _MAX_ entri keseluruhan)",
					"lengthMenu": "Tampilkan _MENU_ entri",
					"loadingRecords": "Sedang memuat...",
					"processing": "Sedang memproses...",
					"search": "Cari:",
					"zeroRecords": "Tidak ditemukan data yang sesuai",
					"paginate": {
					"first": "Pertama",
					"last": "Terakhir",
					"next": "Selanjutnya",
					"previous": "Sebelumnya"
					},
				},
                scrollX: true,
                searching: false,
			});

            $('.custom-select2').select2();
            
            $('#metodePembayaran').on('change', function() {
                var selectedMethod = $(this).val();
                var bankSelect = $('#bankSelect');
                var buktiPembayaran = $('#bukti_pembayaran');
                bankSelect.empty();

                if (selectedMethod === 'Transfer') {
                    @foreach ($bank as $item)
                        bankSelect.append(new Option('{{ $item->bank }}', '{{ $item->bank }}', false, false));
                    @endforeach
                } else {
                    bankSelect.append(new Option('-', '', false, false));
                }
            }).trigger('change');

            $('body').on('change', '.tambahPembayaran', function() {
                var $row = $(this).closest('tr');
                if ($(this).is(':checked')) {
                    $row.find('.additionalPaymentOptions').show();
                    $row.find('.additionalBankOptions').show();
                    $row.find('.additionalBuktiOptions').show();
                } else {
                    $row.find('.additionalPaymentOptions').hide();
                    $row.find('.additionalBankOptions').hide();
                    $row.find('.additionalBuktiOptions').hide();
                }
            });

		})
	</script>	
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tableContainer = document.getElementById('table-container');
            const scrollbarContainer = document.getElementById('scrollbar-container');
            const scrollbar = document.querySelector('.scrollbar');

            // Synchronize scroll positions
            scrollbarContainer.addEventListener('scroll', function() {
                tableContainer.scrollLeft = scrollbarContainer.scrollLeft;
            });

            tableContainer.addEventListener('scroll', function() {
                scrollbarContainer.scrollLeft = tableContainer.scrollLeft;
            });

            // Set the width of the scrollbar to match the table content width
            scrollbar.style.width = tableContainer.scrollWidth + 'px';

            // Ensure scrollbar is always visible
            // scrollbarContainer.style.overflowX = 'scroll';
        });
    </script>
    @include('data-pengiriman.partial.form-validation')
	@endpush

@endsection


