@extends('layouts.admin.master')

@section('title')Laporan Laba/Rugi
 {{ $title }}
@endsection

@push('css')
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Laporan Laba/Rugi</h3>
		@endslot
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
					<a href="{{ route('laporan.laba-rugi') }}" class="btn btn-md btn-secondary" title="Reset"><i class="fa fa-refresh"></i> Reset</a>
				</div>
			</div>
		</form>
        <div class="row">
        </div>
	    <div class="row">
	        <!-- Server Side Processing start-->
            <div class="col-sm-12 col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        Periode: {{ \Carbon\Carbon::parse($start)->translatedFormat('d F Y') }} s/d {{ \Carbon\Carbon::parse($end_date)->translatedFormat('d F Y') }}                    
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a class="list-group-item list-group-item-action flex-column align-items-start" href="javascript:void(0)">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Jumlah Pengiriman</h5>
                                </div>
                                <p class="mb-1">Rp. {{ number_format($jumlah_pengiriman->totalPengiriman, 0, ',', '.') ?? 0 }} ,-</p>
                            </a>
                            {{-- <a class="list-group-item list-group-item-action flex-column align-items-start" href="javascript:void(0)">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Jumlah Pemasukkan</h5>
                                </div>
                                <p class="mb-1">Rp. {{ number_format($jumlah_pemasukkan->totalPemasukan, 0, ',', '.') ?? 0 }} ,-</p>
                            </a> --}}
                            <a class="list-group-item list-group-item-action flex-column align-items-start" href="javascript:void(0)">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Jumlah Pengeluaran</h5>
                                </div>
                                <p class="mb-1">Rp. {{ number_format($jumlah_pengeluaran->totalPengeluaran, 0, ',', '.') ?? 0 }} ,-</p>
                            </a>

                            {{-- @php
                                $laba_rugi = $jumlah_pengiriman->totalPengiriman + $jumlah_pemasukkan->totalPemasukan - $jumlah_pengeluaran->totalPengeluaran;
                            @endphp

                            <a class="list-group-item list-group-item-action flex-column align-items-start" href="javascript:void(0)">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Laba / Rugi</h5>
                                </div>
                                <p class="mb-1">
                                    <span class="badge {{ $laba_rugi >= 0 ? 'badge-primary' : 'badge-danger' }}" style="font-size: 15px">
                                        Rp. {{ number_format($laba_rugi, 0, ',', '.') ?? 0 }} ,-
                                    </span>
                                </p>
                            </a> --}}
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        {{-- <a href="{{ route('laporan.laba-rugi.export-pdf', ['start' => request('start'), 'end' => request('end')]) }}" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak PDF">
                            <i class="fa fa-file-pdf-o"></i> Cetak PDF
                        </a> --}}
                    </div>
                </div>
            </div>
	        <!-- Server Side Processing end-->
	    </div>
	</div>
	
	@push('scripts')
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
                periode.value = null;
				periode.style.display = 'none';
				start.style.display = 'block';
				sampaiDengan.style.display = 'block';
				end.style.display = 'block';
			}
		}
    </script>
	@endpush

@endsection
