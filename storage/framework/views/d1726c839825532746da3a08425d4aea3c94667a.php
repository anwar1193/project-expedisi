<?php $__env->startSection('title'); ?> Lokasi Surveilance Car
<?php echo e($title); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/css/datatables.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('assets/vendor/leaflet/leaflet.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('assets/css/legend-map.css')); ?>">
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

function createColoredIcon(nopol, merk, status) {
    return new L.Icon({
        iconUrl: status == 1 ? assetsPath + `/greencar4x4.png` : assetsPath + `/car4x4.png`,
        shadowUrl: assetsPath + '/marker-shadow.png',
        iconSize: [35, 41],
        iconAnchor: [12, 41],
        popupAnchor: [1, -34],
        shadowSize: [41, 41],
        nopol: nopol,
        merk: merk
    });
}

const layerControlVar = document.getElementById('layerControl');
if (layerControlVar) {
    const markersData = <?php echo json_encode($surveilance_cars); ?>;
    const mapsCenter = <?php echo json_encode($maps); ?>;

    const markers = [];
    markersData.forEach(data => {
        let urlDetail = `<?php echo e(route("surveilance-car.detail", "id")); ?>`;
        urlDetail = urlDetail.replace("id", data.id); 
        const popup = `<b>${data.merk}</b>
                    <br><br>
                    <b>Latitude : ${data.lat}</b>
                    <br>
                    <b>Langitude : ${data.lang}</b>
                    <br>
                    <b>Device Address : ${data.device_address}</b>
                    <br>
                    <b>Engine Status: ${data.engine_status == 1 ? "ON" : "OFF"}</b>
                    <br>
                    <b>Durasi Idle: ${data.idle} Menit</b>
                    \<br><br>
                    <a href="${urlDetail}" class="text-decoration-underline">
                        Detail Armada
                    </a>`;

        const marker = L.marker([data.lat, data.lang], { icon: createColoredIcon(data.nopol, data.merk, data.engine_status) })
        .bindPopup(popup);

        marker.bindTooltip(`<b>${data.nopol}</b>`, { permanent: true, direction: "bottom", opacity: 0.85 }).openTooltip();
        markers.push(marker);
    });

    const cities = L.layerGroup(markers);

    const street = L.tileLayer('https://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>',
        maxZoom: 50
    });

    const layerControl = L.map('layerControl', {
        center: [mapsCenter.lat, mapsCenter.lang],
        zoom: 12,
        layers: [street, cities]
    });

    /*Legend specific*/
    var legend = L.control({ position: "bottomright" });

    legend.onAdd = function(map) {
    var div = L.DomUtil.create("div", "legend");
    div.innerHTML += "<h4>Keterangan</h4>";
    div.innerHTML += '<img src="<?php echo e(asset('assets/vendor/leaflet/images/greencar4x4.png')); ?>" alt=""><span>ON</span><br>';
    div.innerHTML += '<img src="<?php echo e(asset('assets/vendor/leaflet/images/car4x4.png')); ?>" alt=""><span>OFF</span><br>';    

    return div;
    };

    legend.addTo(layerControl);
}

</script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/munawarahmad/Documents/Applications/projectku/frontend/resources/views/pemantauan-gps/index.blade.php ENDPATH**/ ?>