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
				
				

				<a class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modalImport" title="Import Excel">
					<i class="fa fa-file-excel-o"></i> Import Excel
				</a>

				<a href="<?php echo e(route('data-pengiriman.truncate')); ?>" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Truncate Data">
					<i class="fa fa-trash"></i> Truncate
				</a>

				<a class="btn btn-primary btn-sm" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modalUpdateStatus" title="Update Status Pengiriman">
					<i class="fa fa-file-excel-o"></i> Update Status Pengiriman
				</a>

				<?php echo $__env->make('data-pengiriman.modal-import', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php echo $__env->make('data-pengiriman.status-pengiriman', ['status' => $status], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				<?php echo $__env->make('data-pengiriman.modal-status-pengiriman', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

				<?php if(Session::get('user_level') == 2): ?>
					<form action="<?php echo e(route('data-pengiriman.approve-selected')); ?>" method="post" style="display: inline-block">
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
						
						<?php if(session()->has('error') && is_string(session('error'))): ?>
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Gagal <i class="fa fa-info-circle"></i></strong> 
								<?php echo e(session('error')); ?>

								<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						<?php endif; ?>


						<?php if(session()->has('error') && is_array(session('error'))): ?>
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Gagal <i class="fa fa-info-circle"></i></strong>
								<ul>
									<?php $__currentLoopData = session('error'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<li><?php echo e($error); ?></li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								</ul>
								<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						<?php endif; ?>

						<?php if($errors->any()): ?>
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<strong>Gagal <i class="fa fa-info-circle"></i></strong> 
									<?php echo e($error); ?>

									<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
									<br>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</div>
						<?php endif; ?>
						
						<?php if(session()->has('errorStatus')): ?>
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<strong>Gagal <i class="fa fa-info-circle"></i></strong>
								<?php $__currentLoopData = session('errorStatus'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<div><?php echo e($error); ?></div>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								Silahkan  <a class="text-white text-decoration-underline" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modalStatusPengiriman" title="Status Pengiriman">
									<i class="fa fa-eye"></i>lihat di sini.
								</a>
								<button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
						<?php endif; ?>
	                    
						
						<div class="table-responsive">
	                        <table class="display" id="basic-1">
	                            <thead>
	                                <tr>
	                                    <th>No</th>
										<th width="35%" class="text-center">Action</th>
										<th>No Resi</th>
										<th>Tanggal Transaksi</th>
	                                    <th>Customer</th>
										<th>Metode Pembayaran</th>
	                                    <th>Status Pembayaran</th>
	                                    <th>Status Pengiriman</th>
	                                    <th>Pengirim</th>
	                                    <th>Penerima</th>
	                                    <th>Kota Tujuan</th>
	                                    <th>Bawa Sendiri</th>
	                                    <th>Ongkir</th>
	                                    <th>Diinput Oleh</th>
										
										<?php if(Session::get('user_level') == 2): ?>
											<th>Pilih</th>
										<?php endif; ?>
	                                </tr>
	                            </thead>
	                            <tbody>
									
                                    <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php
											$bukti_pembayaran = $data->bukti_pembayaran;

											if($bukti_pembayaran != ''){
												$explode = explode("/", $bukti_pembayaran);
												$bukti_pembayaran_view = 'https://'.$explode[2].'/thumbnail?id='.$explode[5];
											}else{
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

															<?php if($data->metode_pembayaran == 'Transfer' && $data->status_pembayaran != 1 && Session::get('user_level') == 2): ?>
																<a class="dropdown-item" href="<?php echo e(route('data-pengiriman.approve', $data->id)); ?>" onclick="return confirm('Approve Data Pengiriman Ini?')"><span><i data-feather="check-square"></i> Approve</span></a>
															<?php endif; ?>
															
															<a class="dropdown-item" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modalDataPengiriman<?php echo e($data->id); ?>" title="Detail Data"><span><i data-feather="eye"></i> Detail</span></a>

															<?php if($data->status_pembayaran == 2 || Session::get('user_level') == 2): ?>
																<a class="dropdown-item" href="<?php echo e(route('data-pengiriman.edit', $data->id)); ?>"><span><i data-feather="edit"></i> Edit</span></a>
															<?php endif; ?>

															<a class="dropdown-item" href="<?php echo e(route('data-pengiriman.delete', $data->id)); ?>" onclick="return confirm('Apakah Anda Yakin?')"><span><i data-feather="delete"></i> Delete</span></a>
															
														</div>
													</div>
												</div>
												<?php echo $__env->make('data-pengiriman.detail', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
												<?php echo $__env->make('data-pengiriman.status-pembayaran', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
											</td>

											<td>
												<span class="badge badge-danger">
													<?php echo e($data->no_resi); ?>

												</span>
											</td>

											<td><?php echo e(date('d-m-Y', strtotime($data->tgl_transaksi))); ?></td>
											<td>
												<?php if($data->kode_customer == "General"): ?>
													<?php echo e($data->kode_customer); ?>

												<?php else: ?>
													<?php echo e($data->kode_customer); ?> - <?php echo e($data->nama); ?>

												<?php endif; ?>
											</td>
											<td onmouseover="showBukti(<?php echo e($data->id); ?>)" onmouseout="hideBukti(<?php echo e($data->id); ?>)">
												<?php if($bukti_pembayaran != ''): ?>
													<div id="view-bukti<?php echo e($data->id); ?>" class="mb-3">
														<img src="<?php echo e($bukti_pembayaran_view); ?>" alt="test" class="mb-2">
														<a class="btn btn-primary" href="<?php echo e($bukti_pembayaran); ?>" target="_blank">View Full Image</a>
													</div>
												<?php endif; ?>

												<?php echo e($data->metode_pembayaran); ?> <i class="<?php echo e($data->metode_pembayaran == 'Transfer' ? 'fa fa-eye' : ''); ?>"></i>
											</td>

											<td class="text-center">
												<span class="badge <?php echo e($data->status_pembayaran == 1 ? 'badge-primary' : 'badge-warning'); ?>">
													<i class="fa <?php echo e($data->status_pembayaran == 1 ? 'fa-check' : 'fa-warning'); ?>"></i>
													<?php echo e($data->status_pembayaran == 1 ? 'Lunas' : 'Pending'); ?>

												</span>
											</td>

											<td><?php echo e($data->status_pengiriman); ?></td>
											
											<td><?php echo e($data->nama_pengirim); ?></td>
											<td><?php echo e($data->nama_penerima); ?></td>
											<td><?php echo e($data->kota_tujuan); ?></td>
											<td><?php echo e($data->bawa_sendiri); ?></td>
											<td><?php echo e(number_format($data->ongkir, 0, '.', ',')); ?></td>

											<td><?php echo e($data->input_by); ?></td>

											<?php if(Session::get('user_level') == 2): ?>
												
												<td class="text-center">
													<input type="checkbox" value="5" name="id_pengiriman[]" id="flexCheckDefault" onclick="ceklis(<?php echo e($data->id); ?>)">
												</td>
											<?php endif; ?>
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
	
	<?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

		function ceklis(id){
			$('.inner').append("<input type='hidden' value='"+id+"' name='id_pengiriman[]'>");
		}
	</script>
	
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/data-pengiriman/index.blade.php ENDPATH**/ ?>