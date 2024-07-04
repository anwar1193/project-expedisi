<div class="modal fade modal-bookmark" id="pesan{{ $data->id }}" tabindex="-1" role="dialog"
    aria-labelledby="modalPesanLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content justify-content-start">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Format Pesan</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-xl-12 xl-20 col-md-7 box-col-12">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane contact-tab-0 tab-content-child fade show active" id="v-pills-user"
                            role="tabpanel" aria-labelledby="v-pills-user-tab">
                            <div class="profile-mail">
                                <form action="{{ route('pesan.update') }}" method="post">
                                @csrf
                                <div class="email-general mb-2">
                                        <input type="hidden" name="id" value="{{ $data->id }}">

                                        <div class="row d-flex py-1 text-start justify-content-start">
                                            <div class="col-4">Judul</div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <input type="text" class="form-control" value="{{ old('kode_pesan', $data->kode_pesan) }}" name="kode_pesan">
                                            </div>
                                        </div>

                                        <div class="row d-flex py-1 text-start justify-content-start">
                                            <div class="col-4">Judul</div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <input type="text" class="form-control" value="{{ old('judul', $data->judul) }}" name="judul">
                                            </div>
                                        </div>
                                        
                                        <div class="row d-flex py-1 text-start justify-content-start">
                                            <div class="col-4">Isi Pesan</div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <textarea name="isi_pesan" class="form-control" id="" cols="30" rows="5">{{ old('isi_pesan', $data->isi_pesan) }}</textarea>
                                            </div>
                                        </div>

                                        <div class="row d-flex py-1 text-start justify-content-start mt-2">
                                            <div class="col-4"></div>
                                            <div class="col-1"></div>
                                            <div class="col-6">
                                                <button class="btn btn-success btn-sm" type="submit">
                                                    Simpan
                                                </button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>