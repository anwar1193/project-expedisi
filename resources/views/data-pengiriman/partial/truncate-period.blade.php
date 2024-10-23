<div class="modal fade" id="truncateModal" tabindex="-1" aria-labelledby="truncateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="truncateModalLabel">Konfirmasi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda Yakin Ingin Menghapus Data Pada Tanggal {{ request('tanggal') }}?
            </div>
            <div class="modal-footer">
                <form action="{{ route('data-pengiriman.truncate-by-periode') }}" method="GET">
                    <input hidden class="datepicker-here form-control digits" autocomplete="off" type="text"  name="tanggal" value="{{ request('tanggal') ?? date('d/m/Y', strtotime('-7 day')).' - '.date('d/m/Y') }}">
                    <button type="submit" class="btn btn-danger">Ya</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>