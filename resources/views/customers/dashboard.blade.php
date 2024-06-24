@extends('layouts.admin.master')

@section('title')Dashboard Customer
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@php
    $defaultTab = !$resi ? 'home' : 'contact';
@endphp

@section('content')
	<div class="container-fluid">
        <div class="row">
        </div>
        <div class="row">
            <!-- Server Side Processing start-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="tabbed-card">
                        <div class="card-header pb-0">
                            @include('customers.component.nav-tabs', ['activeTab' => $defaultTab])
                        </div>

                        <div class="tab-content" id="top-tabContentsecondary">
                            <div class="tab-pane fade {{ !$resi ? 'active show' : '' }}" id="top-homesecondary" role="tabpanel" aria-labelledby="top-home-tab">
                                @include('customers.component.profile', ['data' => $user])
                            </div>

                            <div class="tab-pane fade" id="top-profilesecondary" role="tabpanel" aria-labelledby="profile-top-tab">
                                @include('customers.component.tagihan', ['data' => $tagihan, 'tableId' => 'basic-1'])
                            </div>

                            <div class="tab-pane fade {{ $resi ? 'active show' : '' }}" id="top-contactsecondary" role="tabpanel" aria-labelledby="contact-top-tab">
                                @include('customers.component.resi', ['data' => $resi])
                            </div>
                            
							<div class="tab-pane fade" id="top-invoicesecondary" role="tabpanel" aria-labelledby="profile-top-tab">
                                @include('customers.component.invoice', ['data' => $data, 'customer' => $customer, 'invoice' => $invoice, 'total' => $total])
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
		})
	</script>
	
	@foreach ($tagihan as $data)
		<script>
			$('#view-bukti'+{{ $data->id }}).hide();
		</script>
	@endforeach

	<script>
		function showBukti(id) {
			$('#view-bukti'+id).show();
		}

		function hideBukti(id) {
			$('#view-bukti'+id).hide();
		}
	</script>
	@endpush

@endsection