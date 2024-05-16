<?php

namespace Database\Seeders;

use App\Models\KonversiPoint;
use Illuminate\Database\Seeder;

class KonversiPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        KonversiPoint::create([
            'point' => 1,
            'nominal' => 1000
        ]);
    }
}
