@extends('layouts.admin.master')

@section('title') Riwayat Perjalanan
 {{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
@endpush

@section('content')
	@component('components.breadcrumb')
        @slot('breadcrumb_title')
              <h5>Data Riwayat Perjalanan {{ $item->merk }} ({{ $item->nopol }})</h5>
        @endslot
            <li class="breadcrumb-item active">Riwayat Perjalanan</li>
	@endcomponent
	
	<div class="container-fluid">
        <div class="row">
        </div>
	    <div class="row">
	        <div class="col-xl-12 recent-order-sec">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-end mb-3">
                      <a href="{{ route('dashboard') }}" class="btn btn-light">
                        Kembali
                      </a>
                    </div>

                    <div class="table-responsive">
                      <table class="table table-bordernone">
                        <thead>
                          <tr>
                            <th>Waktu</th>
                            <th>Latitude</th>
                            <th>Langitude</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <p>16 Januari - 12.45</p>
                            </td>
                            <td>
                              <p>-6.240437</p>
                            </td>
                            <td>
                              <p>106.797259</p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p>22 Februari - 11.20</p>
                            </td>
                            <td>
                              <p>-6.305025</p>
                            </td>
                            <td>
                              <p>106.852412</p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p>24 Februari - 11.20</p>
                            </td>
                            <td>
                              <p>-6.153167</p>
                            </td>
                            <td>
                              <p>106.842621</p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p>25 Februari - 11.20</p>
                            </td>
                            <td>
                              <p>-6.235438</p>
                            </td>
                            <td>
                              <p>106.828647</p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p>28 Februari - 11.20</p>
                            </td>
                            <td>
                              <p>-6.184301</p>
                            </td>
                            <td>
                              <p>106.737274</p>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
            </div>
	    </div>
	</div>
	
	@push('scripts')
	<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
	@endpush

@endsection