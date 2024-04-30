<div class="modal fade" id="switchModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form theme-form" method="POST" action="{{ route('obd-switch-engine') }}">
                @csrf
                <input type="text" name="car_id" value="{{ $data->car_id }}" hidden>
                <div class="modal-body">
                    <p>Apakah Anda Yakin Ingin {{ $data->engine_status == 0 ? "Menghidupkan" : "Mematikan" }} Mesin Mobil {{ $data->cars_merk }} Dengan Nopol {{ $data->nopol }}</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary text-white" type="submit" >Ya</button>
                    <button class="btn btn-light text-white" type="button" data-bs-dismiss="modal">Tidak</button>
                </div>
            </form>
        </div>
    </div>
</div>