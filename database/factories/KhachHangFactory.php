<?php

namespace Database\Factories;

use App\Models\KhachHang;
use Illuminate\Database\Eloquent\Factories\Factory;

class KhachHangFactory extends Factory
{
    protected $model = KhachHang::class;

    public function definition()
    {
        return [
            'ten' => $this->faker->name,
            'so_dien_thoai' => $this->faker->phoneNumber,
            'dia_chi' => $this->faker->address,
        ];
    }
}
