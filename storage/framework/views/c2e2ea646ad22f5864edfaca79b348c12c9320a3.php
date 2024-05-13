<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Pengiriman | <?php echo e($title); ?></title>

    <style>
        #emp{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10px;
            border-collapse: collapse;
            width: 100%;
        }

        #emp td, #emp th{
            border: 1px solid #ddd;
            padding: 5px;
        }

        /* #emp tr:nth-child(even){
            background-color: aqua;
        } */

        #emp th{
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: aquamarine;
            color: #000;
        }
    </style>
</head>
<body>
    <div style="text-align: center;">
        <h2>Data Pengiriman</h2>
        <em>Dicetak Pada : <?php echo e($waktuCetak); ?></em>
    </div>
    
    <div style="text-align: start">
        <p>Periode: <?php echo e(\Carbon\Carbon::parse($start)->translatedFormat('d F Y')); ?> s/d <?php echo e(\Carbon\Carbon::parse($end_date)->translatedFormat('d F Y')); ?></p>
    </div>
    <table id="emp" style="margin-top:20px">
        <thead>
            <tr>
                <th width="2%">No</th>
                <th>No Resi</th>
                <th>Tanggal Transaksi</th>
                <th>Nama Pengirim</th>
                <th>Nama Penerima</th>
                <th>No HP Pengirim</th>
                <th>No HP Penerima</th>
                <th>Kota Tujuan</th>
                <th>Berat Barang</th>
                <th>Ongkir</th>
                <th>Komisi</th>
                <th>Status Pembayaran</th>
                <th>Metode Pembayaran</th>
                <th>Jenis Pengiriman</th>
                <th>Status Pengiriman</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $pengiriman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($loop->iteration); ?></td>
                <td><?php echo e($item->no_resi); ?></td>
                <td><?php echo e($item->tgl_transaksi); ?></td>
                <td><?php echo e($item->nama_pengirim); ?></td>
                <td><?php echo e($item->nama_penerima); ?></td>
                <td><?php echo e($item->no_hp_pengirim); ?></td>
                <td><?php echo e($item->no_hp_penerima); ?></td>
                <td><?php echo e($item->kota_tujuan); ?></td>
                <td><?php echo e($item->berat_barang); ?></td>
                <td>Rp. <?php echo e(number_format($item->ongkir, 0, ',', '.')); ?></td>
                <td>Rp. <?php echo e(number_format($item->komisi, 0, ',', '.')); ?></td>
                <td><?php echo e($item->status_pembayaran == 1 ? 'Lunas' : 'Pending'); ?></td>
                <td><?php echo e($item->metode_pembayaran); ?></td>
                <td><?php echo e($item->jenis_pengiriman); ?></td>
                <td><?php echo e($item->status_pengiriman); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html><?php /**PATH /Users/munawarahmad/Documents/Applications/projectku/frontend/resources/views/laporan/pdf/table-pengiriman.blade.php ENDPATH**/ ?>