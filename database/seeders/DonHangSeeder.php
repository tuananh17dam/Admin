<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DonHang;

class DonHangSeeder extends Seeder
{
    public function run(): void
    {
        DonHang::factory(10)->create(); // Tạo 10 đơn hàng giả lập
    }
}
