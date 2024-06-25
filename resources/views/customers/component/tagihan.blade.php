<div class="card-body">
    <div class="row"></div>
    <div class="table-responsive pt-5">
        <div class="float-end">
            <h5>Total Tagihan: Rp {{ number_format($total->total, 0, '.', '.') }}</h5>
        </div>
        <table class="display" id="basic-1">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Resi</th>
                    <th>Nama Penerima</th>
                    <th>Kota Tujuan</th>
                    <th>Metode Pembayaran</th>
                    <th>Status Pembayaran</th>
                    <th>Status Pengiriman</th>
                    <th>Ongkir</th>
                    
                    @if (Session::get('user_level') == 2)
                        <th>Pilih</th>
                    @endif
                    
                    <th width="35%" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                
                @foreach ($data as $data)
                    @php
                        $bukti_pembayaran = $data->bukti_pembayaran;

                        if($bukti_pembayaran != ''){
                            $explode = explode("/", $bukti_pembayaran);
                            $bukti_pembayaran_view = 'https://'.$explode[2].'/thumbnail?id='.$explode[5];
                        }else{
                            $bukti_pembayaran_view = '#';
                        }
                    @endphp
                    <tr>
                        <td>{{ $loop->iteration; }}</td>

                        <td>
                            <span class="badge badge-danger">
                                {{ $data->no_resi }}
                            </span>
                        </td>

                        <td>{{ $data->nama_penerima }}</td>
                        <td>{{ $data->kota_tujuan }}</td>
                        
                        <td onmouseover="showBukti({{ $data->id }})" onmouseout="hideBukti({{ $data->id }})">
                            @if ($bukti_pembayaran != '')
                                <div id="view-bukti{{ $data->id }}" class="mb-3">
                                    <img src="{{ $bukti_pembayaran_view }}" alt="test" class="mb-2">
                                    <a class="btn btn-primary" href="{{ $bukti_pembayaran }}" target="_blank">View Full Image</a>
                                </div>
                            @endif

                            {{ $data->metode_pembayaran }} <i class="{{ $data->metode_pembayaran == 'Transfer' ? 'fa fa-eye' : '' }}"></i>
                        </td>

                        <td class="text-center">
                            <span class="badge {{ $data->status_pembayaran == 1 ? 'badge-primary' : 'badge-warning' }}">
                                <i class="fa {{ $data->status_pembayaran == 1 ? 'fa-check' : 'fa-warning' }}"></i>
                                {{ $data->status_pembayaran == 1 ? 'Lunas' : 'Pending'; }}
                            </span>
                        </td>

                        <td>{{ $data->status_pengiriman }}</td>
                        <td>{{ number_format($data->ongkir, 0, '.', ',') }}</td>

                        @if (Session::get('user_level') == 2)
                            {{-- Select/Pilih --}}
                            <td class="text-center">
                                <input type="checkbox" value="5" name="id_pengiriman[]" id="flexCheckDefault" onclick="ceklis({{ $data->id }})">
                            </td>
                        @endif
                        

                        <td class="text-center">

                            {{-- <a class="btn btn-square btn-warning btn-xs" type="button" data-bs-toggle="modal" data-original-title="test" data-bs-target="#statusPembayaran{{ $data->id }}" title="Edit Status Pembayaran">
                                <i class="fa fa-credit-card"></i>
                            </a> --}}

                            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                                <div class="btn-group" role="group">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" id="btnGroupDrop1" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-original-title="test" data-bs-target="#modalDataPengiriman{{ $data->id }}" title="Detail Data"><span><i data-feather="eye"></i> Detail</span></a>
                                    </div>
                                </div>
                            </div>
                            @include('customers.component.detail-tagihan')
                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
        
    </div>
</div>