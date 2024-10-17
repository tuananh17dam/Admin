<?php

namespace Database\Factories;

use App\Models\DonHang;
use App\Models\KhachHang;
use App\Models\SanPham;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonHangFactory extends Factory
{
    protected $model = DonHang::class;

    public function definition(): array
    {
        return [
            'khach_hang_id' => KhachHang::factory(),
            'san_pham_id' => SanPham::factory(),
            'so_luong' => $this->faker->numberBetween(1, 10),
            'vocher' => $this->faker->randomFloat(2, 0, 100),
            'thanh_tien' => $this->faker->randomFloat(2, 100, 1000),
            'don_vi_van_chuyen' => $this->faker->company(),
            'tinh_trang' => $this->faker->randomElement(['chua_giao', 'da_giao', 'huy_don']),
        ];
    }
}
