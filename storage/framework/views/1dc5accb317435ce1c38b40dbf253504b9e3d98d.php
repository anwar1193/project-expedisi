<header class="main-nav">
    <div class="sidebar-user text-center">
        
        

        <?php if(Session::get('foto') != ''): ?>
            <img class="img-90" src="<?php echo e(asset('storage/foto_profil/'.Session::get('foto'))); ?>" alt="" />
        <?php else: ?>
            <img class="img-90" src="<?php echo e(asset('assets/images/dashboard/1.png')); ?>" alt="" />
        <?php endif; ?>
        
        <a href="<?php echo e(route('profile')); ?>"> <h6 class="mt-3 f-14 f-w-600 text-danger"><?php echo e(Session::get('nama')); ?></h6></a>
        <p class="mb-0 font-roboto"><?php echo e(HApp::level(Session::get('user_level'))); ?></p>
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

                    <?php
                        // Ini Dari Helper.php, HApp di daftarkan dulu di app.php
                        $menu = HApp::getModule();
                    ?>

                    <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $val; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            
                            <?php if($data->is_dropdown == 0): ?>
                                <li>
                                    <a class="nav-link menu-title link-nav <?php echo e(prefixActive($data->url)); ?>" href="<?php echo e($data->url); ?>">
                                        <i data-feather="<?php echo e($data->icon); ?>"></i>
                                        <span><?php echo e($data->menu); ?></span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            
                            <?php if($data->is_dropdown == 1): ?>
                                <?php
                                    // Ini Dari Helper.php, HApp di daftarkan dulu di app.php
                                    $submenu = HApp::getSubModule($data->id);
                                ?>
                                <li class="dropdown">
                                    <a class="nav-link menu-title <?php echo e(prefixActive($data->url)); ?>" href="javascript:void(0)"><i data-feather="<?php echo e($data->icon); ?>"></i><span><?php echo e($data->menu); ?></span></a>
                                    <ul class="nav-submenu menu-content"  style="display: <?php echo e(prefixBlock($data->url)); ?>;">

                                        <?php $__currentLoopData = $submenu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $item; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datasub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><a href="<?php echo e($datasub->url); ?>" class=""><?php echo e($datasub->menu); ?></a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </li>
                            <?php endif; ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</header>



<?php echo $__env->make('components.modal-sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/munawarahmad/Documents/Applications/projectku/frontend/resources/views/layouts/admin/partials/sidebar.blade.php ENDPATH**/ ?>