<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KhoHang;

class KhoHangSeeder extends Seeder
{
    public function run()
    {
        // Giả lập 50 dòng dữ liệu cho bảng `kho_hang`
        KhoHang::factory()->count(10)->create();
    }
}

