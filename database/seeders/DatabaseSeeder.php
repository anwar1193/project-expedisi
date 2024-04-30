<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Level;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::Create([
            'kode_satker' => '12345',
            'nama_satker' => 'Kejaksaan Agung',
            'nama' => 'Administrator',
            'nip' => '0000018291',
            'username' => 'admin01',
            'email' => 'admin-jammer@mail.com',
            'user_level' => '1',
            'password' => bcrypt('password'),
            'status' => '1',
            'foto' => ''
        ]);

        Level::Create([
            'kode_level' => '1',
            'level' => 'Administrator'
        ]);

        Level::Create([
            'kode_level' => '2',
            'level' => 'User'
        ]);
    }
}
