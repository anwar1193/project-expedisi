<?php $__env->startSection('title'); ?>Front Camera
 <?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('components.breadcrumb'); ?>
		<?php $__env->slot('breadcrumb_title'); ?>
			<h3>Front Kamera</h3>
		<?php $__env->endSlot(); ?>
		<li class="breadcrumb-item active">Pemanatauan Kamera</li>
		<li class="breadcrumb-item active">Front</li>
	<?php echo $__env->renderComponent(); ?>

	<div class="container-fluid">
		<div class="row">
			<?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div class="col-sm-12 col-xl-4">
					<div class="card">
						<div class="card-header fw-bolder"><?php echo e($data->merk); ?> (<?php echo e($data->nopol); ?>)</div>
						<div class="card-body text-center">
							<video width="250" height="200" autoplay="true" id="videoElement<?php echo e($data->id); ?>">
							</video>
						</div>
					</div>
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	</div>

<?php $__env->startPush('scripts'); ?> 
    <script>
        const cars = <?php echo json_encode($items); ?>;

		cars.forEach(data => {
			const videoId = `videoElement${data.id}`;
			const video = document.querySelector(`#${videoId}`);
			
			if (video) {
				if (navigator.mediaDevices.getUserMedia) {
					navigator.mediaDevices.getUserMedia({ video: true })
						.then(function (stream) {
							video.srcObject = stream;
						})
						.catch(function (error) {
							console.log("Something went wrong!", error);
						});
				} else {
					console.log("getUserMedia not supported on your browser!");
				}
			} else {
				console.log(`Video element with id ${videoId} not found!`);
			}
		});
    </script>

<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/apps/paket1/frontend/resources/views/pemantauan-camera/front-camera.blade.php ENDPATH**/ ?>