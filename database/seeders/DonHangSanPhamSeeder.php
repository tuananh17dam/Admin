<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DonHangSanPham;

class DonHangSanPhamSeeder extends Seeder
{
    public function run()
    {
        DonHangSanPham::factory()->count(50)->create(); // Tạo 50 bản ghi ngẫu nhiên
    }
}
