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
				<div>
					<input class="form-control" type="date" name="start" value="{{ request('start') ? request('start') : date('Y-m-d') }}" />
				</div>
				<div class="px-2">
					<p class="fs-5">s/d</p>
				</div>
				<div>
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
                        Periode: {{ \Carbon\Carbon::parse($start)->translatedFormat('d F Y') }} s/d {{ \Carbon\Carbon::parse($end)->translatedFormat('d F Y') }}                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a class="list-group-item list-group-item-action flex-column align-items-start" href="javascript:void(0)">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Jumlah Pengiriman</h5>
                                </div>
                                <p class="mb-1">Rp. {{ $jumlah_pengiriman->totalPengiriman ?? 0 }} ,-</p>
                            </a>
                            <a class="list-group-item list-group-item-action flex-column align-items-start" href="javascript:void(0)">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Jumlah Pemasukkan</h5>
                                </div>
                                <p class="mb-1">Rp. {{ $jumlah_pemasukkan->totalPemasukan ?? 0 }} ,-</p>
                            </a>
                            <a class="list-group-item list-group-item-action flex-column align-items-start" href="javascript:void(0)">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Jumlah Pengeluaran</h5>
                                </div>
                                <p class="mb-1">Rp. {{ $jumlah_pengeluaran->totalPengeluaran ?? 0 }} ,-</p>
                            </a>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary">Cetak PDF</button>
                    </div>
                </div>
            </div>
	        <!-- Server Side Processing end-->
	    </div>
	</div>
	
	@push('scripts')
	@endpush

@endsection
