<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusPengiriman;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusPengirimanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StatusPengiriman::create([
            'status_pengiriman' => 'BKD',
            'keterangan_pengiriman' => 'Paket anda telah diterima di Lionparcel D Angel Express'
        ]);

        StatusPengiriman::create([
            'status_pengiriman' => 'CARGO PLANE',
            'keterangan_pengiriman' => 'Paket anda sedang dalam penerbangan ke area tujuan'
        ]);

        StatusPengiriman::create([
            'status_pengiriman' => 'DEL',
            'keterangan_pengiriman' => 'Paket anda sedang dalam pengantaran ke alamat tujuan'
        ]);

        StatusPengiriman::create([
            'status_pengiriman' => 'STI-DEST',
            'keterangan_pengiriman' => 'Paket Anda Sudah sampai Gudang Lionparcel Area Tujuan'
        ]);

        StatusPengiriman::create([
            'status_pengiriman' => 'POD',
            'keterangan_pengiriman' => 'Paket anda telah diterima di alamat tujuan'
        ]);

        StatusPengiriman::create([
            'status_pengiriman' => 'STI DEST-SC',
            'keterangan_pengiriman' => 'Paket anda sedang transit'
        ]);

        StatusPengiriman::create([
            'status_pengiriman' => 'PICKUP_TRUCKING',
            'keterangan_pengiriman' => 'Paket anda sedang dalam pengantaran ka area tujuan via darat'
        ]);

        StatusPengiriman::create([
            'status_pengiriman' => 'SHORTLAND',
            'keterangan_pengiriman' => 'Paket anda sedang transit'
        ]);

        StatusPengiriman::create([
            'status_pengiriman' => 'PUP',
            'keterangan_pengiriman' => 'Paket anda sedang dalam pengantaran ke Gudang Lionparcel Makassar'
        ]);

        StatusPengiriman::create([
            'status_pengiriman' => 'STI',
            'keterangan_pengiriman' => 'Paket anda telah di terima di Gudang Lionparcel Makassar'
        ]);

        StatusPengiriman::create([
            'status_pengiriman' => 'TRANSIT',
            'keterangan_pengiriman' => 'Paket anda sedang transit'
        ]);

        StatusPengiriman::create([
            'status_pengiriman' => 'DEX',
            'keterangan_pengiriman' => 'Paket anda gagal terantar'
        ]);

        StatusPengiriman::create([
            'status_pengiriman' => 'BAGGING',
            'keterangan_pengiriman' => 'Paket anda sedang di sortir di gudang Lion parcel'
        ]);

        StatusPengiriman::create([
            'status_pengiriman' => 'HAL',
            'keterangan_pengiriman' => 'Paket sedang tertahan di gudang lionparcel'
        ]);

        StatusPengiriman::create([
            'status_pengiriman' => 'CARGO TRACKING',
            'keterangan_pengiriman' => 'Paket anda sedang dalam pengantaran ka area tujuan via darat'
        ]);

        StatusPengiriman::create([
            'status_pengiriman' => 'DROPOFF_TRACKING',
            'keterangan_pengiriman' => ''
        ]);

        StatusPengiriman::create([
            'status_pengiriman' => 'HND',
            'keterangan_pengiriman' => ''
        ]);

        StatusPengiriman::create([
            'status_pengiriman' => 'STI-SC',
            'keterangan_pengiriman' => 'Paket anda telah sampai di subconsolidator'
        ]);
    }
}
