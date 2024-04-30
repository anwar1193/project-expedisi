<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleLevelSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $levels = [
            [
                "kode_level" => 1, 
                "level" => "admin"
            ],
            [
                "kode_level" => 2, 
                "level" => "User"
            ]
        ];
        DB::table("levels")->insert($levels);
    }
}
