<?php

namespace Database\Factories;

use App\Models\DonHangSanPham;
use App\Models\DonHang;
use App\Models\SanPham;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonHangSanPhamFactory extends Factory
{
    protected $model = DonHangSanPham::class;

    public function definition()
    {
        return [
            'don_hang_id' => DonHang::factory(), // Giả định có factory cho DonHang
            'san_pham_id' => SanPham::factory(), // Giả định có factory cho SanPham
            'so_luong' => $this->faker->numberBetween(1, 10), // Số lượng sản phẩm ngẫu nhiên từ 1 đến 10
            'thanh_tien' =>  $this->faker->numberBetween(1000 , 20000),
           
        ];
    }
}
