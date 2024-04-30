<header class="main-nav">
    <div class="sidebar-user text-center">
        
        

        <?php if(Session::get('foto') != ''): ?>
            <img class="img-90" src="<?php echo e(asset('storage/foto_profil/'.Session::get('foto'))); ?>" alt="" />
        <?php else: ?>
            <img class="img-90" src="<?php echo e(asset('assets/images/dashboard/1.png')); ?>" alt="" />
        <?php endif; ?>
        
        <a href="<?php echo e(route('profile')); ?>"> <h6 class="mt-3 f-14 f-w-600"><?php echo e(Session::get('nama')); ?></h6></a>
        <p class="mb-0 font-roboto"><?php echo e(Session::get('nama_satker')); ?></p>
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
                            <h6>Menu</h6>
                        </div>
                    </li>

                    
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(prefixActive('/')); ?>"" href="<?php echo e(route('index')); ?>"><i data-feather="home"></i><span>Dashboard</span></a>
                    </li>

                    

                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(prefixActive('/users')); ?>" href="<?php echo e(route('users')); ?>"><i data-feather="user"></i><span>User Management</span></a>
                    </li>

                    

                    

                    

                    
                    
                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive('log-activity')); ?>" href="<?php echo e(route('log-activity')); ?>"><i data-feather="clock"></i><span>Log Aktifitas</span></a>
                    </li>

                    <li>
                        <a class="nav-link menu-title link-nav <?php echo e(routeActive('last-login')); ?>" href="<?php echo e(route('last-login')); ?>"><i data-feather="activity"></i><span>Log Akses</span></a>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link menu-title"><i data-feather="file-text"></i><span>Laporan</span></a>
                        <ul class="nav-submenu menu-content">
                            

                            <li><a href="#" class="" data-bs-toggle="modal" data-bs-target="#">Laba Rugi</a></li>
                            <li><a href="#" class="" data-bs-toggle="modal" data-bs-target="#">Laporan Harian</a></li>
                        </ul>
                    </li>

                    <li class="dropdown">
                        <a class="nav-link menu-title <?php echo e(prefixActive('/pengaturan')); ?>" href="javascript:void(0)"><i data-feather="settings"></i><span>Pengaturan</span></a>
                        <ul class="nav-submenu menu-content"  style="display: <?php echo e(prefixBlock('/pengaturan')); ?>;">
                            <li><a href="<?php echo e(route('profile')); ?>" class="<?php echo e(routeActive('profile')); ?>">Profile</a></li>
                            <li><a href="<?php echo e(route('ganti-password')); ?>" class="<?php echo e(routeActive('ganti-password')); ?>">Ganti Password</a></li>
                            <li><a href="<?php echo e(route('hak-akses')); ?>" class="">Hak Akses Pengguna</a></li>
                        </ul>
                    </li>

                    
                    
                    

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>



<?php echo $__env->make('components.modal-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/layouts/admin/partials/sidebar.blade.php ENDPATH**/ ?>