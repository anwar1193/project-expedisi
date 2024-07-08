<div class="modal fade" id="modalImport" tabindex="-1" role="dialog" aria-labelledby="modalImportLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Data Pengiriman</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form theme-form" enctype="multipart/form-data" method="POST" action="{{ route('data-pengiriman.konfimasi-excel') }}">
            @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <div class="form-group">
                                    <input type="file" name="file" id="file" required>
                                </div>

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
                    <button class="btn btn-light  text-white" type="button" data-bs-dismiss="modal">Kembali</button>
                    {{-- <button class="btn btn-warning text-white" type="button" >Download Format</button> --}}
                    <a href="excel_format/DataPengiriman.xlsx" class="btn btn-warning">Download Format</a>
                    <button class="btn btn-primary text-white" type="submit">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>