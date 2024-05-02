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

        .small{
            font-size: 10px;
        }
    </style>
</head>
<body>
    <div style="text-align: center;">
        <h2>Data User</h2>
        <em>Dicetak Pada : <?php echo e($waktu_cetak); ?></em>
    </div>
    
    <table id="emp" style="margin-top:20px">
        <thead>
            <tr class="small">
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>No Telepon</th>
                <th>Username</th>
            </tr>
        </thead>

        <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="small">
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($row->nama); ?></td>
                    <td><?php echo e($row->email); ?></td>
                    <td><?php echo e($row->nomor_telepon); ?></td>
                    <td><?php echo e($row->username); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html><?php /**PATH /Users/munawarahmad/Documents/Applications/projectku/frontend/resources/views/admin/master/users/pdf.blade.php ENDPATH**/ ?>