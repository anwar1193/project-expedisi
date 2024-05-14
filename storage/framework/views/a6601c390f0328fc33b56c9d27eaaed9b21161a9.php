<?php $__env->startSection('title'); ?>Laporan Laba/Rugi
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Laporan Laba/Rugi</h3>
		<?php $__env->endSlot(); ?>
	<?php echo $__env->renderComponent(); ?>
	
	<div class="container-fluid">
        <form class="d-flex flex-column col-12" role="search" action="" method="GET">
			<div class="d-flex justify-content-end">
				<div>
					<input class="form-control" type="date" name="start" value="<?php echo e(request('start') ? request('start') : date('Y-m-d')); ?>" />
				</div>
				<div class="px-2">
					<p class="fs-5">s/d</p>
				</div>
				<div>
					<input class="form-control" type="date" name="end" value="<?php echo e(request('end') ? request('end') : date('Y-m-d')); ?>" />
				</div>
				<div class="px-1">
					<button type="submit" class="btn btn-primary" title="Cari"><i class="fa fa-search"></i> Cari</button>
				</div>
				<div class="px-1">
					<a href="<?php echo e(route('laporan.laba-rugi')); ?>" class="btn btn-md btn-secondary" title="Reset"><i class="fa fa-refresh"></i> Reset</a>
				</div>
			</div>
		</form>
        <div class="row">
        </div>
	    <div class="row">
	        <!-- Server Side Processing start-->
            <div class="col-sm-12 col-xl-12">
                <div class="card">
                    <div class="card-header pb-0">
                        Periode: <?php echo e(\Carbon\Carbon::parse($start)->translatedFormat('d F Y')); ?> s/d <?php echo e(\Carbon\Carbon::parse($end_date)->translatedFormat('d F Y')); ?>                    
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            <a class="list-group-item list-group-item-action flex-column align-items-start" href="javascript:void(0)">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Jumlah Pengiriman</h5>
                                </div>
                                <p class="mb-1">Rp. <?php echo e(number_format($jumlah_pengiriman->totalPengiriman, 0, ',', '.') ?? 0); ?> ,-</p>
                            </a>
                            <a class="list-group-item list-group-item-action flex-column align-items-start" href="javascript:void(0)">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Jumlah Pemasukkan</h5>
                                </div>
                                <p class="mb-1">Rp. <?php echo e(number_format($jumlah_pemasukkan->totalPemasukan, 0, ',', '.') ?? 0); ?> ,-</p>
                            </a>
                            <a class="list-group-item list-group-item-action flex-column align-items-start" href="javascript:void(0)">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Jumlah Pengeluaran</h5>
                                </div>
                                <p class="mb-1">Rp. <?php echo e(number_format($jumlah_pengeluaran->totalPengeluaran, 0, ',', '.') ?? 0); ?> ,-</p>
                            </a>

                            <?php
                                $laba_rugi = $jumlah_pengiriman->totalPengiriman + $jumlah_pemasukkan->totalPemasukan - $jumlah_pengeluaran->totalPengeluaran;
                            ?>

                            <a class="list-group-item list-group-item-action flex-column align-items-start" href="javascript:void(0)">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Laba / Rugi</h5>
                                </div>
                                <p class="mb-1">
                                    <span class="badge <?php echo e($laba_rugi >= 0 ? 'badge-primary' : 'badge-danger'); ?>" style="font-size: 15px">
                                        Rp. <?php echo e(number_format($laba_rugi, 0, ',', '.') ?? 0); ?> ,-
                                    </span>
                                </p>
                            </a>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        
                    </div>
                </div>
            </div>
	        <!-- Server Side Processing end-->
	    </div>
	</div>
	
	<?php $__env->startPush('scripts'); ?>
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/munawarahmad/Documents/Applications/projectku/frontend/resources/views/laporan/laba-rugi.blade.php ENDPATH**/ ?>