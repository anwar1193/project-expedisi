@extends('layouts.admin.master')

@section('title')Detail Pemantauan Kamera
 {{ $title }}
@endsection

@push('css')
@endpush

@section('content')
	@component('components.breadcrumb')
		@slot('breadcrumb_title')
			<h3>Detail Pemantauan Kamera</h3>
		@endslot
		<li class="breadcrumb-item active">Pemanatauan Kamera</li>
		<li class="breadcrumb-item active">Detail</li>
	@endcomponent

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
                                <a href="{{ route('pemantauan-camera.front', $item->id) }}" class="text-light"><i class="fa fa-folder" title="Daftar Image"></i></a> 
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
                                <a href="{{ route('pemantauan-camera.rear', $item->id) }}" class="text-light"><i class="fa fa-folder"></i></a> 
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

@push('scripts') 
	<script src="{{ asset('assets/js/take-video.js')}}"></script>
	<script>
		captureButton1.addEventListener('click', function() {
        var imgData1 = takeSnapshot(video1, canvas);

        fetch('{{ route('store.front-camera') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({id: `{{ $item->id }}`, image: imgData1 })
        })
        .then(response => response.json())
        .then(data => window.location.reload())
        .catch((error) => {
            console.error('Error:', error);
        });
    });
    
    captureButton2.addEventListener('click', function() {
        var imgData2 = takeSnapshot(video2, canvas2);

        fetch('{{ route('store.rear-camera') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({id: `{{ $item->id }}`, image: imgData2 })
        })
        .then(response => response.json())
        .then(data => window.location.reload())
        .catch((error) => {
            console.error('Error:', error);
        });
    });
	</script>
@endpush

@endsection