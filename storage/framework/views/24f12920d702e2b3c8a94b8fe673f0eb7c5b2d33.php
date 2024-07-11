<?php $__env->startSection('title'); ?>Laporan Transaksi Harian
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<style>
	.dataTables_filter {
		display: none;
	}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Laporan Transaksi Harian</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item active"><a href="<?php echo e(route('laporan.transaksi-harian')); ?>">Laporan Transaksi Harian</a></li>
	<?php echo $__env->renderComponent(); ?>
	
	<div class="container-fluid">
        <form class="d-flex flex-column col-12" role="search" action="" method="GET">
			<div class="d-flex justify-content-end">
				<div class="px-2">
                    <select name="filter" class="form-control" onchange="toggleDateInputs(this)">
                        <option value="">-- Filter By --</option>
                        <option value="periode" <?php echo e($filter == 'periode' ? 'selected' : ''); ?>>Periode</option>
                        <option value="range" <?php echo e($filter == 'range' ? 'selected' : ''); ?>>Range Tanggal</option>
                    </select>
                </div>
                <div id="periode" class="px-2" style="display: <?php echo e($filter == 'periode' ? 'block' : 'none'); ?>">
                    <select name="periode" class="form-control">
                        <option value="">- Pilih Periode -</option>
                        <?php $__currentLoopData = getPastDates(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $date): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($date['value']); ?>" <?php echo e($periode == $date['value'] ? 'selected' : ''); ?>><?php echo e($date['name']); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
				<div id="start" style="display: <?php echo e($filter == 'range' ? 'block' : 'none'); ?>">
					<input class="form-control" type="date" name="start" value="<?php echo e($start); ?>" />
				</div>
				<div id="sampaiDengan" class="px-2" style="display: <?php echo e($filter == 'range' ? 'block' : 'none'); ?>">
					<p class="fs-5">s/d</p>
				</div>
				<div id="end" style="display: <?php echo e($filter == 'range' ? 'block' : 'none'); ?>">
					<input class="form-control" type="date" name="end" value="<?php echo e(request('end') ? request('end') : date('Y-m-d')); ?>" />
				</div>
				<div class="px-1">
					<button type="submit" class="btn btn-primary" title="Cari"><i class="fa fa-search"></i> Cari</button>
				</div>
				<div class="px-1">
					<a href="<?php echo e(route('laporan.transaksi-harian')); ?>" class="btn btn-md btn-secondary" title="Reset"><i class="fa fa-refresh"></i> Reset</a>
				</div>
			</div>
		</form>
        <div class="row">
        </div>
        <div class="row">
            <!-- Server Side Processing start-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="tabbed-card">
                        <div class="card-header pb-0">
							<div class="p-2">
								Periode: <?php echo e(\Carbon\Carbon::parse($start)->translatedFormat('d F Y')); ?> s/d <?php echo e(\Carbon\Carbon::parse($end_date)->translatedFormat('d F Y')); ?>

							</div>
                            <?php echo $__env->make('laporan.nav.nav-tabs', ['activeTab' => 'home'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>

                        <div class="tab-content" id="top-tabContentsecondary">
                            <div class="tab-pane fade active show" id="top-homesecondary" role="tabpanel" aria-labelledby="top-home-tab">
                                <?php echo $__env->make('laporan.table.data-pengiriman', ['data' => $pengiriman, 'tableId' => 'basic-1', 'customer' => $customer, 'metodePembayaran' => $metodePembayaran, 'statusPembayaran' => $statusPembayaran, 'statusPengiriman' => $statusPengiriman], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>

                            <div class="tab-pane fade" id="top-profilesecondary" role="tabpanel" aria-labelledby="profile-top-tab">
                                <?php echo $__env->make('laporan.table.data-pemasukkan', ['data' => $pemasukkan, 'tableId' => 'basic-2'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>

                            <div class="tab-pane fade" id="top-contactsecondary" role="tabpanel" aria-labelledby="contact-top-tab">
                                <?php echo $__env->make('laporan.table.data-pengeluaran', ['data' => $pengeluaran, 'tableId' => 'basic-3', 'metodePembayaran' => $metodePembayaran], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            </div>

                        </div>	 
                    </div> 
                </div>
            </div>
        </div>  
	</div>
	
	<?php $__env->startPush('scripts'); ?>
	<script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
	<script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>
	
    <script>
		$(document).ready(function() {
			var tableFirst = $('#basic-1').DataTable({
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
                searching: true,
				columnDefs: [
					{ searchable: false, targets: [0, 1, 2, 4, 5, 9]}
				],
			});

			var tableSecond = $('#basic-2').DataTable({
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

			var tableThird = $('#basic-3').DataTable({
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
                searching: true,
				columnDefs: [
					{ searchable: false, targets: [0, 1, 2, 3, 7, 8]}
				],
			});

			$('#search-metode').on('change', function() {
				tableFirst.column(6).search(this.value).draw();
			});

			$('#search-pembayaran').on('change', function() {
				tableFirst.column(7).search(this.value).draw();
			});

			$('#search-pengiriman').on('change', function() {
				tableFirst.column(8).search(this.value).draw();
			});

			$('#search-customer').on('change', function() {
				tableFirst.column(3).search(this.value).draw();
			});

			$('#search-pembayar').on('keyup', function() {
				tableThird.column(4).search(this.value).draw();
			});

			$('#search-penerima').on('keyup', function() {
				tableThird.column(5).search(this.value).draw();
			});

			$('#search-metode-pengeluaran').on('change', function() {
				tableThird.column(6).search(this.value).draw();
			});
		})
	</script>
	
	

	<script>
		function showBukti(id) {
			$('#view-bukti'+id).show();
		}

		function hideBukti(id) {
			$('#view-bukti'+id).hide();
		}
	</script>

	<script>
		function toggleDateInputs(select) {
			var start = document.getElementById('start');
			var sampaiDengan = document.getElementById('sampaiDengan');
			var end = document.getElementById('end');
			var periode = document.getElementById('periode');
			if (select.value == 'periode') {
				periode.style.display = 'block';
				start.style.display = 'none';
				sampaiDengan.style.display = 'none';
				end.style.display = 'none';
			} else if (select.value == 'range') {
				periode.style.display = 'none';
				start.style.display = 'block';
				sampaiDengan.style.display = 'block';
				end.style.display = 'block';
			}
		}
	</script>
	
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/munawarahmad/Documents/Applications/projectku/project-expedisi/resources/views/laporan/transaksi-harian.blade.php ENDPATH**/ ?>