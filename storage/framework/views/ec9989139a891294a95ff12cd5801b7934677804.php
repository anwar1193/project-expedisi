<?php $__env->startSection('title'); ?> Lokasi Surveilance Car
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/leaflet/leaflet.css')); ?>" />
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php $__env->startComponent('components.breadcrumb'); ?>
<?php $__env->slot('breadcrumb_title'); ?>
<h3>Lokasi Surveilance Car</h3>
<?php $__env->endSlot(); ?>
<li class="breadcrumb-item active">Pemantauan GPS</li>
<?php echo $__env->renderComponent(); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div id="layerControl" style="height: 550px"></div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('assets/js/datatable/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/datatable/datatables/datatable.custom.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/leaflet/leaflet.js')); ?>"></script>
<script>

const assetsPath = '<?php echo e(asset('assets/vendor/leaflet/images/')); ?>';

var redIcon = new L.Icon({
	iconUrl: assetsPath + '/marker-icon-2x-red.png',
    shadowUrl: assetsPath + '/marker-shadow.png',
	iconSize: [25, 41],
	iconAnchor: [12, 41],
	popupAnchor: [1, -34],
	shadowSize: [41, 41]
});

var greenIcon = new L.Icon({
	iconUrl: assetsPath + '/marker-icon-2x-grey.png',
    shadowUrl: assetsPath + '/marker-shadow.png',
	iconSize: [25, 41],
	iconAnchor: [12, 41],
	popupAnchor: [1, -34],
	shadowSize: [41, 41]
});

var blueIcon = new L.Icon({
	iconUrl: assetsPath + '/marker-icon-2x-blue.png',
    shadowUrl: assetsPath + '/marker-shadow.png',
	iconSize: [25, 41],
	iconAnchor: [12, 41],
	popupAnchor: [1, -34],
	shadowSize: [41, 41]
});

const layerControlVar = document.getElementById('layerControl');
if (layerControlVar) {
  const jakarta = L.marker([-6.2088, 106.8456], {icon: greenIcon}).bindPopup('<b>Innova Reborn (B 7890 SHU)</b>').openPopup();
  const depok = L.marker([-6.4025, 106.7942], {icon: redIcon}).bindPopup('<b>Toyota Hiace (B 8902 HJF)</b>').openPopup();
  const tangerang = L.marker([-6.1788, 106.6319], {icon: blueIcon}).bindPopup('<b>Honda (B 217 AN)</b>').openPopup();

  const cities = L.layerGroup([jakarta, depok, tangerang]);

  const street = L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>',
    maxZoom: 18
  });

  const watercolor = L.tileLayer('http://tile.stamen.com/watercolor/{z}/{x}/{y}.jpg', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>',
    maxZoom: 18
  });

  const layerControl = L.map('layerControl', {
    center: [-6.2088, 106.8456],
    zoom: 10,
    layers: [street, cities]
  });

  const baseMaps = {
    Street: street,
    Watercolor: watercolor
  };

  const overlayMaps = {
    Cities: cities
  };

  L.tileLayer('https://c.tile.osm.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>',
    maxZoom: 18
  }).addTo(layerControl);
}

</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /www/apps/paket1/frontend/resources/views/monitoring/pemantauan-gps.blade.php ENDPATH**/ ?>