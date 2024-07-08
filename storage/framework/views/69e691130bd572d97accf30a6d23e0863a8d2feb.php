<?php $__env->startSection('title'); ?>Invoice
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<style>
	.dataTables_filter {
		display: none;
	}

    .dataTables_length label {
        display: none
    }
</style> 
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	
	<div class="container invoice">
	    <div class="row">
	        <div class="col-sm-12">
				<form action="<?php echo e(route('invoice.customer-pdf', ['id' => $customer->id, 'invoiceId' => $customer->invoiceId])); ?>" method="GET" target="_blank">
	            <div class="card">
	                <div class="card-body">	
						<?php if(session()->has('success')): ?>
							<div class="alert alert-success alert-dismissible fade show" role="alert">
								<strong>Berhasil <i class="fa fa-info-circle"></i></strong> 
								<?php echo e(session('success')); ?>

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
						
	                    <div>
	                        <div>
	                            <div class="row invo-header">
	                                <div class="col-sm-5">
	                                    <div class="media">
	                                        <div class="media-left">
												<img src="<?php echo e(asset('assets/lionparcel.png')); ?>" alt="Lion Parcel" style="width: 200px; height: 60px;" />
												<h4 class="text-danger ps-2 fw-bold">D Angel Express</h4>	                                        </div>
	                                    </div>
	                                    <!-- End Info-->
	                                </div>
	                                <div class="col-sm-3 d-flex align-items-end">
	                                    <div class="text-md-end text-xs-center">
	                                        <h3>Invoice</h3>
	                                    </div>
	                                </div>
	                                <div class="col-sm-3 d-flex align-items-end">
	                                    <div class="text-md-end text-xs-center">
	                                        <p>Makassar, <?php echo e(formatTanggalIndonesia($customer->created_at)); ?></p>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <!-- End InvoiceTop-->
	                        <div class="row invo-profile py-2 my-2" style="border: 0.5px solid; width: 70%">
	                            <div class="col-xl-8">
	                                <div class="text-xl-start" id="project">
                                        <div class="row d-flex py-1 text-start justify-content-start">
                                            <div class="col-4 col-lg-4">Invoice No</div>
                                            <div class="col-1 col-lg-2">:</div>
                                            <div class="col-6 col-lg-6 text-capitalize"><?php echo e($customer->invoice_no); ?></div>
                                        </div>
                                        <div class="row d-flex py-1 text-start justify-content-start">
                                            <div class="col-4 col-lg-4">Customer Name</div>
                                            <div class="col-1 col-lg-2">:</div>
                                            <div class="col-6 col-lg-6 text-capitalize"><?php echo e($customer->nama); ?></div>
                                        </div>
                                        <div class="row d-flex py-1 text-start justify-content-start">
                                            <div class="col-4 col-lg-4">Address</div>
                                            <div class="col-1 col-lg-2">:</div>
                                            <div class="col-6 col-lg-6 text-capitalize"><?php echo e($customer->alamat); ?></div>
                                        </div>
	                                </div>
	                            </div>
	                        </div>
							<div class="my-2 py-2">
								<small>Biaya Pengiriman</small> <?php echo e($customer->nama); ?>

							</div>
	                        <!-- End Invoice Mid-->
	                        <div>
	                            <div class="table-responsive" id="table">
	                                <table class="display" id="basic-1">
	                                    <thead class="text-center">
											<tr>
												<th width="5%" style="border: 1px solid">No</th>
												<th style="border: 1px solid">No STT</th>
												<th width="10%" style="border: 1px solid">Tanggal</th>
												<th style="border: 1px solid">Pengirim</th>
												<th style="border: 1px solid">Penerima</th>
												<th style="border: 1px solid">Tujuan</th>
												<th style="border: 1px solid">Jumlah Pembayaran</th>
											</tr>
										</thead>
										<tbody style="font-size: 14px">
                                            <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td style="border: 1px solid; padding: 5px; text-align: center"><?php echo e($loop->iteration); ?></td>
                                                    <td style="border: 1px solid; padding: 5px; text-align: center"><?php echo e($data->no_resi); ?></td>
                                                    <td style="border: 1px solid; padding: 5px; text-align: center"><?php echo e($data->created_at); ?></td>
                                                    <td style="border: 1px solid; padding: 5px; text-align: center"><?php echo e($data->nama_pengirim); ?></td>
                                                    <td style="border: 1px solid; padding: 5px; text-align: center"><?php echo e($data->nama_penerima); ?></td>
                                                    <td style="border: 1px solid; padding: 5px; text-align: center"><?php echo e($data->kota_tujuan); ?></td>
                                                    <td style="border: 1px solid; padding: 5px; text-align: center">Rp <?php echo e(number_format($data->ongkir, 0, '.', '.')); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan=<?php echo e(!isCustomer() ? "7" : "6"); ?> class="text-center">
                                                        <p class="fw-semibold">Belum Ada Data Transaksi</p>
                                                    </td>
                                                </tr>
                                            <?php endif; ?> 
										</tbody>
										<?php if(!isCustomer()): ?>
											<tfoot>
												<tr>
													<td style="border: 1px solid; padding: 5px; text-align: center"></td>
													<td colspan="5" style="border: 1px solid; padding: 5px; text-align: center">
														<p class="fw-semibold">Sub Total</p>
													</td>
													<td style="border: 1px solid; padding: 5px; text-align: center">
														Rp <?php echo e(number_format($total->total, 0, '.', '.')); ?>

													</td>
												</tr>
												<tr>
													<td style="border: 1px solid; padding: 5px; text-align: center"></td>
													<td colspan="5" style="border: 1px solid; padding: 5px; text-align: center">
														<p class="fw-semibold">Diskon Customer (<?php echo e($customer->diskon_customer); ?>%)</p>
													</td>
													<td style="border: 1px solid; padding: 5px; text-align: center">
														Rp <?php echo e(number_format($diskon, 0, '.', '.')); ?>

													</td>
												</tr>
												<tr>
													<td style="border: 1px solid; padding: 5px; text-align: center"></td>
													<td colspan="5" style="border: 1px solid; padding: 5px; text-align: center">
														<p class="fw-semibold">Diskon</p>
													</td>
													<td style="border: 1px solid; padding: 5px; text-align: center">
														Rp <?php echo e(number_format($customer->diskon, 0, '.', '.')); ?>

													</td>
												</tr>
												<tr>
													<td style="border: 1px solid; padding: 5px; text-align: center"></td>
													<td colspan="5" style="border: 1px solid; padding: 5px; text-align: center">
														<p class="fw-semibold">Total</p>
													</td>
													<td style="border: 1px solid; padding: 5px; text-align: center">
														Rp <?php echo e(number_format($totalBersih, 0, '.', '.')); ?>

													</td>
												</tr>
