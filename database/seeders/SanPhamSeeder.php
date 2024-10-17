<?php

namespace Database\Seeders;

use App\Models\SanPham;
use Illuminate\Database\Seeder;

class SanPhamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Tạo 10 sản phẩm giả lập
        SanPham::factory()->count(10)->create();
    }
}
