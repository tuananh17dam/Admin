<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SanPhamSeeder::class,
            KhachHangSeeder::class,
            UserSeeder::class,
            KhoHangSeeder::class,
            DonHangSanPhamSeeder::class, 
            DonHangSeeder::class,

           
        ]);
    }
}
