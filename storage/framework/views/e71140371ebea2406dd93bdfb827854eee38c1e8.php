<?php $__env->startSection('title', 'Home'); ?>

<?php $__env->startPush('breadcrumb'); ?>
<li class="breadcrumb-item">Pages</li>
<li class="breadcrumb-item active">Sample Page</li>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/animate.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/chartist.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/date-picker.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/prism.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/vector-map.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/select2.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
<?php echo $__env->yieldContent('breadcrumb-list'); ?>
<!-- Container-fluid starts-->
<div class="container-fluid dashboard-default-sec">
  <div class="row">
    <div class="col-sm-12 col-md-6 col-xl-4 box-col-12">
        <div class="input-group mb-3">
          <div class="d-flex flex-column col-12" role="search">
              <div class="d-flex flex-row">
                  <span class="input-group-text" id="basic-addon1">
                    <i class="fa fa-search"></i>
                  </span>
                  <select class="js-example-basic-single col-sm-12" name="tahun" id="tahun">
                      <?php if(request()->has('tahun')): ?>
                          <option value="<?php echo e(request('tahun')); ?>"><?php echo e(request('tahun')); ?></option>
                      <?php endif; ?>
                      <?php $__currentLoopData = range(date('Y'), 2021); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tahun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <option value="<?php echo e($tahun); ?>"><?php echo e($tahun); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>  
                <?php if((request()->has('tahun')) && (request('tahun') != date('Y'))): ?>
                  <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-md btn-warning"><i class="fa fa-refresh" title="Pencarian Ulang"></i></a>
                <?php endif; ?> 
              </div>
          </div>
        </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-4 col-md-4 col-sm-4 box-col-4 des-xl-25 rate-sec">
      <a href="<?php echo e(route("surveilance-car")); ?>">
        <div class="card income-card card-primary">
          <div class="card-body text-center">
            <p class="fs-6">Jumlah Armada</p>
            <h5><i class="icofont icofont-police-car"></i> <?php echo e($jumlahArmada); ?></h5>
            <div class="parrten">
              <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                y="0px" viewbox="0 0 448.057 448.057" style="enable-background:new 0 0 448.057 448.057;"
                xml:space="preserve">
                <g>
                  <g>
                    <path
                      d="M404.562,7.468c-0.021-0.017-0.041-0.034-0.062-0.051c-13.577-11.314-33.755-9.479-45.069,4.099                                            c-0.017,0.02-0.034,0.041-0.051,0.062l-135.36,162.56L88.66,11.577C77.35-2.031,57.149-3.894,43.54,7.417                                            c-13.608,11.311-15.471,31.512-4.16,45.12l129.6,155.52h-40.96c-17.673,0-32,14.327-32,32s14.327,32,32,32h64v144                                            c0,17.673,14.327,32,32,32c17.673,0,32-14.327,32-32v-180.48l152.64-183.04C419.974,38.96,418.139,18.782,404.562,7.468z">
                    </path>
                  </g>
                </g>
                <g>
                  <g>
                    <path
                      d="M320.02,208.057h-16c-17.673,0-32,14.327-32,32s14.327,32,32,32h16c17.673,0,32-14.327,32-32                                            S337.694,208.057,320.02,208.057z">
                    </path>
                  </g>
                </g>
              </svg>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-xl-4 col-md-4 col-sm-4 box-col-4 des-xl-25 rate-sec">
      <a href="<?php echo e(route("perangkat")); ?>">
        <div class="card income-card card-primary">
          <div class="card-body text-center">
            <p class="fs-6">Jumlah Jammer</p>
            <h5><i class="icofont icofont-ui-rss"></i> <?php echo e($jammer); ?></h5>
            <div class="parrten">
              <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                y="0px" viewbox="0 0 448.057 448.057" style="enable-background:new 0 0 448.057 448.057;"
                xml:space="preserve">
                <g>
                  <g>
                    <path
                      d="M404.562,7.468c-0.021-0.017-0.041-0.034-0.062-0.051c-13.577-11.314-33.755-9.479-45.069,4.099                                            c-0.017,0.02-0.034,0.041-0.051,0.062l-135.36,162.56L88.66,11.577C77.35-2.031,57.149-3.894,43.54,7.417                                            c-13.608,11.311-15.471,31.512-4.16,45.12l129.6,155.52h-40.96c-17.673,0-32,14.327-32,32s14.327,32,32,32h64v144                                            c0,17.673,14.327,32,32,32c17.673,0,32-14.327,32-32v-180.48l152.64-183.04C419.974,38.96,418.139,18.782,404.562,7.468z">
                    </path>
                  </g>
                </g>
                <g>
                  <g>
                    <path
                      d="M320.02,208.057h-16c-17.673,0-32,14.327-32,32s14.327,32,32,32h16c17.673,0,32-14.327,32-32                                            S337.694,208.057,320.02,208.057z">
                    </path>
                  </g>
                </g>
              </svg>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-xl-4 col-md-4 col-sm-4 box-col-4 des-xl-25 rate-sec">
      <a href="<?php echo e(route("perangkat")); ?>">
        <div class="card income-card card-primary">
          <div class="card-body text-center">
            <p class="fs-6">Jumlah Perangkat Lainnya</p>
            <h5><i class="icofont icofont-ui-note"></i> <?php echo e($otherDevice); ?></h5>
            <div class="parrten">
              <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                y="0px" viewbox="0 0 448.057 448.057" style="enable-background:new 0 0 448.057 448.057;"
                xml:space="preserve">
                <g>
                  <g>
                    <path
                      d="M404.562,7.468c-0.021-0.017-0.041-0.034-0.062-0.051c-13.577-11.314-33.755-9.479-45.069,4.099                                            c-0.017,0.02-0.034,0.041-0.051,0.062l-135.36,162.56L88.66,11.577C77.35-2.031,57.149-3.894,43.54,7.417                                            c-13.608,11.311-15.471,31.512-4.16,45.12l129.6,155.52h-40.96c-17.673,0-32,14.327-32,32s14.327,32,32,32h64v144                                            c0,17.673,14.327,32,32,32c17.673,0,32-14.327,32-32v-180.48l152.64-183.04C419.974,38.96,418.139,18.782,404.562,7.468z">
                    </path>
                  </g>
                </g>
                <g>
                  <g>
                    <path
                      d="M320.02,208.057h-16c-17.673,0-32,14.327-32,32s14.327,32,32,32h16c17.673,0,32-14.327,32-32                                            S337.694,208.057,320.02,208.057z">
                    </path>
                  </g>
                </g>
              </svg>
            </div>
          </div>
        </div>
      </a>
    </div>
    <div class="col-xl-12 box-col-12 des-xl-100">
      <div class="row">
        <div class="col-xl-12">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive">
                <h5>Armada (Surveilance Car)</h5>
                <table class="table table-bordernone">
                  <thead>
                    <tr>
                      <th>Nama Armada</th>
                      <th>Akumulasi Jarak Tempuh</th>
                      <th>Lokasi Terkini</th>
                      <th>Detail Armada</th>
                      <th>Riwayat Armada</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $armada; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                      <td><?php echo e($item->merk); ?> (<?php echo e($item->nopol); ?>)</td>
                      <td>
                        <p>12000 KM</p>
                      </td>
                      <td>
                        <a href="<?php echo e(route('dashboard.location', $item->id)); ?>"
                          class="btn btn-outline-info btn-xs px-3 rounded-pill">Lihat</a>
                      </td>
                      <td>
                        <button class="btn btn-outline-info btn-xs px-3 rounded-pill" type="button"
                          data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo e($item->id); ?>">Lihat</button>
                          <?php echo $__env->make('components.modal', ['item' => $item], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                      </td>
                      <td>
                        <a href="<?php echo e(route('dashboard.log', $item->id)); ?>"
                          class="btn btn-outline-info btn-xs px-3 rounded-pill">Lihat</a>
                      </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center"><p class="fw-semibold">Tidak Ada Data</p></td>
                    </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xl-12 box-col-12 des-xl-100">
      <div class="row">
        <div class="col-xl-12 box-col-6 des-xl-50">
          <div class="card">
            <div class="card-header">
              <div class="header-top d-sm-flex align-items-center">
                <h5>Aktivitas Pengguna</h5>
                <div class="center-content">
                  <p>Tahunan</p>
                </div>
              </div>
            </div>
            <div class="card-body p-0">
              <div id="user-activation-dash-2"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <!-- Container-fluid Ends-->
  <?php $__env->startPush('scripts'); ?>
  <script src="<?php echo e(asset('assets/js/chart/chartist/chartist.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/chart/knob/knob.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/chart/knob/knob-chart.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/chart/apex-chart/apex-chart.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/chart/apex-chart/stock-prices.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/prism/prism.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/clipboard/clipboard.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/counter/jquery.waypoints.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/counter/jquery.counterup.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/counter/counter-custom.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/custom-card/custom-card.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/notify/index.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/datepicker/date-picker/datepicker.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/datepicker/date-picker/datepicker.en.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/datepicker/date-picker/datepicker.custom.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/select2/select2.full.min.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/select2/select2-custom.js')); ?>"></script>
  <script src="<?php echo e(asset('assets/js/contacts/custom.js')); ?>"></script>

  <script>
    <?php
        $bulanIndonesia = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
    ?>

    var data = [];
    <?php $__currentLoopData = $aktifitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $jumlah): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        data.push({
            x: "<?php echo e($bulanIndonesia[$index]); ?>",
            y: "<?php echo e($jumlah); ?>"
        });
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    var options55 = {
      series: [{
          name: "Jumlah Pengguna Login",
          data: data
      }],
      chart: {
          height: 250,
          type: "bar",
          toolbar: {
              show: false,
          },
      },
      plotOptions: {
          bar: {
              horizontal: false,
              columnWidth: "10%",
              startingShape: "rounded",
              endingShape: "rounded",
              colors: {
                  backgroundBarColors: ["#e5edef"],
                  backgroundBarOpacity: 1,
                  backgroundBarRadius: 9
              }
          },
      },
      stroke: {
          show: false,
      },
      dataLabels: {
          enabled: false
      },
      fill: {
          opacity: 1
      },
      xaxis: {
          // type: "datetime",
          axisBorder: {
              show: false
          },
          labels: {
              show: true,
          },
          axisTicks: {
              show: false,
          },
      },
      yaxis: {
          labels: {
              show: false,
          }
      },
      colors: [vihoAdminConfig.primary]
    };
    var chart55 = new ApexCharts(document.querySelector("#user-activation-dash-2"), options55);
    chart55.render();

    const currentYear = new Date().getFullYear();
    let anchorYear = 2023;
    for (anchorYear; anchorYear <= currentYear; anchorYear++) {
        $("#searchInput").append(`<option value="${anchorYear}">${anchorYear}</option>`);
    }
    $("#searchInput").prepend("<option disabled selected> -- Pilih Tahun -- </option>");

    $(document).ready(function() {
        $('#tahun').change(function(event) {
            event.preventDefault(); 
            
            var selectedYear = $(this).val();
            
            window.location.href = "<?php echo e(route('dashboard')); ?>?tahun=" + selectedYear;
        });
    });

  </script>
  <?php $__env->stopPush(); ?>
  <?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/apps/paket1/frontend/resources/views/admin/dashboard/default.blade.php ENDPATH**/ ?>