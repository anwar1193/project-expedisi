@extends('layouts.admin.master')

@section('title') Lokasi Terkini
{{ $title }}
@endsection

@push('css')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/datatables.css') }}">
<link rel="stylesheet" href="{{asset('assets/vendor/leaflet/leaflet.css')}}" />
@endpush

@section('content')
@component('components.breadcrumb')
@slot('breadcrumb_title')
<h3>Lokasi Terkini</h3>
@endslot
<li class="breadcrumb-item active">Dashboard</li>
<li class="breadcrumb-item active">Lokasi Terkini</li>
@endcomponent

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex"><h5>{{ $item->merk }} ({{ $item->nopol }}) </h5></div>
                </div>
                <div class="card-body">
                    <div class="leaflet-map mb-4" id="dragMap"></div>
                    <div class="d-flex justify-content-end"><a href="{{ route('dashboard') }}" class="btn btn-light">Kembali</a></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
<script src="{{ asset('assets/vendor/leaflet/leaflet.js')}}"></script>
<script>
    const dragMapVar = document.getElementById('dragMap');
    if (dragMapVar) {
        const armada = {!! json_encode($item) !!};
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
@endpush

@endsection