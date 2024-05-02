<?php $__env->startSection('title'); ?>Data Pengiriman
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Data Pengiriman</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item active"><a href="<?php echo e(route('data-pengiriman')); ?>">Data Pengiriman</a></li>
		<li class="breadcrumb-item active">Table</li>
	<?php echo $__env->renderComponent(); ?>

    <nav class="page-breadcrumb">
        <ol class="breadcrumb align-items-center">
            <div class="d-grid gap-2 d-md-block mx-2">
                
                    <a href="<?php echo e(route('data-pengiriman.create')); ?>" class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data">
                        <i class="fa fa-plus"></i> Tambah
                    </a>

					<a class="btn btn-success" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modalImport" title="Import Excel">
						<i class="fa fa-file-excel-o"></i> Import Excel
					</a>
					<?php echo $__env->make('data-pengiriman.modal-import', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                
            </div>
        </ol>
    </nav>
	
	<div class="container-fluid">
        <div class="row">
        </div>
	    <div class="row">
	        <!-- Server Side Processing start-->
	        <div class="col-sm-12">
	            <div class="card">
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
	                    
						
						<div class="table-responsive">
	                        <table class="display" id="basic-1">
	                            <thead>
	                                <tr>
	                                    <th>No</th>
										<th>No Resi</th>
										<th>Nama Penrima</th>
	                                    <th>No HP Penerima</th>
	                                    <th>Kota Tujuan</th>
	                                    <th>Berat Barang</th>
	                                    <th>Ongkir</th>
	                                    <th>Status Pembayaran</th>
										<th width="35%" class="text-center">Aksi</th>
	                                </tr>
	                            </thead>
	                            <tbody>                                        
                                    <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr>
											<td><?php echo e($loop->iteration); ?></td>
											<td><?php echo e($data->no_resi); ?></td>
											<td><?php echo e($data->nama_penerima); ?></td>
											<td><?php echo e($data->no_hp_penerima); ?></td>
											<td><?php echo e($data->kota_tujuan); ?></td>
											<td><?php echo e($data->berat_barang); ?></td>
											<td><?php echo e($data->ongkir); ?></td>
											<td><?php echo e($data->status_pembayaran == 1 ? 'Lunas' : 'Pending'); ?></td>
											<td class="text-center">
												<a class="btn btn-square btn-info btn-xs" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modalDataPengiriman<?php echo e($data->id); ?>"title="Detail Data">
													<i class="fa fa-eye"></i>
												</a>

												<a href="<?php echo e(route('data-pengiriman.edit', $data->id)); ?>" class="btn btn-square btn-warning btn-xs" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Data">
													<i class="fa fa-edit"></i>
												</a>
												
												<a href="<?php echo e(route('data-pengiriman.delete', $data->id)); ?>" class="btn btn-square btn-danger btn-xs" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Data" onclick="return confirm('Apakah Anda Yakin?')">
													<i class="fa fa-trash"></i>
												</a>

												<a class="btn btn-square btn-warning btn-xs" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#statusPembayaran<?php echo e($data->id); ?>" title="Edit Status Pembayaran">
													<i class="fa fa-credit-card"></i>
												</a>
												<?php echo $__env->make('data-pengiriman.detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
												<?php echo $__env->make('data-pengiriman.status-pembayaran', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
											</td>
										</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	                            </tbody>
	                        </table>
	                    </div>

	                </div>
	            </div>
	        </div>
	        <!-- Server Side Processing end-->
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
			});
		})
	</script>
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/munawarahmad/Documents/Applications/projectku/frontend/resources/views/data-pengiriman/index.blade.php ENDPATH**/ ?>