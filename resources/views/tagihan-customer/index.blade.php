@extends('layouts.admin.master')

@section('title')Tagihan Customer
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/fixedHeader-datatable.css') }}">
<style>
	body {
		margin: 0;
		padding: 0;
	}

	.tooltip-img {
		display: none;
		position: absolute;
		z-index: 1000;
		border: 1px solid #ccc;
		background-color: #fff;
		padding: 10px;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	}

	input[type="checkbox"] {
		transform: scale(2);
	}

	.content {
        flex: 1;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

	table.dataTable thead th, table.dataTable thead td {
		padding: 10px 18px;
		border-bottom: 1px solid #111;
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

	th {
		background-color: rgb(200, 75, 75)
	}
	.table thead th {
        background-color: #f2f2f2;
        position: sticky;
        top: 0;
        z-index: 1;
    }

	#table-wrapper {
		position: relative;
		margin-bottom: 20px;
	}

    #table-container {
		width: 100%;
		overflow-x: auto;
		white-space: nowrap;
	}

	.scrollbar-container {
		position: fixed;
		bottom: 0;
		left: 0;
		width: 100%;
		height: 20px;
		overflow-x: auto;
		background: #f1f1f1;
		z-index: 1;
	}

	.scrollbar {
		height: 1px;
		width: 100%;
	}
</style>
@endpush

@section('content')
	
	<div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Tagihan</h3>
                </div>
            </div>
        </div>
	    <div class="row">
	        <!-- Server Side Processing start-->
	        <div class="col-sm-12">
	            <div class="card">
	                <div class="card-body">
                        <div class="row"></div>
                        <div class="table-responsive">
                            <div class="float-end">
                                <h5>Total Tagihan: Rp {{ number_format($total, 0, '.', '.') }}</h5>
                            </div>
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Resi</th>
                                        <th>Nama Penerima</th>
                                        <th>Kota Tujuan</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Status Pembayaran</th>
                                        <th>Status Pengiriman</th>
                                        <th>Ongkir</th>
                                        
                                        @if (Session::get('user_level') == 2)
                                            <th>Pilih</th>
                                        @endif
                                        
                                        <th width="35%" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($data as $data)
                                        @php
                                            $bukti_pembayaran = $data->bukti_pembayaran;
                    
                                            if($bukti_pembayaran != ''){
                                                $explode = explode("/", $bukti_pembayaran);
                                                $bukti_pembayaran_view = 'https://'.$explode[2].'/thumbnail?id='.$explode[5];
                                            }else{
                                                $bukti_pembayaran_view = '#';
                                            }
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration; }}</td>
                    
                                            <td>
                                                <span class="badge badge-danger">
                                                    {{ $data->no_resi }}
                                                </span>
                                            </td>
                    
                                            <td>{{ $data->nama_penerima }}</td>
                                            <td>{{ $data->kota_tujuan }}</td>
                                            
                                            <td onmouseover="showBukti({{ $data->id }})" onmouseout="hideBukti({{ $data->id }})" style="position: relative;">
                                                @if ($bukti_pembayaran != '')
                                                    <div id="tooltip{{ $data->id }}" class="tooltip-img">
                                                        <img src="{{ $bukti_pembayaran_view }}" alt="Bukti Pembayaran" width="200px" class="img-fluid mt-2">
                                                        <a class="btn btn-primary" href="{{ $bukti_pembayaran }}" target="_blank">View Full Image</a>
                                                    </div>
                                                @endif
                    
                                                {{ $data->metode_pembayaran }} <i class="{{ $data->metode_pembayaran != 'Tunai' ? 'fa fa-eye' : '' }}"></i>
                                            </td>
                    
                                            <td class="text-center">
                                                <span class="badge {{ $data->status_pembayaran == 1 ? 'badge-primary' : 'badge-warning' }}">
                                                    <i class="fa {{ $data->status_pembayaran == 1 ? 'fa-check' : 'fa-warning' }}"></i>
                                                    {{ $data->status_pembayaran == 1 ? 'Lunas' : 'Pending'; }}
                                                </span>
                                            </td>
                    
                                            <td>{{ $data->status_pengiriman }}</td>
                                            <td>{{ number_format($data->ongkir, 0, '.', ',') }}</td>
                    
                                            @if (Session::get('user_level') == 2)
                                                {{-- Select/Pilih --}}
                                                <td class="text-center">
                                                    <input type="checkbox" value="5" name="id_pengiriman[]" id="flexCheckDefault" onclick="ceklis({{ $data->id }})">
                                                </td>
                                            @endif
                                            
                    
                                            <td class="text-center">
                    
                                                {{-- <a class="btn btn-square btn-warning btn-xs" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#statusPembayaran{{ $data->id }}" title="Edit Status Pembayaran">
                                                    <i class="fa fa-credit-card"></i>
                                                </a> --}}
                    
                                                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                                    <div class="btn-group" role="group">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                            <a class="dropdown-item" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modalDataPengiriman{{ $data->id }}" title="Detail Data"><span><i data-feather="eye"></i> Detail</span></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                @include('customers.component.detail-tagihan')
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                            
                        </div>
                    </div>
	            </div>
	        </div>
	        <!-- Server Side Processing end-->
	    </div>
	</div>
	
	@push('scripts')
	{{-- <script src="{{ asset('assets/js/jquery-3.7.1.js') }}"></script> --}}
	 <!-- Link to DataTables JS -->
	 {{-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script> --}}
	 <!-- Link to DataTables FixedHeader JS -->
	 <script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
	 <script src="{{ asset('assets/js/datatable/datatables/dataTable.fixHeader.js') }}"></script>
	 <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/fixedheader/3.1.8/js/dataTables.fixedHeader.js"></script>	 
	{{-- <script src="{{ asset('assets/js/datatable/datatables/fixedHeader.dataTable.js') }}"></script> --}}
	<script src="{{asset('assets/js/tooltip-init.js')}}"></script>
    <script>
		$(document).ready(function() {
			var table = $('#basic-1').DataTable({
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
				lengthMenu: [
					[10, 25, 50, -1],
					[10, 25, 50, 'All']
				],
				fixedHeader: {
					header: true,
					footer: true
				},
				searching: false
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
    <script>
        function showBukti(id) {
			console.log(id);
			var tooltip = document.getElementById('tooltip' + id);
			tooltip.style.display = 'block';
		}

		function hideBukti(id) {
			var tooltip = document.getElementById('tooltip' + id);
			tooltip.style.display = 'none';
		}
    </script>
	
	@endpush

@endsection


