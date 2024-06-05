<div class="card-body"></div>
<div class="row ps-3">
    <div class="col">
        <div class="card d-flex justify-content-center">
            <div class="card-header pb-0 text-center">
                <h6 class="card-title mb-0">Masukan Nomor Resi Anda</h6>
                <div class="card-options">
                    <a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a>
                </div>
            </div>
            <div class="card-body text-center">
                <form id="search-form" class="form theme-form" method="GET" action="<?php echo e(route('dashboard.customer')); ?>">
                    <div class="d-flex justify-content-center">
                        <div class="px-2">
                            <input class="col-12 mb-3" type="text" name="no_resi" id="no_resi">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <div id="resi-result" class="card-footer px-5">
                <?php if($data): ?>
                    <div class="mb-3">
                        <h5>Hasil Pencarian</h5>
                    </div>
                    <table class="table mb-3">
                        <tr>
                            <th>No Resi</th>
                            <th class="text-center">:</th>
                            <td><?php echo e($data->no_resi); ?></td>
                        </tr>

                        <tr>
                            <th>Tanggal Transaksi</th>
                            <th class="text-center">:</th>
                            <td><?php echo e(formatTanggalIndonesia($data->tgl_transaksi)); ?></td>
                        </tr>

                        <tr>
                            <th>Pengirim</th>
                            <th class="text-center">:</th>
                            <td><?php echo e($data->nama_pengirim); ?></td>
                        </tr>

                        <tr>
                            <th>Penerima</th>
                            <th class="text-center">:</th>
                            <td><?php echo e($data->nama_penerima); ?></td>
                        </tr>

                        <tr>
                            <th>Status Pengiriman</th>
                            <th class="text-center">:</th>
                            <td><?php echo e($data->status_pengiriman); ?> - <?php echo e($data->keterangan_pengiriman); ?></td>
                        </tr>
                    </table>
                    <div class="text-center my-3">
                        <a href="<?php echo e(route('dashboard.customer')); ?>" class="btn btn-md btn-secondary" title="Reset"><i class="fa fa-refresh"></i> Reset</a>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div><?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/customers/component/resi.blade.php ENDPATH**/ ?>