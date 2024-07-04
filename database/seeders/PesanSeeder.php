<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PesanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pesan = [
            [
                "kode_pesan" => "INV", 
                "judul" => "Invoice",
                "isi_pesan" => "Terlampir Invoice"
            ],
            [
                "kode_pesan" => "SP", 
                "judul" => "Status Pengiriman",
                "isi_pesan" => "Update Status Pengiriman Terbaru"
            ]
        ];
        DB::table("pesans")->insert($pesan);
    }
}
