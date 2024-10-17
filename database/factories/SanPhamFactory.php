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
            'hinh_anh' => $this->faker->imageUrl(640, 480, 'products', true),
        ];
    }
}
