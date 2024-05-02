<div class="modal fade" id="statusPembayaran{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="statusPembayaranLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ubah Status Pembayaran</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form theme-form" method="POST" action="{{ route('data-pengiriman.status') }}">
            @csrf
            <input type="text" name="id" value="{{ $data->id }}" hidden>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="">Status Pembayaran</label>
                                <select name="status_pembayaran" id="status_pembayaran" class="form-control @error('status_pembayaran') is-invalid @enderror">
                                    <option value="1" {{ $data->status_pembayaran == 1 ? 'selected' : NULL }}>Lunas</option>
                                    <option value="2" {{ $data->status_pembayaran == 2 ? 'selected' : NULL }}>Pending</option>
                                </select>

                                @error('status_pembayaran')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary text-white" type="submit">Simpan Perubahan</button>
                    <button class="btn btn-light  text-white" type="button" data-bs-dismiss="modal">Kembali</button>
                </div>
            </form>
        </div>
    </div>
</div>