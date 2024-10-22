<?php

namespace Database\Factories;

use App\Models\SanPham;
use Illuminate\Database\Eloquent\Factories\Factory;

class SanPhamFactory extends Factory
{
    protected $model = SanPham::class;

    /**
     * Định nghĩa trạng thái mặc định của model.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'ten_san_pham' => $this->faker->word(),
            'gia_nhap' => $this->faker->randomFloat(2, 1000, 5000), // Giá nhập ngẫu nhiên từ 1,000 đến 5,000
            'gia_ban' => $this->faker->randomFloat(2, 6000, 10000), // Giá bán ngẫu nhiên từ 6,000 đến 10,000
            'hinh_anh' => $this->faker->imageUrl(640, 480, 'products', true),
        ];
    }
}
