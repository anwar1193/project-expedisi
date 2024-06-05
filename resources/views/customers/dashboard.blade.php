@extends('layouts.admin.master')

@section('title')Dashboard Customer
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
                    <div class="tabbed-card">
                        <div class="card-header pb-0">
                            @include('customers.component.nav-tabs', ['activeTab' => 'home'])
                        </div>

                        <div class="tab-content" id="top-tabContentsecondary">
                            <div class="tab-pane fade active show" id="top-homesecondary" role="tabpanel" aria-labelledby="top-home-tab">
                                @include('customers.component.profile', ['data' => $user])
                            </div>

                            <div class="tab-pane fade" id="top-profilesecondary" role="tabpanel" aria-labelledby="profile-top-tab">
                                @include('customers.component.tagihan', ['data' => $tagihan, 'tableId' => 'basic-2'])
                            </div>

                            <div class="tab-pane fade" id="top-contactsecondary" role="tabpanel" aria-labelledby="contact-top-tab">
                                @include('customers.component.resi', ['data' => $resi])
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

			// $('#basic-2').DataTable({
			// 	language: {
			// 		"emptyTable": "Tidak ada data yang tersedia pada tabel ini",
			// 		"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
			// 		"infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
			// 		"infoFiltered": " (disaring dari _MAX_ entri keseluruhan)",
			// 		"lengthMenu": "Tampilkan _MENU_ entri",
			// 		"loadingRecords": "Sedang memuat...",
			// 		"processing": "Sedang memproses...",
			// 		"search": "Cari:",
			// 		"zeroRecords": "Tidak ditemukan data yang sesuai",
			// 		"paginate": {
			// 		"first": "Pertama",
			// 		"last": "Terakhir",
			// 		"next": "Selanjutnya",
			// 		"previous": "Sebelumnya"
			// 		},
			// 	},
            //     searching: false,
			// });

			// $('#basic-3').DataTable({
			// 	language: {
			// 		"emptyTable": "Tidak ada data yang tersedia pada tabel ini",
			// 		"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
			// 		"infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
			// 		"infoFiltered": " (disaring dari _MAX_ entri keseluruhan)",
			// 		"lengthMenu": "Tampilkan _MENU_ entri",
			// 		"loadingRecords": "Sedang memuat...",
			// 		"processing": "Sedang memproses...",
			// 		"search": "Cari:",
			// 		"zeroRecords": "Tidak ditemukan data yang sesuai",
			// 		"paginate": {
			// 		"first": "Pertama",
			// 		"last": "Terakhir",
			// 		"next": "Selanjutnya",
			// 		"previous": "Sebelumnya"
			// 		},
			// 	},
            //     searching: false,
			// });
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
	{{-- <script>
        $(document).ready(function() {
            $('#search-form').on('submit', function(e) {
                e.preventDefault();
                var noResi = $('#no_resi').val();
                $('#resi-result').html('');
                $.ajax({
                    url: `{{ route("dashboard.customer") }}`,
                    method: 'GET',
                    data: {
                        no_resi: noResi
                    },
                    success: function(response) {
                        $('#resi-result').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ' + status + error);
                        $('#resi-result').html('<div class="alert alert-danger">Error fetching data. Please try again later.</div>');
                    }
                });
            });
        })
    </script> --}}
	@endpush

@endsection