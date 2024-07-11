<div class="card-body">
    <div class="table-responsive">
        <div class="table-responsive">
            <table class="display" id={{ $tableId }}>
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>No Invoice</th>
                        <th>Tanggal Cetak</th>
                        <th>Kode Customer</th>
                        <th>Nama Customer</th>
                        <th width="20%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($invoice as $data)
                        <tr>
                            <td>{{ $loop->iteration; }}</td>
                            <td>{{ $data->invoice_no }}</td>
                            <td>{{ formatTanggalIndonesia($data->created_at) }}</td>
                            <td>{{ $data->kode_customer }}</td>
                            <td>{{ $data->nama }}</td>
                            <td>
                                <form method="GET" action="{{ route('invoice.hasil-transaksi', ['id' => $data->id, 'invoiceId' => $data->invoiceId]) }}">
                                    <button class="btn btn-warning" type="submit" name="customer" value="{{ $data->id }}">Detail</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            <p class="fw-semibold">Belum Ada Data Invoice</p>
                        </td>
                    </tr>
                    @endforelse 
                </tbody>
            </table>
        </div>
        
    </div>
</div>