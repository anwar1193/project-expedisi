<div class="modal fade" id="pengeluaranModal" tabindex="-1" aria-labelledby="pengeluaranModalLabel" aria-hidden="true">
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
                <form action="{{ route('laporan.pengeluaran.export') }}" method="GET" target="_blank">
                    <button type="submit" class="btn btn-danger" name="format" value="pdf">PDF</button>
                    <button type="submit" class="btn btn-success" name="format" value="excel">Excel</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>