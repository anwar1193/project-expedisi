<div class="card-body">
    <div>
        <div class="mb-3">
            <div class="row invo-header">
                <div class="col-sm-5">
                    <div class="media">
                        <div class="media-left">
                            <img src="{{  asset('assets/lionparcel.png') }}" alt="Lion Parcel" style="width: 200px; height: 60px;" />
                            <h4 class="text-danger ps-2 fw-bold">D Angel Express</h4>	                                        </div>
                    </div>
                    <!-- End Info-->
                </div>
                <div class="col-sm-3 d-flex align-items-end">
                    <div class="text-md-end text-xs-center">
                        <h3>Invoice</h3>
                    </div>
                </div>
                <div class="col-sm-3 d-flex align-items-end">
                    <div class="text-md-end text-xs-center">
                        <p>Makassar, {{ formatTanggalIndonesia($invoice->created_at) }}</p>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <!-- End InvoiceTop-->
        <div class="row invo-profile py-2 my-2" style="border: 0.5px solid; width: 70%">
            <div class="col-xl-8">
                <div class="text-xl-start" id="project">
                    <div class="row d-flex py-1 text-start justify-content-start">
                        <div class="col-4 col-lg-4">Invoice No</div>
                        <div class="col-1 col-lg-2">:</div>
                        <div class="col-6 col-lg-6 text-capitalize">{{ $invoice->invoice_no ?? "" }}</div>
                    </div>
                    <div class="row d-flex py-1 text-start justify-content-start">
                        <div class="col-4 col-lg-4">Customer Name</div>
                        <div class="col-1 col-lg-2">:</div>
                        <div class="col-6 col-lg-6 text-capitalize">{{ $customer->nama }}</div>
                    </div>
                    <div class="row d-flex py-1 text-start justify-content-start">
                        <div class="col-4 col-lg-4">Address</div>
                        <div class="col-1 col-lg-2">:</div>
                        <div class="col-6 col-lg-6 text-capitalize">{{ $customer->alamat }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-2 py-2">
            <small>Biaya Pengiriman</small>  PT. Dion Farma Abadi
        </div>
        <!-- End Invoice Mid-->
        <div>
            <div class="table-responsive invoice-table" id="table">
                <table class="display" id="basic-1">
                    <thead class="text-center">
                        <tr>
                            <th width="5%" style="border: 1px solid">No</th>
                            <th style="border: 1px solid">No STT</th>
                            <th width="10%" style="border: 1px solid">Tanggal</th>
                            <th style="border: 1px solid">Pengirim</th>
                            <th style="border: 1px solid">Penerima</th>
                            <th style="border: 1px solid">Tujuan</th>
                            <th style="border: 1px solid">Jumlah Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: 14px">
                        @forelse ($data as $data)
                            <tr>
                                <td style="border: 1px solid; padding: 5px; text-align: center">{{ $loop->iteration; }}</td>
                                <td style="border: 1px solid; padding: 5px; text-align: center">{{ $data->no_resi }}</td>
                                <td style="border: 1px solid; padding: 5px; text-align: center">{{ $data->created_at }}</td>
                                <td style="border: 1px solid; padding: 5px; text-align: center">{{ $data->nama_pengirim }}</td>
                                <td style="border: 1px solid; padding: 5px; text-align: center">{{ $data->nama_penerima }}</td>
                                <td style="border: 1px solid; padding: 5px; text-align: center">{{ $data->kota_tujuan }}</td>
                                <td style="border: 1px solid; padding: 5px; text-align: center">Rp {{ number_format($data->ongkir, 0, '.', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">
                                    <p class="fw-semibold">Belum Ada Data Transaksi</p>
                                </td>
                            </tr>
                        @endforelse 
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="6" style="border: 1px solid; padding: 5px; text-align: center">
                                <p class="fw-semibold">Total</p>
                            </td>
                            <td style="border: 1px solid; padding: 5px; text-align: center">
                                Rp {{ number_format($total->total, 0, '.', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- End Table-->
            <div class="text-center mt-3">
                <p>Lion parcel - D Angel Express</p>
                <p>Jl. Onta Baru no 51, Kelurahan Mandala, Kecamatan Mamajang, Kota Makassar – 90135, Sulawesi Selatan</p>
                <p>Telp : 0411 – 8918311 , 082110071565</p>
                <p>Website : http://lionparcel.com</p>
            </div>
        </div>
        <!-- End InvoiceBot-->
    </div>
</div>