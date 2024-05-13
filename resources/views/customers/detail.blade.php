<div class="modal fade modal-bookmark" id="customer{{ $data->id }}" tabindex="-1" role="dialog"
    aria-labelledby="modalCustomerLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content justify-content-start">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Customer</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-xl-12 xl-20 col-md-7 box-col-12">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane contact-tab-0 tab-content-child fade show active" id="v-pills-user"
                            role="tabpanel" aria-labelledby="v-pills-user-tab">
                            <div class="profile-mail">
                                <div class="email-general mb-2">
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-4">Nama</div>
                                        <div class="col-1">:</div>
                                        <div class="col-6">{{ $data->nama }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-4">No Whatsapp</div>
                                        <div class="col-1">:</div>
                                        <div class="col-6 text-capitalize">{{ $data->no_wa }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-4">Email</div>
                                        <div class="col-1">:</div>
                                        <div class="col-6">{{ $data->email }}</div>
                                    </div>
                                    <div class="row text-start d-flex justify-content-start">
                                        <div class="col-4">Email</div>
                                        <div class="col-1">:</div>
                                        <div class="col-6">Rp. {{ $data->email }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-4">Username</div>
                                        <div class="col-1">:</div>
                                        <div class="col-6">{{ $data->username ?? '-' }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-4">Limit Kredit</div>
                                        <div class="col-1">:</div>
                                        <div class="col-6">Rp. {{ $data->limit_credit }}</div>
                                    </div>
                                    <div class="row d-flex py-1 text-start justify-content-start">
                                        <div class="col-4">Point</div>
                                        <div class="col-1">:</div>
                                        <div class="col-6">{{ $data->point }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>