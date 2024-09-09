<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities. laravel/framework: ^8.40">
    <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{asset('assets/lionfav.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('assets/lionfav.png')}}" type="image/x-icon">
    <title>Approved Data Pengeluaran</title>
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/fontawesome.css')}}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/icofont.css')}}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/themify.css')}}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/flag-icon.css')}}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/feather-icon.css')}}">
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{asset('assets/css/color-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/responsive.css')}}">

    <!-- Select2 CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/select2.css')}}">

    <!-- Font Awesome-->
    @includeIf('layouts.admin.partials.css')
  </head>

<body class="d-flex justify-content-center">
    <div class="container-fluid">
		<div class="row d-flex justify-content-center">
			<div class="col-sm-12 col-xl-6">
				<div class="card">
					<div class="card-header pb-0">
						<h5>Data Pengeluaran Berhasil Diapprove</h5>
					</div>
                        <div class="card-body megaoptions-border-space-sm">					
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="form-label" for="nominal">Tanggal Pengeluaran</label>
                                    <p>{{ $data->tgl_pengeluaran }}</p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="form-label" for="nominal">Yang Melakukan Pembayaran</label>
                                    <p>{{ $data->yang_membayar }}</p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="form-label" for="nominal">Metode Pembayaran</label>
                                    <p>{{ $data->metode_pembayaran }}</p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="form-label" for="nominal">Jumlah Pembayaran</label>
                                    <p>Rp. {{ number_format($data->jumlah_pembayaran, 0, '.', ',') }}</p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="form-label" for="nominal">Yang Menerima Pembayaran</label>
                                    <p>{{ $data->yang_menerima }}</p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="form-label" for="nominal">Jenis Pengeluaran</label>
                                    <p>{{ $data->jenisPengeluaran }}</p>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="form-label" for="nominal">Keterangan</label>
                                    <p>{{ $data->keterangan }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <a class="btn btn-primary btn-lg" href="{{ route('index') }}">Masuk Ke Aplikasi</a>
                        </div>
				</div>
			</div>
		</div>
	</div>

    <script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
    <!-- feather icon js-->
    <script src="{{asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>
    <!-- Sidebar jquery-->
    <script src="{{asset('assets/js/sidebar-menu.js')}}"></script>
    <script src="{{asset('assets/js/config.js')}}"></script>
    <!-- Bootstrap js-->
    <script src="{{asset('assets/js/bootstrap/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap/bootstrap.min.js')}}"></script>
    <!-- Plugins JS start-->
    @stack('scripts')
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{asset('assets/js/script.js')}}"></script>
    <script src="{{asset('assets/js/theme-customizer/customizer.js')}}"></script>
    <!-- Plugin used-->

    <!-- Select2 JS start-->
    <script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>
    <!-- Plugins JS Ends-->
</body>