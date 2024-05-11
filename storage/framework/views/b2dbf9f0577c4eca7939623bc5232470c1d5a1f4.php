
            <div class="card-body">
                <?php if(session()->has('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Berhasil <i class="fa fa-info-circle"></i></strong> 
                                    <?php echo e(session('success')); ?>

                                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if(session()->has('delete')): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Berhasil <i class="fa fa-info-circle"></i></strong> 
                                    <?php echo e(session('delete')); ?>

                                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>
                            
                            <?php if(session()->has('error')): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Gagal <i class="fa fa-info-circle"></i></strong> 
                                    <?php echo e(session('error')); ?>

                                    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php endif; ?>

                            <?php if($errors->any()): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <strong>Failed <i class="fa fa-info-circle"></i></strong> 
                                        <?php echo e($error); ?>

                                        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                                        <br>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>

                <div class="table-responsive">
                    <table class="display" id="<?php echo e($tableId); ?>">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Customer</th>
                                <th>Harga</th>
                                <th>Tanggal Transaksi</th>
                                <th>Komisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($loop->iteration); ?></td>
                                    <td><?php echo e($item->kategori); ?></td>
                                    <td><?php echo e($item->nama_customer); ?></td>
                                    <td><?php echo e($item->harga); ?></td>
                                    <td><?php echo e($item->tanggal_transaksi); ?></td>
                                    <td><?php echo e($item->komisi); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div><?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/laporan/table/data-pemasukkan.blade.php ENDPATH**/ ?>