<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MasterMenu;

class MasterMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MasterMenu::create([
            'parent_id' => 0,
            'menu' => 'Dashboard',
            'url' => '/dashboard',
            'icon' => 'home',
            'status' => 1,
            'is_dropdown' => 0,
            'position' => 1
        ]);

        MasterMenu::create([
            'parent_id' => 0,
            'menu' => 'User Management',
            'url' => '/users',
            'icon' => 'user',
            'status' => 1,
            'is_dropdown' => 0,
            'position' => 2
        ]);

        MasterMenu::create([
            'parent_id' => 0,
            'menu' => 'Data Pengiriman',
            'url' => '/data-pengiriman',
            'icon' => 'list',
            'status' => 1,
            'is_dropdown' => 0,
            'position' => 3
        ]);

        MasterMenu::create([
            'parent_id' => 0,
            'menu' => 'Data Pemasukan',
            'url' => '/data-pemasukan',
            'icon' => 'trending-up',
            'status' => 1,
            'is_dropdown' => 0,
            'position' => 4
        ]);

        MasterMenu::create([
            'parent_id' => 0,
            'menu' => 'Daftar Pengeluaran',
            'url' => '/daftar-pengeluaran',
            'icon' => 'trending-down',
            'status' => 1,
            'is_dropdown' => 0,
            'position' => 5
        ]);

        MasterMenu::create([
            'parent_id' => 0,
            'menu' => 'Supplier',
            'url' => '/supplier',
            'icon' => 'shopping-bag',
            'status' => 1,
            'is_dropdown' => 0,
            'position' => 6
        ]);

        MasterMenu::create([
            'parent_id' => 0,
            'menu' => 'Log Aktifitas',
            'url' => '/log-activity',
            'icon' => 'clock',
            'status' => 1,
            'is_dropdown' => 0,
            'position' => 7
        ]);

        MasterMenu::create([
            'parent_id' => 0,
            'menu' => 'Log Akses',
            'url' => '/last-login',
            'icon' => 'activity',
            'status' => 1,
            'is_dropdown' => 0,
            'position' => 8
        ]);


        // ---------------------- Start Pengaturan
        MasterMenu::create([
            'parent_id' => 0,
            'menu' => 'Pengaturan',
            'url' => '/pengaturan',
            'icon' => 'settings',
            'status' => 1,
            'is_dropdown' => 1,
            'position' => 10
        ]);

        MasterMenu::create([
            'parent_id' => 9,
            'menu' => 'Profile',
            'url' => '/pengaturan/profile',
            'icon' => '',
            'status' => 1,
            'is_dropdown' => 0,
            'position' => 1
        ]);

        MasterMenu::create([
            'parent_id' => 9,
            'menu' => 'Ganti Password',
            'url' => '/pengaturan/ganti-password',
            'icon' => '',
            'status' => 1,
            'is_dropdown' => 0,
            'position' => 2
        ]);

        MasterMenu::create([
            'parent_id' => 9,
            'menu' => 'Hak Akses Pengguna',
            'url' => '/pengaturan/hak-akses',
            'icon' => '',
            'status' => 1,
            'is_dropdown' => 0,
            'position' => 3
        ]);
        // ---------------------- End Pengaturan
    }
}
