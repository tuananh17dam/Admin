<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KhachHang;

class KhachHangSeeder extends Seeder
{
    public function run()
    {
        KhachHang::factory()->count(10)->create();
    }
}
