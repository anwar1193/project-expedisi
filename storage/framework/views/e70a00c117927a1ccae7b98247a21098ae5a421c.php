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
				<form action="<?php echo e(route('invoice.handle-transactions', $customer->id)); ?>" method="POST">
				<?php echo csrf_field(); ?>
	            <div class="card">
	                <div class="card-body">						
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
	                                        <p>Makassar, <?php echo e(formatTanggalIndonesia($invoice->created_at)); ?></p>
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
                                            <div class="col-6 col-lg-6 text-capitalize"><?php echo e($invoice->invoice_no); ?></div>
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
								<small>Biaya Pengiriman</small>  PT. Dion Farma Abadi
							</div>
	                        <!-- End Invoice Mid-->
	                        <div>
	                            <div class="table-responsive invoice-table" id="table">
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
												<th style="border: 1px solid">Pilih</th>
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
                                                    <td style="border: 1px solid; padding: 5px; text-align: center">
														<input type="checkbox" name="id_pengiriman[]" value="<?php echo e($data->id); ?>" <?php echo e($data->transaksi->isNotEmpty() ? 'checked' : ''); ?>>
													</td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="7" class="text-center">
                                                        <p class="fw-semibold">Belum Ada Data Transaksi</p>
                                                    </td>
                                                </tr>
                                            <?php endif; ?> 
										</tbody>
                                        <tfoot>
                                            
                                            <tr>
                                                <td style="border: 1px solid; padding: 5px; text-align: center"></td>
                                                <td colspan="6" style="border: 1px solid; padding: 5px; text-align: center">
                                                    <p class="fw-semibold">Diskon</p>
                                                </td>
                                                <td style="border: 1px solid; padding: 5px; text-align: center">
                                                    <input class="text-center form-control" type="number" name="diskon" id="diskon" value="<?php echo e(old('diskon', $invoice->diskon)); ?>">
                                                </td>
                                            </tr>
                                            
                                        </tfoot>
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
                        <div class="col-sm-12 text-center">
							<button type="submit" class="btn btn-primary">Cetak Invoice</button>
                            
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
		});
	</script>
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/munawarahmad/Documents/Applications/projectku/frontend/resources/views/invoice/hasil.blade.php ENDPATH**/ ?>