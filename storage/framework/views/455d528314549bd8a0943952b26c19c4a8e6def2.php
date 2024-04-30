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
        <h2>Data Log Aktifitas</h2>
        <em>Dicetak Pada : <?php echo e($waktu_cetak); ?></em>
    </div>
    
    <table id="emp" style="margin-top:20px">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Log Time</th>
                <th>Activity</th>
                <th>IP Address</th>
                <th>Browser</th>
            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $log_activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr style="font-size: 10px">
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($row->username); ?></td>
                    <td><?php echo e($row->log_time); ?></td>
                    <td><?php echo e($row->activity); ?></td>
                    <td><?php echo e($row->ip_address); ?></td>
                    <td><?php echo e($row->browser); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html><?php /**PATH /www/apps/paket1/frontend/resources/views/log-activities/pdf.blade.php ENDPATH**/ ?>