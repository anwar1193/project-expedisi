<div class="card-body"></div>
<div class="row ps-3 ms-3 py-3 my-3">
    <div class="col-xl-4 col-md-4 col-sm-4 box-col-4 des-xl-25 rate-sec">
        <div class="card shadow-lg" style="width: 18rem; border-radius:15px; background-color: rgb(33, 174, 47)">
            <div class="card-body text-center fw-bold">
              <h5 class="card-title pb-3 text-center fw-bold">Point</h5>
              <h4><i class="icofont icofont-ui-pointer "></i></h4>
              <h3 class="fw-bold"><?php echo e($customer->point); ?></h3>
            </div>
          </div>
      </div>
      <div class="col-xl-4 col-md-4 col-sm-4 box-col-4 des-xl-25 rate-sec">
        <div class="card shadow-lg" style="width: 18rem; border-radius:15px; background-color: rgb(219, 176, 55)">
            <div class="card-body text-center fw-bold">
                <h5 class="card-title pb-3 text-center fw-bold">Limit Kredit</h5>
                <h4><i class="icofont icofont-ui-tag"></i></h4>
                <h3 class="fw-bold"><?php echo e($customer->limit_credit); ?></h3>
              </div>
          </div>
      </div>
      <div class="col-xl-4 col-md-4 col-sm-4 box-col-4 des-xl-25 rate-sec">
        <div class="card shadow-lg" style="width: 18rem; border-radius:15px; background-color: rgb(200, 75, 75)">
            <div class="card-body text-center fw-bold">
                <h5 class="card-title pb-3 text-center fw-bold">Diskon</h5>
                <h4><i class="icofont icofont-sale-discount"></i></h4>
                <h3 class="fw-bold"><?php echo e($customer->diskon); ?></h3>
              </div>
          </div>
      </div>
</div><?php /**PATH /Users/munawarahmad/Documents/Applications/projectku/project-expedisi/resources/views/customers/component/point.blade.php ENDPATH**/ ?>