<<<<<<< HEAD:storage/framework/views/69e691130bd572d97accf30a6d23e0863a8d2feb.php
=======
												<tr>
													<td style="border: 1px solid; padding: 5px; text-align: center"></td>
													<td colspan="6" style="border: 1px solid; padding: 5px; text-align: center">
														<p class="fw-semibold">Total</p>
													</td>
													<td style="border: 1px solid; padding: 5px; text-align: center">
														Rp <?php echo e(number_format($total->total, 0, '.', '.')); ?>

													</td>
												</tr>
												
>>>>>>> b7d2255f1f4ecf4ace15a78c857c0777992b1dfb:storage/framework/views/e70a00c117927a1ccae7b98247a21098ae5a421c.php
											</tfoot>											
										<?php endif; ?>
	                                </table>
	                            </div>
	                            <!-- End Table-->
	                            <div class="text-center mt-3">
									<p>Lion parcel - D Angel Express</p>
									<p>Jl. Onta Baru no 51, Kelurahan Mandala, Kecamatan Mamajang, Kota Makassar – 90135, Sulawesi Selatan</p>
									<p>Telp : 0411 – 8918311 , 082110071565</p>
									<p>Website : http://lionparcel.com</p>
								</div>
	                        </div>
	                        <!-- End InvoiceBot-->
	                    </div>
	                    <!-- End Invoice-->
	                    <!-- End Invoice Holder-->
	                </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center">
							<div class="px-2">
								<button type="submit" class="btn btn-primary">
									<?php echo e($exist ? "Cetak Invoice" : "Generate Invoice"); ?>

								</button>
							</div>
							</form>
