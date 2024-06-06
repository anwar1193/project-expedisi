<?php $__env->startSection('title'); ?>Invoice
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	
	<div class="container invoice">
	    <div class="row">
	        <div class="col-sm-12">
	            <div class="card">
	                <div class="card-body">
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
	                                        <p>Jakarta, 30 Mei 2024</p>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                        <!-- End InvoiceTop-->
	                        <div class="row invo-profile py-2 my-2" style="border: 0.5px solid; width: 70%">
	                            <div class="col-xl-8">
	                                <div class="text-xl-start" id="project">
                                        <div class="row d-flex py-1 text-start justify-content-start">
                                            <div class="col-4 col-lg-3">Invoice No</div>
                                            <div class="col-1 col-lg-2">:</div>
                                            <div class="col-6 col-lg-4 text-capitalize">033/INV /LP/IV/2024</div>
                                        </div>
                                        <div class="row d-flex py-1 text-start justify-content-start">
                                            <div class="col-4 col-lg-3">Customer Name</div>
                                            <div class="col-1 col-lg-2">:</div>
                                            <div class="col-6 col-lg-4 text-capitalize">PT. Dion Farma Abadi</div>
                                        </div>
                                        <div class="row d-flex py-1 text-start justify-content-start">
                                            <div class="col-4 col-lg-3">Address</div>
                                            <div class="col-1 col-lg-2">:</div>
                                            <div class="col-6 col-lg-4 text-capitalize">Jl. Malengkeri Raya</div>
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
	                                <table class="table table-bordered table-striped">
	                                    <thead class="text-center">
											<tr>
												<th style="border: 1px solid">No</th>
												<th style="border: 1px solid">No STT</th>
												<th style="border: 1px solid">Tanggal</th>
												<th style="border: 1px solid">Pengirim</th>
												<th style="border: 1px solid">Penerima</th>
												<th style="border: 1px solid">Tujuan</th>
												<th style="border: 1px solid">Jumlah Pembayaran</th>
											</tr>
										</thead>
										<tbody style="font-size: 14px">
											<tr>
												<td style="border: 1px solid; padding: 5px; text-align: center">1</td>
												<td style="border: 1px solid; padding: 5px; text-align: center">11LP1714021194290</td>
												<td style="border: 1px solid; padding: 5px; text-align: center">2024-04-25 11:59:53 +0000 +0000</td>
												<td style="border: 1px solid; padding: 5px; text-align: center">APOTIK MEDICASTORE/ DION FARMA ABADI</td>
												<td style="border: 1px solid; padding: 5px; text-align: center">DR ROMMY WIJAYA</td>
												<td style="border: 1px solid; padding: 5px; text-align: center">DULOMO SELATAN, KOTA UTARA, GORONTALO</td>
												<td style="border: 1px solid; padding: 5px; text-align: center">62,000</td>
											</tr>
											<tr>
												<td style="border: 1px solid; padding: 5px; text-align: center">2</td>
												<td style="border: 1px solid; padding: 5px; text-align: center">11LP1714020999725</td>
												<td style="border: 1px solid; padding: 5px; text-align: center">2024-04-25 11:58:24 +0000 +0000</td>
												<td style="border: 1px solid; padding: 5px; text-align: center">APOTIK MEDICASTORE/ DION FARMA ABADI</td>
												<td style="border: 1px solid; padding: 5px; text-align: center">DR ASRIANI</td>
												<td style="border: 1px solid; padding: 5px; text-align: center">DR ASRIANI</td>
												<td style="border: 1px solid; padding: 5px; text-align: center">39,000</td>
											</tr>
											<tr>
												<td style="border: 1px solid; padding: 5px; text-align: center">3</td>
												<td style="border: 1px solid; padding: 5px; text-align: center">11LP1714020999725</td>
												<td style="border: 1px solid; padding: 5px; text-align: center">2024-04-25 11:59:53 +0000 +0000</td>
												<td style="border: 1px solid; padding: 5px; text-align: center">APOTIK MEDICASTORE/ DION FARMA ABADI</td>
												<td style="border: 1px solid; padding: 5px; text-align: center">dr shinta n barnas</td>
												<td style="border: 1px solid; padding: 5px; text-align: center">POASIA, KENDARI</td>
												<td style="border: 1px solid; padding: 5px; text-align: center">67,000</td>
											</tr>
										</tbody>
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
	                        <a href="<?php echo e(route('invoice.export-pdf')); ?>" class="btn btn btn-primary me-2">Cetak Invoice</a>
	                        <a href="<?php echo e(route('bukti-terima.export-pdf')); ?>" class="btn btn btn-primary me-2">Cetak Bukti Terima</a>
	                    </div>
                    </div>
	            </div>
	        </div>
	    </div>
	</div>
	
	<?php $__env->startPush('scripts'); ?>
	<script src="<?php echo e(asset('assets/js/counter/jquery.waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/counter/jquery.counterup.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/counter/counter-custom.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/print.js')); ?>"></script>
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/munawarahmad/Documents/Applications/projectku/frontend/resources/views/invoice/index.blade.php ENDPATH**/ ?>