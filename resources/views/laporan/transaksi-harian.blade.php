@extends('layouts.admin.master')

@section('title')Laporan Transaksi Harian
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Laporan Transaksi Harian</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('laporan.transaksi-harian') }}">Laporan Transaksi Harian</a></li>
	@endcomponent
	
	<div class="container-fluid">
        <form class="d-flex flex-column col-12" role="search" action="" method="GET">
			<div class="d-flex justify-content-end">
				<div class="px-2">
                    <select name="filter" class="form-control" onchange="toggleDateInputs(this)">
                        <option value="">-- Filter By --</option>
                        <option value="periode" {{ $filter == 'periode' ? 'selected' : '' }}>Periode</option>
                        <option value="range" {{ $filter == 'range' ? 'selected' : '' }}>Range Tanggal</option>
                    </select>
                </div>
                <div id="periode" class="px-2" style="display: {{ $filter == 'periode' ? 'block' : 'none' }}">
                    <select name="periode" class="form-control">
                        <option value="">- Pilih Periode -</option>
                        @foreach(getPastDates() as $date)
                            <option value="{{ $date['value'] }}" {{ $periode == $date['value'] ? 'selected' : '' }}>{{ $date['name'] }}</option>
                        @endforeach
                    </select>
                </div>
				<div id="start" style="display: {{ $filter == 'range' ? 'block' : 'none' }}">
					<input class="form-control" type="date" name="start" value="{{ $start }}" />
				</div>
				<div id="sampaiDengan" class="px-2" style="display: {{ $filter == 'range' ? 'block' : 'none' }}">
					<p class="fs-5">s/d</p>
				</div>
				<div id="end" style="display: {{ $filter == 'range' ? 'block' : 'none' }}">
					<input class="form-control" type="date" name="end" value="{{ request('end') ? request('end') : date('Y-m-d') }}" />
				</div>
				<div class="px-1">
					<button type="submit" class="btn btn-primary" title="Cari"><i class="fa fa-search"></i> Cari</button>
				</div>
				<div class="px-1">
					<a href="{{ route('laporan.transaksi-harian') }}" class="btn btn-md btn-secondary" title="Reset"><i class="fa fa-refresh"></i> Reset</a>
				</div>
			</div>
		</form>
        <div class="row">
        </div>
        <div class="row">
            <!-- Server Side Processing start-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="tabbed-card">
                        <div class="card-header pb-0">
							<div class="p-2">
								Periode: {{ \Carbon\Carbon::parse($start)->translatedFormat('d F Y') }} s/d {{ \Carbon\Carbon::parse($end_date)->translatedFormat('d F Y') }}
							</div>
                            @include('laporan.nav.nav-tabs', ['activeTab' => 'home'])
                        </div>

                        <div class="tab-content" id="top-tabContentsecondary">
                            <div class="tab-pane fade active show" id="top-homesecondary" role="tabpanel" aria-labelledby="top-home-tab">
                                @include('laporan.table.data-pengiriman', ['data' => $pengiriman, 'tableId' => 'basic-1'])
                            </div>

                            {{-- <div class="tab-pane fade" id="top-profilesecondary" role="tabpanel" aria-labelledby="profile-top-tab">
                                @include('laporan.table.data-pemasukkan', ['data' => $pemasukkan, 'tableId' => 'basic-2'])
                            </div> --}}

                            <div class="tab-pane fade" id="top-contactsecondary" role="tabpanel" aria-labelledby="contact-top-tab">
                                @include('laporan.table.data-pengeluaran', ['data' => $pengeluaran, 'tableId' => 'basic-3'])
                            </div>

                        </div>	 
                    </div> 
                </div>
            </div>
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

			$('#basic-2').DataTable({
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

			$('#basic-3').DataTable({
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
	
	{{-- @foreach ($datas as $data)
		<script>
			$('#view-bukti'+{{ $data->id }}).hide();
		</script>
	@endforeach --}}

	<script>
		function showBukti(id) {
			$('#view-bukti'+id).show();
		}

		function hideBukti(id) {
			$('#view-bukti'+id).hide();
		}
	</script>

	<script>
		function toggleDateInputs(select) {
			var start = document.getElementById('start');
			var sampaiDengan = document.getElementById('sampaiDengan');
			var end = document.getElementById('end');
			var periode = document.getElementById('periode');
			if (select.value == 'periode') {
				periode.style.display = 'block';
				start.style.display = 'none';
				sampaiDengan.style.display = 'none';
				end.style.display = 'none';
			} else if (select.value == 'range') {
				periode.style.display = 'none';
				start.style.display = 'block';
				sampaiDengan.style.display = 'block';
				end.style.display = 'block';
			}
		}
	</script>
	
	@endpush

@endsection