<<<<<<< HEAD:storage/framework/views/69e691130bd572d97accf30a6d23e0863a8d2feb.php
                            <div class="px-2">
                                <form action="<?php echo e(route('invoice.send-wa')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo e($customer->id); ?>">
                                    <input type="hidden" name="invoice_id" value="<?php echo e($customer->invoiceId); ?>">
                                    <button type="submit" class="btn btn-success">Kirim Ke Whatsapp</button>
                                </form>
                            </div>
                            <div class="pz-2">
                                <form action="<?php echo e(route('invoice.send-email')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <input type="hidden" name="id" value="<?php echo e($customer->id); ?>">
                                    <input type="hidden" name="invoice_id" value="<?php echo e($customer->invoiceId); ?>">
                                    <button type="submit" class="btn btn-success">Kirim Ke Email</button>
                                </form>
                            </div>
=======
							<?php if($exist): ?>
								<div class="px-2">
									<form action="<?php echo e(route('invoice.send-wa')); ?>" method="POST">
										<?php echo csrf_field(); ?>
										<input type="hidden" name="id" value="<?php echo e($customer->id); ?>">
										<button type="submit" class="btn btn-success">Kirim Ke Whatsapp</button>
									</form>
								</div>
								<div class="pz-2">
									<form action="<?php echo e(route('invoice.send-email')); ?>" method="POST">
										<?php echo csrf_field(); ?>
										<input type="hidden" name="id" value="<?php echo e($customer->id); ?>">
										<button type="submit" class="btn btn-success">Kirim Ke Email</button>
									</form>
								</div>
							<?php endif; ?>
							
>>>>>>> b7d2255f1f4ecf4ace15a78c857c0777992b1dfb:storage/framework/views/e70a00c117927a1ccae7b98247a21098ae5a421c.php
                            
	                    </div>
                    </div>
	            </div>
	        </div>
	    </div>
	</div>
	
	<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable/datatables/datatable.custom.js')); ?>"></script>
	<script src="<?php echo e(asset('assets/js/counter/jquery.waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/counter/jquery.counterup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/counter/counter-custom.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/print.js')); ?>"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const diskonInput = document.querySelector('input[name="diskon"]');
			const totalDisplay = document.getElementById('totalDisplay');
			const totalAwal = <?php echo e($total->total ?? 0); ?>;
			
			function updateTotal() {
				const diskon = parseInt(diskonInput.value) || 0;
				const totalAkhir = totalAwal - diskon;
				totalDisplay.innerHTML = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalAkhir);
			}

			// Tampilkan total awal
			updateTotal();

			// Event listener untuk perubahan diskon
			diskonInput.addEventListener('input', function() {
				updateTotal();
			});
		});
	</script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			const diskonInput = document.querySelector('input[name="diskon"]');
			const displayElement = document.createElement('div');
			displayElement.innerHTML = '<strong>RP. ' + new Intl.NumberFormat('id-ID').format(diskonInput.value) + '</strong>';
			diskonInput.parentNode.appendChild(displayElement);

			diskonInput.addEventListener('input', function() {
				const typedValue = diskonInput.value;
				displayElement.innerHTML = '<strong>RP. ' + new Intl.NumberFormat('id-ID').format(typedValue) + '</strong>';
			});

			function toggleCheckAllSelect() {
				const checkAll = document.getElementById('checkAll');
				const checkPengiriman = document.getElementsByName('id_pengiriman[]');
				if (checkAll.checked) {
						checkPengiriman.forEach(item => {
						item.checked = true; 
					});
				} else {
					checkPengiriman.forEach(item => {
						item.checked = false; 
					});
				}
			}

			checkAll.addEventListener('change', toggleCheckAllSelect);

			toggleCheckAllSelect();
		});
	</script>
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/invoice/hasil-transaksi.blade.php ENDPATH**/ ?>