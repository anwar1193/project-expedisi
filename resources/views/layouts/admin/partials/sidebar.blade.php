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

                    @php
                        // Ini Dari Helper.php, HApp di daftarkan dulu di app.php
                        $menu = HApp::getModule();
                    @endphp

                    @foreach ($menu as $val)
                        @foreach ($val as $data)

                            {{-- Jika Menu Tanpa Dropdown --}}
                            @if ($data->is_dropdown == 0)
                                <li>
                                    <a class="nav-link menu-title link-nav {{prefixActive($data->url)}}" href="{{ $data->url }}">
                                        <i data-feather="{{ $data->icon }}"></i>
                                        <span>{{ $data->menu }}</span>
                                    </a>
                                </li>
                            @endif

                            {{-- Jika Menu Dengan Dropdown --}}
                            @if ($data->is_dropdown == 1)
                                @php
                                    // Ini Dari Helper.php, HApp di daftarkan dulu di app.php
                                    $submenu = HApp::getSubModule($data->id);
                                @endphp
                                <li class="dropdown">
                                    <a class="nav-link menu-title {{ prefixActive($data->url) }}" href="javascript:void(0)"><i data-feather="{{ $data->icon }}"></i><span>{{ $data->menu }}</span></a>
                                    <ul class="nav-submenu menu-content"  style="display: {{ prefixBlock($data->url) }};">

                                        @foreach ($submenu as $item)
                                            @foreach ($item as $datasub)
                                                <li><a href="{{ $datasub->url }}" class="">{{ $datasub->menu }}</a></li>
                                            @endforeach
                                        @endforeach
                                    </ul>
                                </li>
                            @endif

                        @endforeach
                    @endforeach

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>


{{-- MODAL ............................................ --}}
@include('components.modal-sidebar')