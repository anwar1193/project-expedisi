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
          
          <span class="text-white" style="font-size: 20px; font-weight:bold; letter-spacing:2px; margin-left:10px">SIPBIS</span> --}}
          
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