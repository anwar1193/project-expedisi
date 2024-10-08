<div class="modal fade modal-bookmark" id="customerDiskon{{ $data->id }}" tabindex="-1" role="dialog"
    aria-labelledby="modalCustomerLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content justify-content-start">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Diskon</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-xl-12 xl-20 col-md-7 box-col-12">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane contact-tab-0 tab-content-child fade show active" id="v-pills-user"
                            role="tabpanel" aria-labelledby="v-pills-user-tab">
                            <div class="profile-mail">
                                <form action="{{ route('customers.addDiskon') }}" method="post">
                                @csrf
                                <div class="email-general mb-2">
                                        <input type="hidden" name="id" value="{{ $data->id }}">

                                        <div class="row d-flex py-1 text-start justify-content-start">
                                            <div class="col-4">Nama</div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">{{ $data->nama }}</div>
                                        </div>

                                        <div class="row d-flex py-1 text-start justify-content-start">
                                            <div class="col-4">Persentase Diskon (%)</div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <input type="number" class="form-control" value="{{ old('diskon', $data->diskon) }}" name="diskon">
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