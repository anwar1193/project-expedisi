<?php $__env->startSection('title'); ?>Detail Pemantauan Kamera
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Detail Pemantauan Kamera</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item active">Pemanatauan Kamera</li>
		<li class="breadcrumb-item active">Detail</li>
	<?php echo $__env->renderComponent(); ?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-12 col-xl-6">
				<div class="card">
					<div class="card-header b-b-info">
						<h5>Front Camera</h5>
					</div>
					<div class="card-body text-center">
						<video width="500" height="200" autoplay="true" id="videoElement1">
						</video>   
						<canvas id="canvas" style="display:none;"></canvas>            
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center">
                            <div class="bg-secondary rounded-pill mx-2 px-2">
                                <a href="<?php echo e(route('pemantauan-camera.front', $item->id)); ?>" class="text-light"><i class="fa fa-folder" title="Daftar Image"></i></a> 
                            </div>
                            <div class="bg-secondary rounded-pill mx-2 px-2">
                                <a href="#" id="capture1" class="text-light"><i class="fa fa-camera" title="Take Image"></i></a>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
			<div class="col-sm-12 col-xl-6">
				<div class="card">
					<div class="card-header b-b-info">
						<h5>Rear Camera</h5>
					</div>
					<div class="card-body text-center">
						<video width="500" height="200" autoplay="true" id="videoElement2">
						</video>        
						<canvas id="canvas2" style="display:none;"></canvas>            
					</div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-center">
                            <div class="bg-secondary rounded-pill mx-2 px-2">
                                <a href="<?php echo e(route('pemantauan-camera.rear', $item->id)); ?>" class="text-light"><i class="fa fa-folder"></i></a> 
                            </div>
                            <div class="bg-secondary rounded-pill mx-2 px-2">
                                <a href="#" id="capture2" class="text-light"><i class="fa fa-camera"></i></a>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>

<?php $__env->startPush('scripts'); ?> 
	<script src="<?php echo e(asset('assets/js/take-video.js')); ?>"></script>
	<script>
		captureButton1.addEventListener('click', function() {
        var imgData1 = takeSnapshot(video1, canvas);

        fetch('<?php echo e(route('store.front-camera')); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            body: JSON.stringify({id: `<?php echo e($item->id); ?>`, image: imgData1 })
        })
        .then(response => response.json())
        .then(data => window.location.reload())
        .catch((error) => {
            console.error('Error:', error);
        });
    });
    
    captureButton2.addEventListener('click', function() {
        var imgData2 = takeSnapshot(video2, canvas2);

        fetch('<?php echo e(route('store.rear-camera')); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
            },
            body: JSON.stringify({id: `<?php echo e($item->id); ?>`, image: imgData2 })
        })
        .then(response => response.json())
        .then(data => window.location.reload())
        .catch((error) => {
            console.error('Error:', error);
        });
    });
	</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/apps/paket1/frontend/resources/views/pemantauan-camera/detail.blade.php ENDPATH**/ ?>