<?php $__env->startSection('title'); ?>Daftar Pengeluaran
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Daftar Pengeluaran</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item active"><a href="<?php echo e(route('daftar-pengeluaran')); ?>">Daftar Pengeluaran</a></li>
		<li class="breadcrumb-item active">Table</li>
	<?php echo $__env->renderComponent(); ?>

    <nav class="page-breadcrumb">
        <ol class="breadcrumb align-items-center">
            <div class="d-grid gap-2 d-md-block mx-2">
                
                    <a href="<?php echo e(route('daftar-pengeluaran.create')); ?>" class="btn btn-info btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah Data">
                        <i class="fa fa-plus"></i> Tambah
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
										<th>Tanggal Pengeluaran</th>
										<th>Keterangan</th>
	                                    <th>Jumlah Pembayaran</th>
	                                    <th>Yang Menerima Pembayaran</th>
	                                    <th>Status Pengeluaran</th>
	                                    <th>Bukti Pembayaran</th>

										<?php if(Session::get('user_level') == 2): ?>
											<th>Pilih</th>
										<?php endif; ?>

										<th width="35%" class="text-center">Action</th>
	                                </tr>
	                            </thead>
	                            <tbody>                                        
                                    <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr>
											<td><?php echo e($loop->iteration); ?></td>
											<td><?php echo e($data->tgl_pengeluaran); ?></td>
											<td><?php echo e($data->keterangan); ?></td>
											<td><?php echo e(number_format($data->jumlah_pembayaran, 0, '.', ',')); ?></td>
											<td><?php echo e($data->yang_menerima); ?></td>
											<td>
												<span class="badge <?php echo e($data->status_pengeluaran == 1 ? 'badge-primary' : 'badge-warning'); ?>">
													<i class="fa <?php echo e($data->status_pengeluaran == 1 ? 'fa-check' : 'fa-warning'); ?>"></i>
													<?php echo e($data->status_pengeluaran == 1 ? 'Disetujui' : 'Pending'); ?>

												</span>
											</td>
											<td onmouseover="showBukti(<?php echo e($data->id); ?>)" onmouseout="hideBukti(<?php echo e($data->id); ?>)">
												<?php if($data->bukti_pembayaran != ''): ?>
													<div id="view-bukti<?php echo e($data->id); ?>" class="mb-3">
														<img src="<?php echo e(asset('storage/daftar-pengeluaran/'.$data->bukti_pembayaran)); ?>" alt="" width="200px" class="img-fluid mt-2">
														<a class="btn btn-primary" href="<?php echo e(asset('storage/daftar-pengeluaran/'.$data->bukti_pembayaran)); ?>" target="_blank">View Image</a>
													</div>
												<?php endif; ?>
												<div id="icon-view<?php echo e($data->id); ?>">
													<i data-feather="link"></i> Gambar
												</div>
												
											</td>

											<?php if(Session::get('user_level') == 2): ?>
												
												<td class="text-center">
													<input type="checkbox" value="5" name="id_pengeluaran[]" id="flexCheckDefault" onclick="ceklis(<?php echo e($data->id); ?>)">
												</td>
											<?php endif; ?>
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
    <script src="<?php echo e(asset('assets/js/datatable/datatables/datatable.custom.js')); ?>"></script>
	<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<script>
			$('#view-bukti'+<?php echo e($data->id); ?>).hide();
			$('#icon-view'+<?php echo e($data->id); ?>).show();
		</script>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<script>
		function showBukti(id) {
			$('#view-bukti'+id).show();
			$('#icon-view'+id).hide();
		}

		function hideBukti(id) {
			$('#view-bukti'+id).hide();
			$('#icon-view'+id).show();
		}

		function ceklis(id){
			$('.inner').append("<input type='hidden' value='"+id+"' name='id_pengeluaran[]'>");
		}
	</script>
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/munawarahmad/Documents/Applications/projectku/frontend/resources/views/daftar-pengeluaran/index.blade.php ENDPATH**/ ?>