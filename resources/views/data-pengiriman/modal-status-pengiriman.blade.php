<div class="modal fade" id="modalUpdateStatus" tabindex="-1" role="dialog" aria-labelledby="modalUpdateStatusLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Status Pengiriman</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form theme-form" enctype="multipart/form-data" method="POST" action="{{ route('status-pengiriman.import_excel') }}">
            @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <div class="form-group">
                                    <input type="file" name="file" id="file" required>
                                </div>

                                @error('file')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-light  text-white" type="button" data-bs-dismiss="modal">Kembali</button>
                    <a href="{{ route('data-pengiriman.download-resi') }}" class="btn btn-warning">Download Data Resi</a>
                    <button class="btn btn-primary text-white" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>