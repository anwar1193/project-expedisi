<?php $__env->startSection('title'); ?>Data Pengeluaran
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<style>
	.select2-container--default .select2-selection--single .select2-selection__rendered {
		background-color: black;
	}

	.tooltip-img {
		display: none;
		position: absolute;
		z-index: 1000;
		border: 1px solid #ccc;
		background-color: #fff;
		padding: 10px;
		box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
	}

	input[type="checkbox"] {
		transform: scale(2);
	}

	.content {
        flex: 1;
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }

	table.dataTable thead th, table.dataTable thead td {
		padding: 10px 18px;
		border-bottom: 1px solid #111;
	}

	.table-container {
        flex: 1;
        overflow: auto;
        max-height: 500px;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th, .table td {
        padding: 8px 12px;
        border: 1px solid #ccc;
        text-align: left;
    }

	.table thead th {
        background-color: #f2f2f2;
        position: sticky;
        top: 0;
        z-index: 1;
    }

	#table-wrapper {
		position: relative;
		margin-bottom: 20px;
	}

    #table-container {
		width: 100%;
		overflow-x: auto;
		white-space: nowrap;
	}

	.scrollbar-container {
		position: fixed;
		bottom: 0;
		left: 0;
		width: 100%;
		height: 20px;
		overflow-x: auto;
		background: #f1f1f1;
		z-index: 1;
	}

	.scrollbar {
		height: 1px;
		width: 100%;
	}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Data Pengeluaran</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item active"><a href="<?php echo e(route('daftar-pengeluaran')); ?>">Data Pengeluaran</a></li>
		<li class="breadcrumb-item active">Table</li>
	<?php echo $__env->renderComponent(); ?>

    <nav class="page-breadcrumb">
        <ol class="breadcrumb align-items-center">
            <div class="d-grid gap-2 d-md-block mx-2">
                
                    <a href="<?php echo e(route('daftar-pengeluaran.create')); ?>" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data">
                        <i class="fa fa-plus"></i> Tambah
                    </a>
                    
					<a class="btn btn-danger btn-sm" href="<?php echo e(route('daftar-pengeluaran.export-pdf')); ?>" target="_blank">
						<i class="fa fa-check-square"></i> Download PDF
					</a>

					<?php if(Session::get('user_level') == 2): ?>
						<form action="<?php echo e(route('data-pengeluaran.approve-selected')); ?>" method="post" style="display: inline-block">
							<?php echo csrf_field(); ?>
							<div class="inner"></div>
							<button type="submit" class="btn btn-success btn-sm" style="display: inline" onclick="return confirm('Approve semua data terpilih?')">
								<i class="fa fa-check-square"></i> Approve Selected
							</button>
						</form>
						
					<?php endif; ?>
                
            </div>
        </ol>
    </nav>
	
	<div class="container-fluid">
		<form class="d-flex flex-column col-12 mb-2" role="search" action="" method="GET">
			<div class="d-flex justify-content-end">
                <div id="customer_id" class="px-2">
                    <select name="kategori" class="form-control js-example-basic-single py-2">
                        <option value="">Pilih Kategori</option>
                        <?php $__currentLoopData = $jenis_pengeluaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->id); ?>" <?php echo e(request('kategori') == $item->id ? 'selected' : ''); ?>><?php echo e($item->jenis_pengeluaran); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
				<div class="px-1">
					<button type="submit" class="btn btn-primary" title="Cari"><i class="fa fa-search"></i> Cari</button>
				</div>
				<div class="px-1">
					<a href="<?php echo e(route('daftar-pengeluaran')); ?>" class="btn btn-md btn-secondary" title="Reset"><i class="fa fa-refresh"></i> Reset</a>
				</div>
			</div>
		</form>
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
	                    
						
						<div class="" id="table-wrapper">
							<div class="table-responsive" id="table-container">
								<table class="display" id="basic-1">
									<thead>
										<tr>
											<th>No</th>
											<th>Action</th>
											<?php if(Session::get('user_level') == 2): ?>
												<th class="text-end">
													<input type="checkbox" id="checkAll" title="Pilih Semua">
												</th>
											<?php endif; ?>
											<th>Tanggal Pengeluaran</th>
											<th>Keterangan</th>
											<th>Jumlah Pembayaran</th>
											<th>Yang Menerima Pembayaran</th>
											<th>Metode Pembayaran</th>
											<th>Yang Melakukan Pembayaran</th>
											<th>Status Pengeluaran</th>
											<th>Bukti Pembayaran</th>										
										</tr>
									</thead>
									<tbody>                                        
										<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php
												$bukti_pembayaran = $data->bukti_pembayaran;

												if (strpos($bukti_pembayaran, 'https://drive.google.com/file/d/') !== false) {
													$explode = explode("/", $bukti_pembayaran);
													$bukti_pembayaran_view = 'https://' . $explode[2] . '/thumbnail?id=' . $explode[5];
												} elseif (pathinfo($bukti_pembayaran, PATHINFO_EXTENSION) != '') {
													$bukti_pembayaran_view = asset('storage/daftar-pengeluaran/'.$data->bukti_pembayaran);
												} else {
													$bukti_pembayaran_view = '#';
												}
											?>
											<tr>
												<td><?php echo e($loop->iteration); ?></td>
												<td class="text-center">

													<div class="btn-group" role="group" aria-label="Button group with nested dropdown">
														<div class="btn-group" role="group">
															<button class="btn btn-secondary btn-sm dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
															<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

																<?php if($data->status_pengeluaran != 1 && Session::get('user_level') == 2): ?>
																	<a class="dropdown-item" href="<?php echo e(route('daftar-pengeluaran.approve', $data->id)); ?>" onclick="return confirm('Approve Data Pengeluaran Ini?')"><span><i data-feather="check-square"></i> Approve</span></a>
																<?php endif; ?>

																<a class="dropdown-item" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modalDataPengiriman<?php echo e($data->id); ?>" title="Detail Data"><span><i data-feather="eye"></i> Detail</span></a>

																<?php if($data->status_pengeluaran != 1): ?>
																	<a class="dropdown-item" href="<?php echo e(route('daftar-pengeluaran.edit', $data->id)); ?>" ><span><i data-feather="edit"></i> Edit</span></a>
																<?php endif; ?>

																<?php if(Session::get('user_level') == 1): ?>
																	<a class="dropdown-item" href="<?php echo e(route('daftar-pengeluaran.delete', $data->id)); ?>" onclick="return confirm('Apakah Anda Yakin?')"><span><i data-feather="delete"></i> Delete</span></a>
																<?php endif; ?>
																
															</div>
														</div>
													</div>
													<?php echo $__env->make('daftar-pengeluaran.detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
												</td>
												<?php if(Session::get('user_level') == 2): ?>
													
													<td class="text-center">
														<input type="checkbox" value="<?php echo e($data->id); ?>" class="checkbox-item" id="checkbox-<?php echo e($data->id); ?>" onclick="ceklis(<?php echo e($data->id); ?>)">
													</td>
												<?php endif; ?>
												<td><?php echo e($data->tgl_pengeluaran); ?></td>
												<td><?php echo e($data->keterangan); ?></td>
												<td><?php echo e(number_format($data->jumlah_pembayaran, 0, '.', ',')); ?></td>
												<td><?php echo e($data->yang_menerima); ?></td>
												<td><?php echo e($data->metode_pembayaran); ?></td>
												<td><?php echo e($data->yang_membayar); ?></td>
												<td>
													<span class="badge <?php echo e($data->status_pengeluaran == 1 ? 'badge-primary' : 'badge-warning'); ?>">
														<i class="fa <?php echo e($data->status_pengeluaran == 1 ? 'fa-check' : 'fa-warning'); ?>"></i>
														<?php echo e($data->status_pengeluaran == 1 ? 'Disetujui' : 'Pending'); ?>

													</span>
												</td>
												<td onmouseover="showBukti(<?php echo e($data->id); ?>)" onmouseout="hideBukti(<?php echo e($data->id); ?>)" style="position: relative;">
													<?php if($data->bukti_pembayaran != ''): ?>
														<div id="tooltip<?php echo e($data->id); ?>" class="tooltip-img">
															<a href="<?php echo e($bukti_pembayaran_view); ?>" target="_blank">
																<img src="<?php echo e($bukti_pembayaran_view); ?>" alt="" width="200px">
															</a>
														</div>
													<?php endif; ?>
													<div id="icon-view<?php echo e($data->id); ?>">
														<i data-feather="link"></i> Gambar
													</div>
													
												</td>
											</tr>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</tbody>
								</table>
							</div>
						</div>

						<div class="scrollbar-container" id="scrollbar-container">
							<div class="scrollbar"></div>
						</div>

	                </div>
	            </div>
	        </div>
	        <!-- Server Side Processing end-->
	    </div>
	</div>
	
	<?php $__env->startPush('scripts'); ?>
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
				lengthMenu: [
					[10, 25, 50, -1],
					[10, 25, 50, 'All']
				],
			});
		})
	</script>	
	<script>
        document.addEventListener('DOMContentLoaded', function() {
            const tableContainer = document.getElementById('table-container');
            const scrollbarContainer = document.getElementById('scrollbar-container');
            const scrollbar = document.querySelector('.scrollbar');

            // Synchronize scroll positions
            scrollbarContainer.addEventListener('scroll', function() {
                tableContainer.scrollLeft = scrollbarContainer.scrollLeft;
            });

            tableContainer.addEventListener('scroll', function() {
                scrollbarContainer.scrollLeft = tableContainer.scrollLeft;
            });

            // Set the width of the scrollbar to match the table content width
            scrollbar.style.width = tableContainer.scrollWidth + 'px';
        });
    </script>
	<script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
    
	<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<script>
			$('#view-bukti'+<?php echo e($data->id); ?>).hide();
			$('#icon-view'+<?php echo e($data->id); ?>).show();
		</script>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<script>
		function showBukti(id) {
			var tooltip = document.getElementById('tooltip' + id);
			tooltip.style.display = 'block';
		}

		function hideBukti(id) {
			var tooltip = document.getElementById('tooltip' + id);
			tooltip.style.display = 'none';
		}
		// function showBukti(id) {
		// 	$('#view-bukti'+id).show();
		// 	$('#icon-view'+id).hide();
		// }

		// function hideBukti(id) {
		// 	$('#view-bukti'+id).hide();
		// 	$('#icon-view'+id).show();
		// }

		// function ceklis(id){
		// 	$('.inner').append("<input type='hidden' value='"+id+"' name='id_pengeluaran[]'>");
		// }
	</script>
	<script>
		$(document).ready(function() {
			$('#checkAll').click(function() {
				if ($(this).is(':checked')) {
					$('.checkbox-item').prop('checked', true);
					$('.checkbox-item').each(function() {
						var id = $(this).val();
						if (!$('.inner input[value="'+id+'"]').length) {
							$('.inner').append("<input type='hidden' value='"+id+"' name='id_pengeluaran[]'>");
						}
					});
				} else {
					$('.checkbox-item').prop('checked', false);
					$('.inner').empty();
				}
			});

			$('.checkbox-item').change(function() {
				var id = $(this).val();
				if ($(this).is(':checked')) {
					if (!$('.inner input[value="'+id+'"]').length) {
						$('.inner').append("<input type='hidden' value='"+id+"' name='id_pengeluaran[]'>");
					}
				} else {
					$('.inner input[value="'+id+'"]').remove();
				}
			});
		});

		function ceklis(id) {
			var checkbox = $('#checkbox-' + id);
			if (checkbox.is(':checked')) {
				if (!$('.inner input[value="'+id+'"]').length) {
					$('.inner').append("<input type='hidden' value='"+id+"' name='id_pengeluaran[]'>");
				}
			} else {
				$('.inner input[value="'+id+'"]').remove();
			}
		}
	</script>
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/daftar-pengeluaran/index.blade.php ENDPATH**/ ?>