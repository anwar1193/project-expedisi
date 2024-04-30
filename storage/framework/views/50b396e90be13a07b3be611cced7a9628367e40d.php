<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e($title); ?></title>

    <style>
        #emp{
            font-family: Arial, Helvetica, sans-serif;
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
        <h2>Data Surveilance Car</h2>
        <em>Dicetak Pada : <?php echo e($waktu_cetak); ?></em>
    </div>
    
    <table id="emp" style="margin-top:20px">
        <thead>
            <tr>
                <th>No</th>
                <th>Nopol</th>
                <th>Warna</th>
                <th>Merk</th>
                <th>Kapasitas</th>
                <th>Transmisi</th>
                <th>Bahan Bakar</th>
                <th>Status</th>
                <th>Kondisi</th>
            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $surveilance_cars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($row->nopol); ?></td>
                    <td><?php echo e($row->warna); ?></td>
                    <td><?php echo e($row->merk); ?></td>
                    <td><?php echo e($row->kapasitas); ?></td>
                    <td><?php echo e($row->transmisi); ?></td>
                    <td><?php echo e($row->bahan_bakar); ?></td>
                    <td><?php echo e($row->status); ?></td>
                    <td><?php echo e($row->kondisi); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html><?php /**PATH /www/apps/paket1/frontend/resources/views/surveilance-car/pdf.blade.php ENDPATH**/ ?>