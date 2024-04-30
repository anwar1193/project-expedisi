@extends('layouts.admin.master')

@section('title')Rear Camera
 {{ $title }}
@endsection

@push('css')
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Rear Kamera</h3>
		@endslot
		<li class="breadcrumb-item active">Pemanatauan Kamera</li>
		<li class="breadcrumb-item active">Rear</li>
	@endcomponent

	<div class="container-fluid">
		<div class="row">
			@foreach ($items as $data)
				<div class="col-sm-12 col-xl-4">
					<div class="card">
						<div class="card-header fw-bolder">{{ $data->merk }} ({{ $data->nopol }})</div>
						<div class="card-body text-center">
							<video width="250" height="200" autoplay="true" id="videoElement{{ $data->id }}">
							</video>
						</div>
					</div>
				</div>
			@endforeach
		</div>
	</div>

@push('scripts') 
    <script>
        const cars = {!! json_encode($items) !!};

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

@endpush

@endsection