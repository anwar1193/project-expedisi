<div class="modal fade modal-bookmark" id="pembayaranInvoice{{ $data->invoiceId }}" tabindex="-1" role="dialog"
    aria-labelledby="modalPembayaranInvoice" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content justify-content-start">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pembayaran Inovice</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-xl-12 xl-20 col-md-7 box-col-12">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane contact-tab-0 tab-content-child fade show active" id="v-pills-user"
                            role="tabpanel" aria-labelledby="v-pills-user-tab">
                            <div class="profile-mail">
                                <form action="{{ route('invoice.transaksi-pembayaran') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="email-general mb-2">
                                        <input type="hidden" name="invoice_id" value="{{ $data->invoiceId }}">

                                        <div class="row d-flex py-1 text-start justify-content-start">
                                            <div class="col-4">No Invoice</div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">{{ $data->invoice_no }}</div>
                                        </div>
                                        
                                        <div class="row d-flex py-1 text-start justify-content-start">
                                            <div class="col-4">Total Sisa Tagihan</div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">Rp {{ number_format($data->sisa == 0 ? $data->totalBersih : $data->sisa, 0, '.', '.') }}</div>
                                            <input type="hidden" style="display: none" class="form-control" value="{{ $data->sisa == 0 ? $data->totalBersih : $data->sisa }}" name="total_tagihan">
                                        </div>

                                        <div class="row d-flex py-1 text-start justify-content-start">
                                            <div class="col-4">Nominal Bayar</div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <input type="number" class="form-control" placeholder="0" name="nominal">
                                            </div>
                                        </div>
                                        
                                        <div class="row d-flex py-1 text-start justify-content-start">
                                            <div class="col-4">Tanggal Bayar</div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <input type="date" class="form-control" name="tanggal_bayar" value="{{ date('Y-m-d') }}">
                                            </div>
                                        </div>
                                        
                                        <div class="row d-flex py-1 text-start justify-content-start">
                                            <div class="col-4">Bukti Bayar</div>
                                            <div class="col-1">:</div>
                                            <div class="col-6">
                                                <input class="form-control @error('bukti_bayar') is-invalid @enderror" type="file" width="48" height="48" name="bukti_bayar" />
                                            </div>
                                        </div>

                                        <div class="row d-flex py-1 text-start justify-content-start mt-2">
                                            <div class="col-4"></div>
                                            <div class="col-1"></div>
                                            <div class="col-6">
                                                <button class="btn btn-success btn-sm" type="submit">
                                                    Tambah
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