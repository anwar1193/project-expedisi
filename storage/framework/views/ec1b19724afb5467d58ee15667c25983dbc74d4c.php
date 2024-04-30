<?php $__env->startSection('title'); ?> Riwayat Perjalanan
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
        <?php $__env->slot('breadcrumb_title'); ?>
              <h5>Data Riwayat Perjalanan <?php echo e($item->merk); ?> (<?php echo e($item->nopol); ?>)</h5>
        <?php $__env->endSlot(); ?>
            <li class="breadcrumb-item active">Riwayat Perjalanan</li>
	<?php echo $__env->renderComponent(); ?>
	
	<div class="container-fluid">
        <div class="row">
        </div>
	    <div class="row">
	        <div class="col-xl-12 recent-order-sec">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-end mb-3">
                      <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-light">
                        Kembali
                      </a>
                    </div>

                    <div class="table-responsive">
                      <table class="table table-bordernone">
                        <thead>
                          <tr>
                            <th>Waktu</th>
                            <th>Latitude</th>
                            <th>Langitude</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              <p>16 Januari - 12.45</p>
                            </td>
                            <td>
                              <p>-6.240437</p>
                            </td>
                            <td>
                              <p>106.797259</p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p>22 Februari - 11.20</p>
                            </td>
                            <td>
                              <p>-6.305025</p>
                            </td>
                            <td>
                              <p>106.852412</p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p>24 Februari - 11.20</p>
                            </td>
                            <td>
                              <p>-6.153167</p>
                            </td>
                            <td>
                              <p>106.842621</p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p>25 Februari - 11.20</p>
                            </td>
                            <td>
                              <p>-6.235438</p>
                            </td>
                            <td>
                              <p>106.828647</p>
                            </td>
                          </tr>
                          <tr>
                            <td>
                              <p>28 Februari - 11.20</p>
                            </td>
                            <td>
                              <p>-6.184301</p>
                            </td>
                            <td>
                              <p>106.737274</p>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
            </div>
	    </div>
	</div>
	
	<?php $__env->startPush('scripts'); ?>
	<script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatables/datatable.custom.js')); ?>"></script>
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/apps/paket1/frontend/resources/views/admin/dashboard/action/riwayat.blade.php ENDPATH**/ ?>