@extends('layouts.admin.master')

@section('title')Data Pengiriman
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')	
	<div class="container-fluid">
        <div class="row">
        </div>
	    <div class="row">
	        <!-- Server Side Processing start-->
	        <div class="col-sm-12">
	            <div class="card">
                    <div class="card-header">
                        <h5>Silahkan Periksa Data Yang Diimport Terlebih Dahulu</h5>
                    </div>
                    <form method="POST" action="{{ route('data-pengiriman.proses-konfimasi-excel') }}">
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
                            <div class="table-responsive">
                                <p class="mb-4">Jika Sudah Sesuai Silahkan Klik Simpan</p>
                                <table class="display" id="basic-1">
                                    <thead>
                                        <tr>
                                            <th>No Resi</th>
                                            <th>Tgl Transaksi</th>
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
                                                    <input type="text" name="no_resi[]" value="{{ $row['no_resi'] }}">
                                                </td>
                                                <td>
                                                    <input type="date" name="tgl_transaksi[]" value="{{ $row['tgl_transaksi'] }}">
                                                </td>
                                                <td>
                                                    <select name="kode_customer[]" class="form-control @error('kode_customer') is-invalid @enderror">
                                                        <option value="general" {{ $row['kode_customer'] == 'general' ? 'selected' : '' }}> General </option>
                                                        @foreach ($customer as $item)
                                                            <option value="{{ $item->kode_customer }}" {{ $row['kode_customer']== $item->kode_customer ? 'selected' : '' }}>
                                                                {{ $item->kode_customer }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="nama_pengirim[]" value="{{ $row['nama_pengirim'] }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="nama_penerima[]" value="{{ $row['nama_penerima'] }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="kota_tujuan[]" value="{{ $row['kota_tujuan'] }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="no_hp_pengirim[]" value="{{ $row['no_hp_pengirim'] }}">
                                                </td>
                                                <td>
                                                    <input type="text" name="no_hp_penerima[]" value="{{ $row['no_hp_penerima'] }}">
                                                </td>
                                                <td>
                                                    <input type="number" name="berat_barang[]" value="{{ $row['berat_barang'] }}">
                                                </td>
                                                <td>
                                                    <input type="number" name="ongkir[]" value="{{ $row['ongkir'] }}">
                                                </td>
                                                <td>
                                                    <input type="number" name="komisi[]" value="{{ $row['komisi'] }}">
                                                </td>
                                                <td>
                                                    <select name="metode_pembayaran[]" class="form-control @error('metode_pembayaran') is-invalid @enderror">
                                                        <option value="Transfer" {{ $row['metode_pembayaran'] == 'Transfer' ? 'selected' : '' }}> Transfer </option>
                                                        <option value="Tunai" {{ $row['metode_pembayaran'] == 'Tunai' ? 'selected' : '' }}> Tunai </option>
                                                        <option value="Kredit" {{ $row['metode_pembayaran'] == 'Kredit' ? 'selected' : '' }}> Kredit </option>
                                                    </select>
                                                </td>
                                                <td>
                                                        <select name="bank[]" class="form-control @error('bank') is-invalid @enderror">
                                                            @if ($row['metode_pembayaran'] != 'Transfer')
                                                                <option value="">-</option>
                                                            @else
                                                                @foreach ($bank as $item)
                                                                    <option value="{{ $item->bank }}" {{ $row['bank']== $item->bank ? 'selected' : '' }}>
                                                                        {{ $item->bank }}
                                                                    </option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="bukti_pembayaran[]" value="{{ $row['bukti_pembayaran'] }}" {{ $row['metode_pembayaran'] != 'Transfer' ? 'readonly' : '' }}> 
                                                </td>
                                                <td>
                                                    <input type="text" name="jenis_pengiriman[]" value="{{ $row['jenis_pengiriman'] }}"> 
                                                </td>
                                                <td>
                                                    <select name="bawa_sendiri[]" class="form-control @error('metode_pembayaran') is-invalid @enderror">
                                                        <option value="Ya" {{ $row['bawa_sendiri'] == 'Ya' ? 'selected' : '' }}> Ya </option>
                                                        <option value="Di jemput" {{ $row['bawa_sendiri'] == 'Di jemput' ? 'selected' : '' }}> Di jemput </option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="status_pengiriman[]" value="{{ $row['status_pengiriman'] }}"> 
                                                </td>
                                                <td>
                                                    <input type="text" name="keterangan[]" value="{{ $row['keterangan'] }}"> 
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
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
                searching: false,
			});
		})
	</script>	
	@endpush

@endsection


