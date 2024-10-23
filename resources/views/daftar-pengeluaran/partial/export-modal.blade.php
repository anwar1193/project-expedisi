<div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="truncateModalLabel">Export</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Silahkan Pilih Metode Export
            </div>
            <div class="modal-footer">
                <form action="{{ route('daftar-pengeluaran.export') }}" method="GET" target="_blank">
                    <input hidden class="datepicker-here form-control digits" autocomplete="off" type="text"  name="tanggal" value="{{ request('tanggal') ?? date('d/m/Y', strtotime('-7 day')).' - '.date('d/m/Y') }}">
                    <button type="submit" class="btn btn-danger" name="format" value="pdf">PDF</button>
                    <button type="submit" class="btn btn-success" name="format" value="excel">Excel</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>