<?php $__env->startSection('title'); ?>Dashboard Customer
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<div class="container-fluid">
        <div class="row">
        </div>
        <div class="row">
            <!-- Server Side Processing start-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="tabbed-card">
                        <div class="card-header pb-0">
                            <?php echo $__env->make('customers.component.nav-tabs', ['activeTab' => 'home'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>

                        <div class="tab-content" id="top-tabContentsecondary">
                            <div class="tab-pane fade active show" id="top-homesecondary" role="tabpanel" aria-labelledby="top-home-tab">
                                <?php echo $__env->make('customers.component.profile', ['data' => $user], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>

                            <div class="tab-pane fade" id="top-profilesecondary" role="tabpanel" aria-labelledby="profile-top-tab">
                                <?php echo $__env->make('customers.component.tagihan', ['data' => $tagihan, 'tableId' => 'basic-2'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>

                            <div class="tab-pane fade" id="top-contactsecondary" role="tabpanel" aria-labelledby="contact-top-tab">
                                <?php echo $__env->make('customers.component.resi', ['data' => $resi], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>

                        </div>	 
                    </div> 
                </div>
            </div>
        </div>  
	</div>
	
	<?php $__env->startPush('scripts'); ?>
	<script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script>
		$(document).ready(function() {
			$('#basic-1').DataTable({
				language: {
					"emptyTable": "Tidak ada data yang tersedia pada tabel ini",
					"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
					"infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
					"infoFiltered": " (disaring dari _MAX_ entri keseluruhan)",
					"lengthMenu": "Tampilkan _MENU_ entri",
					"loadingRecords": "Sedang memuat...",
					"processing": "Sedang memproses...",
					"search": "Cari:",
					"zeroRecords": "Tidak ditemukan data yang sesuai",
					"paginate": {
					"first": "Pertama",
					"last": "Terakhir",
					"next": "Selanjutnya",
					"previous": "Sebelumnya"
					},
				},
                searching: false,
			});

			// $('#basic-2').DataTable({
			// 	language: {
			// 		"emptyTable": "Tidak ada data yang tersedia pada tabel ini",
			// 		"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
			// 		"infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
			// 		"infoFiltered": " (disaring dari _MAX_ entri keseluruhan)",
			// 		"lengthMenu": "Tampilkan _MENU_ entri",
			// 		"loadingRecords": "Sedang memuat...",
			// 		"processing": "Sedang memproses...",
			// 		"search": "Cari:",
			// 		"zeroRecords": "Tidak ditemukan data yang sesuai",
			// 		"paginate": {
			// 		"first": "Pertama",
			// 		"last": "Terakhir",
			// 		"next": "Selanjutnya",
			// 		"previous": "Sebelumnya"
			// 		},
			// 	},
            //     searching: false,
			// });

			// $('#basic-3').DataTable({
			// 	language: {
			// 		"emptyTable": "Tidak ada data yang tersedia pada tabel ini",
			// 		"info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
			// 		"infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
			// 		"infoFiltered": " (disaring dari _MAX_ entri keseluruhan)",
			// 		"lengthMenu": "Tampilkan _MENU_ entri",
			// 		"loadingRecords": "Sedang memuat...",
			// 		"processing": "Sedang memproses...",
			// 		"search": "Cari:",
			// 		"zeroRecords": "Tidak ditemukan data yang sesuai",
			// 		"paginate": {
			// 		"first": "Pertama",
			// 		"last": "Terakhir",
			// 		"next": "Selanjutnya",
			// 		"previous": "Sebelumnya"
			// 		},
			// 	},
            //     searching: false,
			// });
		})
	</script>
	
	<?php $__currentLoopData = $tagihan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<script>
			$('#view-bukti'+<?php echo e($data->id); ?>).hide();
		</script>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

	<script>
		function showBukti(id) {
			$('#view-bukti'+id).show();
		}

		function hideBukti(id) {
			$('#view-bukti'+id).hide();
		}
	</script>
	
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/customers/dashboard.blade.php ENDPATH**/ ?>