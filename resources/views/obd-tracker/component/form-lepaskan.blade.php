<div class="modal fade" id="lepasModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Daftar Armada</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form theme-form" method="POST" action="{{ route('obd-disconnect-car') }}">
            @csrf
            <input type="text" name="id" value="{{ $data->id }}" hidden>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="">Armada</label>
                                <select name="car_id" id="status" class="form-control @error('car_id') is-invalid @enderror">
                                    <option value="">
                                        {{ $data->cars_merk }} ({{ $data->nopol }})
                                    </option>
                                </select>
                                @error('car_id')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary text-white" type="submit">Lepaskan</button>
                    <button class="btn btn-light  text-white" type="button" data-bs-dismiss="modal">Kembali</button>
                </div>
            </form>
        </div>
    </div>
</div>