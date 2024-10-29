<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DonHangSanPham;

class DonHangSanPhamSeeder extends Seeder
{
    public function run()
    {
        DonHangSanPham::factory()->count(5)->create(); // Tạo 5 bản ghi ngẫu nhiên
    }
}
