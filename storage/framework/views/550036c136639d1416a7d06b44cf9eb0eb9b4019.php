<?php $__env->startSection('title'); ?>Data Pengiriman
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
                    <div class="card-header">
                        <h5>Silahkan Periksa Data Yang Diimport Terlebih Dahulu</h5>
                    </div>
                    <form method="POST" action="<?php echo e(route('data-pengiriman.proses-konfimasi-excel')); ?>">
                        <?php echo csrf_field(); ?>
                        <div class="card-body">
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

                            
                            <div class="table-responsive">
                                <p class="mb-4">Jika Sudah Sesuai Silahkan Klik Simpan</p>
                                <table class="display" id="basic-1">
                                    <thead>
                                        <tr>
                                            <th>No Resi</th>
                                            <th>Tgl Transaksi</th>
                                            <th>Kode Customer</th>
                                            <th>Nama Pengirim</th>
                                            <th>Nama Penerima</th>
                                            <th>Kota Tujuan</th>
                                            <th>No HP Pengirim</th>
                                            <th>No HP Penerima</th>
                                            <th>Berat Barang</th>
                                            <th>Ongkir</th>
                                            <th>Komisi</th>
                                            <th>Metode Pembayaran</th>
                                            <th>Bank</th>
                                            <th>Bukti Pembayaran</th>
                                            <th>Jenis Pengiriman</th>
                                            <th>Bawa Sendiri</th>
                                            <th>Status Pengiriman</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $formattedData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <input type="text" name="no_resi[]" value="<?php echo e($row['no_resi']); ?>">
                                                </td>
                                                <td>
                                                    <input type="date" name="tgl_transaksi[]" value="<?php echo e($row['tgl_transaksi']); ?>">
                                                </td>
                                                <td>
                                                    <select name="kode_customer[]" class="form-control <?php $__errorArgs = ['kode_customer'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                        <option value="general" <?php echo e($row['kode_customer'] == 'general' ? 'selected' : ''); ?>> General </option>
                                                        <?php $__currentLoopData = $customer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <option value="<?php echo e($item->kode_customer); ?>" <?php echo e($row['kode_customer']== $item->kode_customer ? 'selected' : ''); ?>>
                                                                <?php echo e($item->kode_customer); ?>

                                                            </option>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="nama_pengirim[]" value="<?php echo e($row['nama_pengirim']); ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="nama_penerima[]" value="<?php echo e($row['nama_penerima']); ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="kota_tujuan[]" value="<?php echo e($row['kota_tujuan']); ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="no_hp_pengirim[]" value="<?php echo e($row['no_hp_pengirim']); ?>">
                                                </td>
                                                <td>
                                                    <input type="text" name="no_hp_penerima[]" value="<?php echo e($row['no_hp_penerima']); ?>">
                                                </td>
                                                <td>
                                                    <input type="number" name="berat_barang[]" value="<?php echo e($row['berat_barang']); ?>">
                                                </td>
                                                <td>
                                                    <input type="number" name="ongkir[]" value="<?php echo e($row['ongkir']); ?>">
                                                </td>
                                                <td>
                                                    <input type="number" name="komisi[]" value="<?php echo e($row['komisi']); ?>">
                                                </td>
                                                <td>
                                                    <select name="metode_pembayaran[]" class="form-control <?php $__errorArgs = ['metode_pembayaran'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                        <option value="Transfer" <?php echo e($row['metode_pembayaran'] == 'Transfer' ? 'selected' : ''); ?>> Transfer </option>
                                                        <option value="Tunai" <?php echo e($row['metode_pembayaran'] == 'Tunai' ? 'selected' : ''); ?>> Tunai </option>
                                                        <option value="Kredit" <?php echo e($row['metode_pembayaran'] == 'Kredit' ? 'selected' : ''); ?>> Kredit </option>
                                                    </select>
                                                </td>
                                                <td>
                                                        <select name="bank[]" class="form-control <?php $__errorArgs = ['bank'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                            <?php if($row['metode_pembayaran'] != 'Transfer'): ?>
                                                                <option value="">-</option>
                                                            <?php else: ?>
                                                                <?php $__currentLoopData = $bank; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($item->bank); ?>" <?php echo e($row['bank']== $item->bank ? 'selected' : ''); ?>>
                                                                        <?php echo e($item->bank); ?>

                                                                    </option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>
                                                        </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="bukti_pembayaran[]" value="<?php echo e($row['bukti_pembayaran']); ?>" <?php echo e($row['metode_pembayaran'] != 'Transfer' ? 'readonly' : ''); ?>> 
                                                </td>
                                                <td>
                                                    <input type="text" name="jenis_pengiriman[]" value="<?php echo e($row['jenis_pengiriman']); ?>"> 
                                                </td>
                                                <td>
                                                    <select name="bawa_sendiri[]" class="form-control <?php $__errorArgs = ['metode_pembayaran'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                                        <option value="Ya" <?php echo e($row['bawa_sendiri'] == 'Ya' ? 'selected' : ''); ?>> Ya </option>
                                                        <option value="Di jemput" <?php echo e($row['bawa_sendiri'] == 'Di jemput' ? 'selected' : ''); ?>> Di jemput </option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="text" name="status_pengiriman[]" value="<?php echo e($row['status_pengiriman']); ?>"> 
                                                </td>
                                                <td>
                                                    <input type="text" name="keterangan[]" value="<?php echo e($row['keterangan']); ?>"> 
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                
                            </div>

                        </div>
                        <div class="card-footer float-end">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                            <a class="btn btn-warning" href="<?php echo e(route('data-pengiriman')); ?>">Kembali</a>
                        </div>
                    </form>
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
                searching: false,
			});
		})
	</script>	
	<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/data-pengiriman/konfirmasi-data.blade.php ENDPATH**/ ?>