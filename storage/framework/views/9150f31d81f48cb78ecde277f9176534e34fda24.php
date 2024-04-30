<?php $__env->startSection('title'); ?> Lokasi Terkini
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/leaflet/leaflet.css')); ?>" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Lokasi Terkini</h3>
<?php $__env->endSlot(); ?>
<li class="breadcrumb-item active">Dashboard</li>
<li class="breadcrumb-item active">Lokasi Terkini</li>
<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex"><h5><?php echo e($item->merk); ?> (<?php echo e($item->nopol); ?>) </h5></div>
                </div>
                <div class="card-body">
                    <div class="leaflet-map mb-4" id="dragMap"></div>
                    <div class="d-flex justify-content-end"><a href="<?php echo e(route('dashboard')); ?>" class="btn btn-light">Kembali</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatables/datatable.custom.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/leaflet/leaflet.js')); ?>"></script>
<script>
    const dragMapVar = document.getElementById('dragMap');
    if (dragMapVar) {
        const armada = <?php echo json_encode($item); ?>;
        const draggableMap = L.map('dragMap').setView([armada.lat, armada.lang], 12);

        const customIcon = L.divIcon({
            className: 'custom-icon-class',
            html: '<div class="fs-3 fw-bold"><i class="icofont icofont-police-car"></i></div>', 
            iconSize: [60, 50],
            iconAnchor: [16, 32], 
            popupAnchor: [0, -32] 
        });

        const markerLocation = L.marker([armada.lat, armada.lang], {
            // draggable: true,
            // icon: customIcon 
        }).addTo(draggableMap);

        markerLocation.bindPopup(`<b>Latitude : ${armada.lat} <br /> Langitude : ${armada.lang}</b>`);

        L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>',
            maxZoom: 18
        }).addTo(draggableMap);
    }

</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/apps/paket1/frontend/resources/views/admin/dashboard/action/location.blade.php ENDPATH**/ ?>