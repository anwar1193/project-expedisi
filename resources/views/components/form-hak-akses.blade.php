<div class="modal fade" id="exampleModal{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Level Pengguna</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form theme-form" method="POST" action="{{ route('hak-akses.update') }}">
            @csrf
            <input type="text" name="id" value="{{ $data->id }}" hidden>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="">Nama Pengguna</label>
                                <input class="form-control @error('nama') is-invalid @enderror" disabled type="text" name="username" autocomplete="off" value="{{ old('username', $data->nama) }}"/>

                                @error('nama')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label class="form-label" for="">Level Pengguna</label>
                                <select name="user_level" id="user_level" class="form-control @error('user_level') is-invalid @enderror">
                                    <option value="">- Pilih Level -</option>
                                    @foreach ($levels as $item)
                                        <option value="{{ $item->kode_level }}" {{ $data->user_level == $item->kode_level ? 'selected' : NULL }}>
                                            {{ $item->level }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('user_level')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary text-white" type="submit">Simpan</button>
                    <button class="btn btn-light text-white" type="button" data-bs-dismiss="modal">Kembali</button>
                </div>
            </form>
        </div>
    </div>
</div>