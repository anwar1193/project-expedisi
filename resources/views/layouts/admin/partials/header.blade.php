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
        {{-- <li class="onhover-dropdown">
          <div class="bookmark-box"><i data-feather="star"></i></div>
          <div class="bookmark-dropdown onhover-show-div">
            <div class="form-group mb-0">
              <div class="input-group">
                <div class="input-group-prepend"><span class="input-group-text"><i class="fa fa-search"></i></span></div>
                <input class="form-control" type="text" placeholder="Search for bookmark...">
              </div>
            </div>
            <ul>
              <li class="add-to-bookmark"><i class="bookmark-icon" data-feather="inbox"></i>Email<span class="pull-right"><i data-feather="star"></i></span></li>
              <li class="add-to-bookmark"><i class="bookmark-icon" data-feather="message-square"></i>Chat<span class="pull-right"><i data-feather="star"></i></span></li>
              <li class="add-to-bookmark"><i class="bookmark-icon" data-feather="command"></i>Feather Icon<span class="pull-right"><i data-feather="star"></i></span></li>
              <li class="add-to-bookmark"><i class="bookmark-icon" data-feather="airplay"></i>Widgets<span class="pull-right"><i data-feather="star">   </i></span></li>
            </ul>
          </div>
        </li> --}}
        @php
          $notificationData = getNotification();
          $tema = Session::get("tema");
        @endphp

        <li class="onhover-dropdown">
            <div class="notification-box">
                <i data-feather="bell"></i>
                @if ($notificationData['jumlah'] != 0)
                    <span class="dot-animated"></span>
                @endif
            </div>
            <ul class="notification-dropdown onhover-show-div">
                @if ($notificationData['jumlah'] != 0)
                    <li>
                        <p class="f-w-700 mb-0">You have Notification</p>
                    </li>
                    <li class="noti-success">
                        <div class="media">
                            <span class="notification-bg bg-light-success"><i data-feather="file-text"></i></span>
                            <div class="media-body">
                                <a class="{{ $tema == 'dark' ? 'text-light' : 'text-black' }}" href="{{ route('data-pengiriman') }}">
                                    {{ $notificationData['text_notif'] ?? $notificationData['text_owner'] }}
                                </a>
                            </div>
                        </div>
                    </li>
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
        {{-- <li class="onhover-dropdown">
          <i data-feather="message-square"></i>
          <ul class="chat-dropdown onhover-show-div">
            <li>
              <div class="media">
                <img class="img-fluid rounded-circle me-3" src="{{asset('assets/images/user/4.jpg')}}" alt="">
                <div class="media-body">
                  <span>Ain Chavez</span>
                  <p class="f-12 light-font">Lorem Ipsum is simply dummy...</p>
                </div>
                <p class="f-12">32 mins ago</p>
              </div>
            </li>
            <li>
              <div class="media">
                <img class="img-fluid rounded-circle me-3" src="{{asset('assets/images/user/1.jpg')}}" alt="">
                <div class="media-body">
                  <span>Erica Hughes</span>
                  <p class="f-12 light-font">Lorem Ipsum is simply dummy...</p>
                </div>
                <p class="f-12">58 mins ago</p>
              </div>
            </li>
            <li>
              <div class="media">
                <img class="img-fluid rounded-circle me-3" src="{{asset('assets/images/user/2.jpg')}}" alt="">
                <div class="media-body">
                  <span>Kori Thomas</span>
                  <p class="f-12 light-font">Lorem Ipsum is simply dummy...</p>
                </div>
                <p class="f-12">1 hr ago</p>
              </div>
            </li>
            <li class="text-center"> <a class="f-w-700" href="javascript:void(0)">See All     </a></li>
          </ul>
        </li> --}}
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
