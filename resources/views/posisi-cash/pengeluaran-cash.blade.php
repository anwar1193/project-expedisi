@extends('layouts.admin.master')

@section('title')Saldo Cash
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Saldo Cash</h3>
		@endslot
		<li class="breadcrumb-item active"><a href="{{ route('pengeluaran-cash') }}">Saldo Cash</a></li>
		<li class="breadcrumb-item active">Table</li>
	@endcomponent
	
    <nav class="page-breadcrumb">
        <ol class="breadcrumb align-items-center">
            <div class="d-grid gap-2 d-md-block mx-2">
				@if (isOwner())
					<form action="{{ route('posisi-cash.approveSelected') }}" method="post" style="display: inline-block">
						@csrf
						<div class="inner"></div>
						<button type="submit" class="btn btn-success btn-sm" style="display: inline" onclick="return confirm('Approve semua data terpilih?')">
							<i class="fa fa-check-square"></i> Approve Selected
						</button>
					</form>
                @endif
            </div>
        </ol>
    </nav>

	<div class="container-fluid">
        <div class="row">
        </div>
	    <div class="row">
	        <!-- Server Side Processing start-->
	        <div class="col-sm-12">
	            <div class="card">
	                <div class="card-body">

						@if (session()->has('success'))
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>Berhasil <i class="fa fa-info-circle"></i></strong> 
								{{ session('success') }}
								<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						@endif

						@if (session()->has('delete'))
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Berhasil <i class="fa fa-info-circle"></i></strong> 
								{{ session('delete') }}
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
	                    
						{{-- Table --}}
						<div class="table-responsive">
	                        <table class="display" id="basic-1">
	                            <thead>
	                                <tr>
	                                    <th width="5%">No</th>
	                                    <th>Jumlah Saldo</th>
										<th>Tanggal</th>
										<th>Status</th>
										@if (isOwner())
                                            <th>Pilih</th>
										    <th width="20%">Action</th>
										@endif
	                                </tr>
	                            </thead>
	                            <tbody>
	                                @foreach ($saldo as $data)
										<tr>
											<td>{{ $loop->iteration; }}</td>
											<td>{{ 'Rp '.number_format($data->jumlah, 0, '.', '.') }} </td>
											<td>{{ $data->tanggal }}</td>
											<td>
												<span class="badge {{ $data->is_approve == 1 ? 'badge-primary' : 'badge-warning' }}">
													<i class="fa {{ $data->is_approve == 1 ? 'fa-check' : 'fa-warning' }}"></i>
													{{ $data->status == true ? 'Disetujui' : 'Pending'; }}
												</span>
											</td>
											@if (isOwner())
                                            <td>
                                                <input type="checkbox" name="id_saldo[]" id="flexCheckDefault" onclick="ceklis({{ $data->id }})">
                                            </td>
											<td class="text-center">
                                                <form action="{{ route('posisi-cash.approve', $data->id) }}" method="get">
                                                    <button class="btn btn-secondary btn-sm" type="submit" onclick="return confirm('Approve Closing Saldo Ini?')">Approve</button>
                                                </form>
											</td>
											@endif
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
	<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
    <script>
		function ceklis(id){
			$('.inner').append("<input type='hidden' value='"+id+"' name='id_saldo[]'>");
		}
	</script>
	@endpush

@endsection