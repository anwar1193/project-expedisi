<div class="page-main-header">
  <div class="main-header-right row m-0">
    <div class="main-header-left">

      <div class="logo-wrapper">
        <a href="{{ route('index') }}">
          {{-- <img class="img-fluid" src="{{asset('assets/logo-kejaksaan.png')}}" alt="" width="40px">
          <span style="font-size: 20px; font-weight:bold; letter-spacing:2px; margin-left:10px">SIPBIS</span> --}}
          <img src="/assets/lionparcel.png" width="200px" alt="">
        </a>
      </div>

      <div class="dark-logo-wrapper">
        <a href="{{ route('index') }}">
          {{-- <img class="img-fluid" src="{{asset('assets/logo-kejaksaan.png')}}" alt="" width="40px">
          <span class="text-white" style="font-size: 20px; font-weight:bold; letter-spacing:2px; margin-left:10px">SIPBIS</span> --}}
          <img src="/assets/lionparcel.png" width="200px" alt="">
        </a>
      </div>
      <div class="toggle-sidebar"><i class="status_toggle middle text-danger" data-feather="align-center" id="sidebar-toggle">    </i></div>
    </div>
    <div class="left-menu-header col">
      <ul>
        <li>
          <form class="form-inline search-form">
            <div class="search-bg">
              {{-- <i class="fa fa-search"></i> --}}
              {{-- <input class="form-control-plaintext" placeholder="Search here....."> --}}
            </div>
          </form>
          <span class="d-sm-none mobile-search search-bg"><i class="fa fa-search"></i></span>
        </li>
      </ul>
    </div>
    <div class="nav-right col pull-right right-menu p-0">
      <ul class="nav-menus">
        <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
        @if (Session::get('user_level') != 3)
            @php
                $notificationData = getNotification();
                $notificationPengeluaran = getNotifPengeluaran();
                $notificationSaldo = getNotifClosingSaldo();
                $tema = Session::get("tema");
            @endphp
        @endif

        <li class="onhover-dropdown">
            <div class="notification-box">
                <i data-feather="bell"></i>
                @if (Session::get('user_level') != 3 && isset($notificationData) && $notificationData['jumlah'] != 0)
                    <span class="dot-animated"></span>
                @endif
            </div>
            <ul class="notification-dropdown onhover-show-div">
              @if (Session::get('user_level') != 3 && (isset($notificationData) && $notificationData['jumlah'] != 0) || (isset($notificationPengeluaran) && $notificationPengeluaran['jumlah'] != 0))
                    <li>
                        <p class="f-w-700 mb-0">You have Notification</p>
                    </li>
                    @if ($notificationData['jumlah'] != 0)
                      <li class="noti-success">
                          <div class="media">
                              <span class="notification-bg bg-light-success"><i data-feather="file-text"></i></span>
                              <div class="media-body">
                                  <a class="{{ $tema == 'dark' ? 'text-light' : 'text-black' }}" href="{{ route('data-pengiriman', ['notif' => 1]) }}">
                                      {{ $notificationData['text_notif'] ?? $notificationData['text_owner'] }}
                                  </a>
                              </div>
                          </div>
                      </li>
                    @endif
                    @if ($notificationPengeluaran['jumlah'] != 0)
                      <li class="noti-success">
                          <div class="media">
                              <span class="notification-bg bg-light-success"><i data-feather="file-text"></i></span>
                              <div class="media-body">
                                  <a class="{{ $tema == 'dark' ? 'text-light' : 'text-black' }}" href="{{ route('daftar-pengeluaran') }}">
                                      {{ $notificationPengeluaran['text_notif'] ?? $notificationPengeluaran['text_owner'] }}
                                  </a>
                              </div>
                          </div>
                      </li>
                    @endif
                    @if ($notificationSaldo['text_notif'] !== '-')
                      <li class="noti-success">
                          <div class="media">
                              <span class="notification-bg bg-light-success"><i data-feather="file-text"></i></span>
                              <div class="media-body">
                                  <a class="{{ $tema == 'dark' ? 'text-light' : 'text-black' }}" href="{{ route('pengeluaran-cash') }}">
                                      {{ $notificationSaldo['text_notif'] }}
                                  </a>
                              </div>
                          </div>
                      </li>
                    @endif
                @else
                    <li>
                        <p class="f-w-700 mb-0">You Don't have Notification</p>
                    </li>
                @endif
            </ul>
        </li>

        <li>
          <div class="mode-theme">
            <a href="{{ route('tema') }}" id="themeLink">
              @php
                  $theme = Session::get("tema");
                  $iconClass = $theme == "light" ? "fa-moon-o" : "fa-lightbulb-o";
              @endphp

              <i class="fa {{ $iconClass }}"></i>

            </a>
          </div>
        </li>
        <li class="onhover-dropdown p-0">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-primary-light" type="submit"><i data-feather="log-out"></i>Log out</button>
          </form>
        </li>
      </ul>
    </div>
    <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
  </div>
</div>
