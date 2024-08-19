<?php

namespace Database\Seeders;

use App\Models\SettingWa;
use Illuminate\Database\Seeder;

class SettingWaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettingWa::create([
            'api_key' => "1EHXPGIu8cAaLxOnMsmWoZquvlJ1DP",
            'sender' => "6285103064051",
            "url_message" => "https://wa.rumahpintarinovasi.com/send-message",
            "url_media" => "https://wa.rumahpintarinovasi.com/send-media"
        ]);
    }
}
