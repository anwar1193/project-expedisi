<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Data Pengeluaran | <?php echo e($title); ?></title>

    <style>
        #emp{
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            border-collapse: collapse;
            width: 100%;
        }

        #emp td, #emp th{
            border: 1px solid #ddd;
            padding: 8px;
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
        <h2>Data Pengeluaran</h2>
        <em>Dicetak Pada : <?php echo e($waktuCetak); ?></em>
    </div>

    <div style="text-align: start">
        <p>Periode: <?php echo e(\Carbon\Carbon::parse($start)->translatedFormat('d F Y')); ?> s/d <?php echo e(\Carbon\Carbon::parse($end_date)->translatedFormat('d F Y')); ?></p>
    </div>
    
    <table id="emp" style="margin-top:20px">
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Pengeluaran</th>
                <th>Keterangan</th>
                <th>Jumlah Pembayaran</th>
                <th>Yang Melakukan Pembayaran</th>
                <th>Yang Menerima Pembayaran</th>
                <th>Metode Pembayaran</th>
                <th>Status Pengeluaran</th>
                <th>Jenis Pengeluaran</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $pengeluaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($loop->iteration); ?></td>
                <td><?php echo e($item->tgl_pengeluaran); ?></td>
                <td><?php echo e($item->keterangan); ?></td>
                <td>Rp <?php echo e(number_format($item->jumlah_pembayaran, 0, ',', '.')); ?></td>
                <td><?php echo e($item->yang_membayar); ?></td>
                <td><?php echo e($item->yang_menerima); ?></td>
                <td><?php echo e($item->metode_pembayaran); ?></td>
                <td><?php echo e($item->status_pengeluaran == 1 ? 'Disetujui' : 'Pending'); ?></td>
                <td><?php echo e($item->jenis_pengeluaran); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html><?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/laporan/pdf/table-pengeluaran.blade.php ENDPATH**/ ?>