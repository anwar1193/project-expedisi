<div class="page-main-header">
  <div class="main-header-right row m-0">
    <div class="main-header-left">

      <div class="logo-wrapper">
        <a href="<?php echo e(route('index')); ?>">
          
          <img src="/assets/lionparcel.png" width="200px" alt="">
        </a>
      </div>

      <div class="dark-logo-wrapper">
        <a href="<?php echo e(route('index')); ?>">
          
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
              
              
            </div>
          </form>
          <span class="d-sm-none mobile-search search-bg"><i class="fa fa-search"></i></span>
        </li>
      </ul>
    </div>
    <div class="nav-right col pull-right right-menu p-0">
      <ul class="nav-menus">
        <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
        
        <?php if(Session::get('user_level') != 3): ?>
            <?php
                $notificationData = getNotification();
                $notificationPengeluaran = getNotifPengeluaran();
                $tema = Session::get("tema");
            ?>
        <?php endif; ?>

        <li class="onhover-dropdown">
            <div class="notification-box">
                <i data-feather="bell"></i>
                <?php if(Session::get('user_level') != 3 && isset($notificationData) && $notificationData['jumlah'] != 0): ?>
                    <span class="dot-animated"></span>
                <?php endif; ?>
            </div>
            <ul class="notification-dropdown onhover-show-div">
              <?php if(Session::get('user_level') != 3 && (isset($notificationData) && $notificationData['jumlah'] != 0) || (isset($notificationPengeluaran) && $notificationPengeluaran['jumlah'] != 0)): ?>
                    <li>
                        <p class="f-w-700 mb-0">You have Notification</p>
                    </li>
                    <?php if($notificationData['jumlah'] != 0): ?>
                      <li class="noti-success">
                          <div class="media">
                              <span class="notification-bg bg-light-success"><i data-feather="file-text"></i></span>
                              <div class="media-body">
                                  <a class="<?php echo e($tema == 'dark' ? 'text-light' : 'text-black'); ?>" href="<?php echo e(route('data-pengiriman', ['notif' => 1])); ?>">
                                      <?php echo e($notificationData['text_notif'] ?? $notificationData['text_owner']); ?>

                                  </a>
                              </div>
                          </div>
                      </li>
                    <?php endif; ?>
                    <?php if($notificationPengeluaran['jumlah'] != 0): ?>
                      <li class="noti-success">
                          <div class="media">
                              <span class="notification-bg bg-light-success"><i data-feather="file-text"></i></span>
                              <div class="media-body">
                                  <a class="<?php echo e($tema == 'dark' ? 'text-light' : 'text-black'); ?>" href="<?php echo e(route('pengeluaran-cash')); ?>">
                                      <?php echo e($notificationPengeluaran['text_notif'] ?? $notificationPengeluaran['text_owner']); ?>

                                  </a>
                              </div>
                          </div>
                      </li>
                    <?php endif; ?>
                <?php else: ?>
                    <li>
                        <p class="f-w-700 mb-0">You Don't have Notification</p>
                    </li>
                <?php endif; ?>
            </ul>
        </li>

        <li>
          <div class="mode-theme">
            <a href="<?php echo e(route('tema')); ?>" id="themeLink">
              <?php
                  $theme = Session::get("tema");
                  $iconClass = $theme == "light" ? "fa-moon-o" : "fa-lightbulb-o";
              ?>

              <i class="fa <?php echo e($iconClass); ?>"></i>

            </a>
          </div>
        </li>
        
        <li class="onhover-dropdown p-0">
          <form method="POST" action="<?php echo e(route('logout')); ?>">
            <?php echo csrf_field(); ?>
            <button class="btn btn-primary-light" type="submit"><i data-feather="log-out"></i>Log out</button>
          </form>
        </li>
      </ul>
    </div>
    <div class="d-lg-none mobile-toggle pull-right w-auto"><i data-feather="more-horizontal"></i></div>
  </div>
</div>
<?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/layouts/admin/partials/header.blade.php ENDPATH**/ ?>