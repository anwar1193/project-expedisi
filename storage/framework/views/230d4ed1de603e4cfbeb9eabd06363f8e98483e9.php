<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="viho admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities. laravel/framework: ^8.40">
    <meta name="keywords" content="admin template, viho admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <title>Invoice <?php echo e($title); ?></title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 8px
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        footer {
            position: flex;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: center;
            padding: 10px 0px;
            line-height: 0.6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .table-header h4, .table-header p, .table-header h3 {
            margin: 0;
        }

        .table-header {
            text-align: start;
        }

        .table-header h3 {
            text-align: end;
        }

        .table-header p {
            text-align: end;
        }

        p {
            font-size: 14px
        }

    </style>
    <!-- Google font-->
  </head>
  <body>
    <div style="margin-bottom: 20px">
        <div style="padding-bottom: 50px; page-break-before: auto">
            <div>
                <table>
                    <tbody>
                        <tr>
                            <td class="table-header">
                                <img src="<?php echo e($picture); ?>" alt="Lion Parcel" style="width: 150px; height: 60px;" />
                                <h3 style="color: red; padding-right: 10px; font-weight: bold">D Angel Express</h3>
                            </td>
                            <td style="text-align: center; font-weight: bold"><h2>Invoice</h2></td>
                            <td style="display: flex; align-items: flex-end; padding-top: 45px; text-align: center;"><p>Makassar, <?php echo e(formatTanggalIndonesia($customer->created_at)); ?></p></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div style="border: 1px solid black; width: 70%">
                <table style="padding: 10px 0px 0px 10px; font-size: 14px">
                    <tbody>
                        <tr>
                            <td>Invoice No</td>
                            <td>:</td>
                            <td><?php echo e($customer->invoice_no); ?></td>
                        </tr>
                        <tr>
                            <td>Customer Name</td>
                            <td>:</td>
                            <td><?php echo e($customer->nama); ?></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td><?php echo e($customer->alamat); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <p><small>Biaya Pengiriman</small>  <?php echo e($customer->nama); ?> RUPIAH</p>
            </div>
            <div>
                <div>
                    <table id="data" style="border: 1px solid; width: 100%">
                        <thead>
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
                            <?php $__empty_1 = true; $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td style="border: 1px solid; padding: 5px; text-align: center"><?php echo e($loop->iteration); ?></td>
                                    <td style="border: 1px solid; padding: 5px; text-align: center"><?php echo e($data->no_resi); ?></td>
                                    <td style="border: 1px solid; padding: 5px; text-align: center"><?php echo e($data->created_at); ?></td>
                                    <td style="border: 1px solid; padding: 5px; text-align: center"><?php echo e($data->nama_pengirim); ?></td>
                                    <td style="border: 1px solid; padding: 5px; text-align: center"><?php echo e($data->nama_penerima); ?></td>
                                    <td style="border: 1px solid; padding: 5px; text-align: center"><?php echo e($data->kota_tujuan); ?></td>
                                    <td style="border: 1px solid; padding: 5px; text-align: center">Rp <?php echo e(number_format($data->ongkir, 0, '.', '.')); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <p class="fw-semibold">Belum Ada Data Transaksi</p>
                                    </td>
                                </tr>
                            <?php endif; ?> 
                        </tbody>
                        <?php if($notEmpty): ?>
                            <tfoot>
                                <tr>
                                    <td style="border: 1px solid; text-align: center"></td>
                                    <td colspan="5" style="border: 1px solid; text-align: center">
                                        <p class="fw-semibold">Sub Total</p>
                                    </td>
                                    <td style="border: 1px solid; text-align: center">
                                        Rp <?php echo e(number_format($total->total, 0, '.', '.')); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid; text-align: center"></td>
                                    <td colspan="5" style="border: 1px solid; text-align: center">
                                        <p class="fw-semibold">Diskon</p>
                                    </td>
                                    <td style="border: 1px solid; text-align: center">
                                        Rp <?php echo e(number_format($customer->diskon, 0, '.', '.')); ?>

                                    </td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid; text-align: center"></td>
                                    <td colspan="5" style="border: 1px solid; text-align: center">
                                        <p class="fw-semibold">Total</p>
                                    </td>
                                    <td style="border: 1px solid; text-align: center">
                                        Rp <?php echo e(number_format($total->total - $customer->diskon, 0, '.', '.')); ?>

                                    </td>
                                </tr>
                            </tfoot>
                        <?php endif; ?>
                    </table>
                </div>
                <div style="margin-top: -5px">
                    <h5>Total Terbilang: <?php echo e(terbilang($total->total)); ?> RUPIAH</h5>
                </div>
                <div style="margin-top: -25px">
                    <p>Note:</p>
                    <ol style="font-size: 14px">
                        <li>Detail STT (Surat Tanda Terima) / Resi bisa di lihat pada STT yang terlampir dengan INVOICE ini</li>
                        <li>Invoice ini di anggap sah jika ada Stempel Lion Parcel D Angel Express pada invoice dan STT terlampir</li>
                    </ol>
                </div>
                <div style="margin-top: -5px">
                    <p>Pembayaran paling lambat 5 hari setelah invoice di terima</p>
                </div>
                <div style="margin-top: -5px">
                    <p>Pembayaran dapat di transfer ke rekening :</p>
                    <div style="width: 70% ; margin-left:30px;">
                        <table style="padding: 10px 0px 0px 10px; font-size: 14px">
                            <tbody>
                                <tr>
                                    <td>Bank</td>
                                    <td>:</td>
                                    <td>BCA (Bank Central Asia)</td>
                                </tr>
                                <tr>
                                    <td>Cabang</td>
                                    <td>:</td>
                                    <td>KCP Ratulangi Makassar</td>
                                </tr>
                                <tr>
                                    <td>No Rekening</td>
                                    <td>:</td>
                                    <td>7325001488</td>
                                </tr>
                                <tr>
                                    <td>Atas Nama</td>
                                    <td>:</td>
                                    <td>Gerry Stefanus Sidharta</td>
                                </tr>
                            </tbody>
                        </table>
                        <table style="padding: 10px 0px 0px 10px; font-size: 14px">
                            <tbody>
                                <tr>
                                    <td>Bank</td>
                                    <td>:</td>
                                    <td>Mandiri</td>
                                </tr>
                                <tr>
                                    <td>Cabang</td>
                                    <td>:</td>
                                    <td>Makassar</td>
                                </tr>
                                <tr>
                                    <td>No Rekening</td>
                                    <td>:</td>
                                    <td>1520012846164</td>
                                </tr>
                                <tr>
                                    <td>Atas Nama</td>
                                    <td>:</td>
                                    <td>Gerry Stefanus Sidharta</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div>
                        <p>Bukti pembayaran dapat di kirim ke :</p>
                        <table style="margin-top: -5px">
                            <tbody style="line-height: 0.1">
                                <tr>
                                    <td>
                                        <ul>
                                            <li>Melalui Email</li>
                                        </ul>
                                    </td>
                                    <td>:</td>
                                    <td>dangelexpress@gmail.com</td>
                                </tr>
                                <tr>
                                    <td>
                                        <ul>
                                            <li>Melalui WA</li>
                                        </ul>
                                    </td>
                                    <td>:</td>
                                    <td>082196916859</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div style="display: flex; justify-content: flex-end;">
                        <table>
                            <thead>
                                <tr>
                                    <th width="70%"></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody style="text-align: center">
                                <tr>
                                    <td></td>
                                    <td>
                                        Dengan Hormat,
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td><br><br></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        Gerry Stefanus Sidharta
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer style="display: flex; justify-content: center; text-align: center; line-height: 0.6;>
        <p style="text-transform: uppercase">Lion parcel - D Angel Express</p>
        <p style="text-transform: capitalize">Jl. Onta Baru no 51, Kelurahan Mandala, Kecamatan Mamajang, Kota Makassar – 90135</p>
        <p style="text-transform: capitalize">Sulawesi Selatan</p>
        <p style="text-transform: capitalize">Telp : 0411 – 8918311 , 082110071565</p>
        <p>Website : http://lionparcel.com/</p>
    </footer>
</body>
</html><?php /**PATH /Users/munawarahmad/Documents/Applications/projectku/frontend/resources/views/invoice/hasil-pdf.blade.php ENDPATH**/ ?>