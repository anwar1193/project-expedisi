@extends('layouts.admin.master')

@section('title')Invoice
 {{ $title }}
@endsection

@push('css')
@endpush

@section('content')
	
	<div class="container invoice">
	    <div class="row">
	        <div class="col-sm-12">
	            <div class="card">
	                <div class="card-body">
	                    <div>
	                        <div>
	                            <div class="row invo-header">
	                                <div class="col-sm-6">
	                                    <div class="media">
	                                        <div class="media-left">
	                                            <a href="{{ route('index') }}"><img class="media-object img-60" src="{{asset('assets/lion.jpg')}}" alt="Lion Parcel" /></a>
	                                        </div>
	                                        <div class="media-body m-l-20">
	                                            <h4 class="media-heading f-w-600">Lion Parcel</h4>
	                                            <p>
	                                                help@thelionparcel.com<br />
	                                                <span class="digits">+62-21-80820072</span>
	                                            </p>
	                                        </div>
	                                    </div>
	                                    <!-- End Info-->
	                                </div>
	                                <div class="col-sm-6">
	                                    <div class="text-md-end text-xs-center">
	                                        <h3>Invoice #<span class="digits counter">1069</span></h3>
	                                        <p>
	                                            Tanggal : 25 Mei 2024</span><br />
	                                            Tanggal Jatuh Tempo : 25 Mei 2024</span>
	                                        </p>
	                                    </div>
	                                    <!-- End Title                                 -->
	                                </div>
	                            </div>
	                        </div>
	                        <!-- End InvoiceTop-->
	                        <div class="row invo-profile py-2 my-2">
	                            <div class="col-xl-8">
	                                <div class="text-xl-start" id="project">
	                                    <h6>Tagihan Kepada</h6>
                                        <hr class="fw-bold">
                                        <div class="row d-flex py-1 text-start justify-content-start">
                                            <div class="col-4 col-lg-3">Nama Customer</div>
                                            <div class="col-1 col-lg-2">:</div>
                                            <div class="col-6 col-lg-4 text-capitalize">Adi Wijaya</div>
                                        </div>
                                        <div class="row d-flex py-1 text-start justify-content-start">
                                            <div class="col-4 col-lg-3">Alamat Customer</div>
                                            <div class="col-1 col-lg-2">:</div>
                                            <div class="col-6 col-lg-4 text-capitalize">Samarinda</div>
                                        </div>
                                        <div class="row d-flex py-1 text-start justify-content-start">
                                            <div class="col-4 col-lg-3">No. Hp Customer</div>
                                            <div class="col-1 col-lg-2">:</div>
                                            <div class="col-6 col-lg-4 text-capitalize">085327654839</div>
                                        </div>
                                        <div class="row d-flex py-1 text-start justify-content-start">
                                            <div class="col-4 col-lg-3">Email</div>
                                            <div class="col-1 col-lg-2">:</div>
                                            <div class="col-6 col-lg-4 text-capitalize">adi.wijaya@mail.com</div>
                                        </div>
	                                    {{-- <p>
                                            Nama Customer : Adi Wijaya<br />
                                            Alamat Customer: Samarinda<br />
                                            No. Hp Customer: 085327654839<br />
                                            Email: adi.wijaya@mail.com<br />
	                                    </p> --}}
	                                </div>
	                            </div>
	                        </div>
	                        <!-- End Invoice Mid-->
	                        <div class="my-3 py-3">
	                            <div class="table-responsive invoice-table" id="table">
	                                <table class="table table-bordered table-striped">
	                                    <tbody>
	                                        <tr>
	                                            <td class="item">
	                                                <h6 class="p-2 mb-0">Deskripsi</h6>
	                                            </td>
	                                            <td class="Hours">
	                                                <h6 class="p-2 mb-0">Quantity</h6>
	                                            </td>
	                                            <td class="Rate">
	                                                <h6 class="p-2 mb-0">Berat</h6>
	                                            </td>
	                                            <td class="subtotal">
	                                                <h6 class="p-2 mb-0">Jumlah</h6>
	                                            </td>
	                                        </tr>
	                                        <tr>
	                                            <td>
	                                                <label>Lorem Ipsum</label>
	                                                <p class="m-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
	                                            </td>
	                                            <td>
	                                                <p class="itemtext digits"><span class="digits counter">5</span></p>
	                                            </td>
	                                            <td>
	                                                <p class="itemtext digits"><span class="digits counter">3</span> Kg</p>
	                                            </td>
	                                            <td>
	                                                <p class="itemtext digits">Rp. <span class="digits counter">30000</span></p>
	                                            </td>
	                                        </tr>
	                                        <tr>
	                                            <td>
	                                                <label>Lorem Ipsum</label>
	                                                <p class="m-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
	                                            </td>
	                                            <td>
	                                                <p class="itemtext digits"><span class="digits counter">3</span></p>
	                                            </td>
	                                            <td>
	                                                <p class="itemtext digits"><span class="digits counter">2</span> Kg</p>
	                                            </td>
	                                            <td>
	                                                <p class="itemtext digits">Rp. <span class="digits counter">22500</span></p>
	                                            </td>
	                                        </tr>
	                                        <tr>
	                                            <td>
	                                                <label>Lorem Ipsum</label>
	                                                <p class="m-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
	                                            </td>
	                                            <td>
	                                                <p class="itemtext digits"><span class="digits counter">10</span></p>
	                                            </td>
	                                            <td>
	                                                <p class="itemtext digits"><span class="digits counter">1.5</span> Kg</p>
	                                            </td>
	                                            <td>
	                                                <p class="itemtext digits">Rp. <span class="digits counter">20000</span></p>
	                                            </td>
	                                        </tr>
	                                        <tr>
	                                            <td>
	                                                <label>Lorem Ipsum</label>
	                                                <p class="m-0">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
	                                            </td>
	                                            <td>
	                                                <p class="itemtext digits"><span class="digits counter">10</span></p>
	                                            </td>
	                                            <td>
	                                                <p class="itemtext digits"><span class="digits counter">1</span> Kg</p>
	                                            </td>
	                                            <td>
	                                                <p class="itemtext digits">Rp. <span class="digits counter">25000</span></p>
	                                            </td>
	                                        </tr>
	                                    </tbody>
	                                </table>
	                            </div>
	                            <!-- End Table-->
	                            <div class="fs-6 float-end pt-3 mt-3">
                                    <div class="row p-2">
                                        <div class="col-4">Sub Total</div>
                                        <div class="col-1">:</div>
                                        <div class="col">Rp. 97500,00</div>
                                    </div>
                                    <div class="row p-2">
                                        <div class="col-4">PPN</div>
                                        <div class="col-1">:</div>
                                        <div class="col">Rp. 9750,00</div>
                                    </div>
                                    <div class="row p-2">
                                        <div class="col-4">Total</div>
                                        <div class="col-1">:</div>
                                        <div class="col">Rp. 117250,00</div>
                                    </div>
                                </div>
	                        </div>
	                        <!-- End InvoiceBot-->
	                    </div>
	                    <!-- End Invoice-->
	                    <!-- End Invoice Holder-->
	                </div>
                    <div class="card-footer">
                        <div class="col-sm-12 text-center">
	                        <a href="{{ route('invoice.export-pdf') }}" class="btn btn btn-primary me-2">Cetak Invoice</a>
	                    </div>
                    </div>
	            </div>
	        </div>
	    </div>
	</div>
	
	@push('scripts')
	<script src="{{asset('assets/js/counter/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('assets/js/counter/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('assets/js/counter/counter-custom.js')}}"></script>
    <script src="{{asset('assets/js/print.js')}}"></script>
	@endpush

@endsection
