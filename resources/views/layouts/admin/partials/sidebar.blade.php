<header class="main-nav">
    <div class="sidebar-user text-center">
        
        {{-- <a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a> --}}

        @if (Session::get('foto') != '')
            <img class="img-90" src="{{asset('storage/foto_profil/'.Session::get('foto'))}}" alt="" />
        @else
            <img class="img-90" src="{{asset('assets/images/dashboard/1.png')}}" alt="" />
        @endif
        
        <a href="{{ route('profile') }}"> <h6 class="mt-3 f-14 f-w-600 text-danger">{{ Session::get('nama') }}</h6></a>
        <p class="mb-0 font-roboto">{{ Session::get('nama_satker') }}</p>
    </div>
    <nav>
        <div class="main-navbar">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="mainnav">
                <ul class="nav-menu custom-scrollbar">
                    <li class="back-btn">
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6 class="text-danger">Menu</h6>
                        </div>
                    </li>

                    {{-- Test Push Github --}}
                    <li>
                        <a class="nav-link menu-title link-nav {{prefixActive('/')}}" href="{{ route('index') }}"><i data-feather="home"></i><span>Dashboard</span></a>
                    </li>

                    {{-- <li class="dropdown">
                        <a class="nav-link menu-title {{ prefixActive('/master') }}" href="javascript:void(0)"><i data-feather="file-text"></i><span>Master</span></a>
                        <ul class="nav-submenu menu-content"  style="display: {{ prefixBlock('/master') }};">
                            <li><a href="{{ route('surveilance-car') }}" class="{{routeActive('surveilance-car')}}">Surveilance Car</a></li>
                            <li><a href="{{ route('jenis-perangkat') }}" class="{{routeActive('jenis-perangkat')}}">Jenis Perangkat</a></li>
                            <li><a href="{{ route('perangkat') }}" class="{{ routeActive('perangkat') }}">Data Perangkat</a></li>
                            <li><a href="{{ route('obd') }}" class="{{ routeActive('obd') }}">OBD</a></li>
                        </ul>
                    </li> --}}

                    <li>
                        <a class="nav-link menu-title link-nav {{prefixActive('/users')}}" href="{{route('users')}}"><i data-feather="user"></i><span>User Management</span></a>
                    </li>

                    {{-- <li>
                        <a class="nav-link menu-title link-nav {{prefixActive('/data-pengiriman')}}" href="{{route('data-pengiriman')}}"><i data-feather="list"></i><span>Data Pengiriman</span></a>
                    </li> --}}
                    
                    @if (isAdmin())
                        <li>
                            <a class="nav-link menu-title link-nav {{prefixActive('/data-pengiriman')}}" href="{{route('data-pengiriman')}}"><i data-feather="list"></i><span>Data Pengiriman</span></a>
                        </li>

                        <li>
                            <a class="nav-link menu-title link-nav {{prefixActive('/daftar-pengeluaran')}}" href="{{route('daftar-pengeluaran')}}"><i data-feather="list"></i><span>Daftar Pengeluaran</span></a>
                        </li>
                    @endif
                    
                    <li>
                        <a class="nav-link menu-title link-nav {{routeActive('log-activity')}}" href="{{ route('log-activity') }}"><i data-feather="clock"></i><span>Log Aktifitas</span></a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav {{routeActive('last-login')}}" href="{{ route('last-login') }}"><i data-feather="activity"></i><span>Log Akses</span></a>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link menu-title"><i data-feather="file-text"></i><span>Laporan</span></a>
                        <ul class="nav-submenu menu-content">
                            {{-- <li><a href="#" class="" data-bs-toggle="modal" data-bs-target="#modalReportUser">Report Data User</a></li>
                            <li><a href="#" class="" data-bs-toggle="modal" data-bs-target="#modalReportSurveilance">Report Surveilance Car</a></li>
                            <li><a href="#" class="" data-bs-toggle="modal" data-bs-target="#modalReportPerangkat">Report Data Perangkat</a></li> --}}

                            <li><a href="#" class="" data-bs-toggle="modal" data-bs-target="#">Laba Rugi</a></li>
                            <li><a href="#" class="" data-bs-toggle="modal" data-bs-target="#">Laporan Harian</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link menu-title {{ prefixActive('/pengaturan') }}" href="javascript:void(0)"><i data-feather="settings"></i><span>Pengaturan</span></a>
                        <ul class="nav-submenu menu-content"  style="display: {{ prefixBlock('/pengaturan') }};">
                            <li><a href="{{ route('profile') }}" class="{{routeActive('profile')}}">Profile</a></li>
                            <li><a href="{{ route('ganti-password') }}" class="{{routeActive('ganti-password')}}">Ganti Password</a></li>
                            <li><a href="{{ route('hak-akses') }}" class="">Hak Akses Pengguna</a></li>
                        </ul>
                    </li>

                    {{-- <li>
                        <a class="nav-link menu-title link-nav {{routeActive('pencadangan-data')}}" href="#"><i data-feather="server"></i><span>Pencadangan Data</span></a>
                    </li>    --}}
                    
                    {{-- <li class="dropdown">
                        <a class="nav-link menu-title {{ prefixActive('/bantuan') }}" href="javascript:void(0)"><i data-feather="alert-circle"></i><span>Bantuan</span></a>
                        <ul class="nav-submenu menu-content"  style="display: {{ prefixBlock('/bantuan') }};">
                            <li><a href="#" class="">Panduan Aplikasi</a></li>
                            <li><a href="#" class="">FAQ</a></li>
                        </ul>
                    </li> --}}

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>


{{-- MODAL ............................................ --}}
@include('components.modal-sidebar')