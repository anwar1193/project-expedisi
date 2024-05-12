<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Laba/Rugi <?php echo e($title); ?></title>

    <style>
        #emp{
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #emp td, #emp th{
            border: 1px solid #ddd;
            padding: 4px; /* dikurangi dari 8px */
        }

        /* #emp tr:nth-child(even){
            background-color: aqua;
        } */

        #emp th{
            padding-top: 6px; /* dikurangi dari 12px */
            padding-bottom: 6px; /* dikurangi dari 12px */
            text-align: left;
            background-color: aquamarine;
            color: #000;
        }

        .row {
            margin-bottom: 5px; /* dikurangi atau disesuaikan sesuai kebutuhan */
        }
    </style>
</head>
<body>
    <div style="text-align: center;">
        <h2>Laporan Laba Rugi</h2>
        <em>Dicetak Pada : <?php echo e($waktuCetak); ?></em>
    </div>
    
    <div class="row">
        <div class="col">
            <h5>Periode: <?php echo e(\Carbon\Carbon::parse($start)->translatedFormat('d F Y')); ?> s/d <?php echo e(\Carbon\Carbon::parse($end_date)->translatedFormat('d F Y')); ?>  </h5>
            <div class="row">
                <h4>Jumlah Pengiriman : Rp <?php echo e(number_format($jumlah_pengiriman->totalPengiriman, 0, ',', '.') ?? 0); ?> ,-</h4>
            </div>
            <div class="row">
                <h4>Jumlah Pemasukkan : Rp <?php echo e(number_format($jumlah_pemasukkan->totalPemasukan, 0, ',', '.') ?? 0); ?> ,-</h4>
            </div>
            <div class="row">
                <h4>Jumlah Pengeluaran : Rp <?php echo e(number_format($jumlah_pengeluaran->totalPengeluaran, 0, ',', '.') ?? 0); ?> ,-</h4>
            </div>
        </div>
    </div>
</body>
</html>
</html><?php /**PATH /Applications/MAMP/htdocs/project-expedisi/resources/views/laporan/pdf/laba-rugi.blade.php ENDPATH**/ ?>