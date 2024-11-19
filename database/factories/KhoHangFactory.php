<?php
namespace Database\Factories;

use App\Models\KhoHang;
use App\Models\SanPham;
use Illuminate\Database\Eloquent\Factories\Factory;

class KhoHangFactory extends Factory
{
    protected $model = KhoHang::class;

    public function definition()
    {
        return [
            'san_pham_id' => SanPham::inRandomOrder()->first()->id, // Lấy ngẫu nhiên sản phẩm từ bảng `san_phams`
            'so_luong_ton_kho' => $this->faker->numberBetween(10, 100), // Giả lập số lượng tồn kho ngẫu nhiên
        ];
    }
}
