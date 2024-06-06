<div class="card-body">
    <div class="row"></div>
    <div class="table-responsive">
        <table class="display" id="basic-1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Resi</th>
                    <th>Nama Penerima</th>
                    <th>Kota Tujuan</th>
                    <th>Metode Pembayaran</th>
                    <th>Status Pembayaran</th>
                    <th>Status Pengiriman</th>
                    
                    <?php if(Session::get('user_level') == 2): ?>
                        <th>Pilih</th>
                    <?php endif; ?>
                    
                    <th width="35%" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                
                <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

                        <td>
                            <span class="badge badge-danger">
                                <?php echo e($data->no_resi); ?>

                            </span>
                        </td>

                        <td><?php echo e($data->nama_penerima); ?></td>
                        <td><?php echo e($data->kota_tujuan); ?></td>
                        
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

                        <?php if(Session::get('user_level') == 2): ?>
                            
                            <td class="text-center">
                                <input type="checkbox" value="5" name="id_pengiriman[]" id="flexCheckDefault" onclick="ceklis(<?php echo e($data->id); ?>)">
                            </td>
                        <?php endif; ?>
                        

                        <td class="text-center">

                            

                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modalDataPengiriman<?php echo e($data->id); ?>" title="Detail Data"><span><i data-feather="eye"></i> Detail</span></a>
                                    </div>
                                </div>
                            </div>
                            <?php echo $__env->make('customers.component.detail-tagihan', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
            </tbody>
        </table>
        
    </div>
</div><?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/customers/component/tagihan.blade.php ENDPATH**/ ?>