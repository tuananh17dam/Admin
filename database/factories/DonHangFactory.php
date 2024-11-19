<?php

namespace Database\Factories;

use App\Models\DonHang; // Nhập mô hình DonHang
use App\Models\KhachHang;
use App\Models\User;
 // Nhập mô hình KhachHang nếu cần
use Illuminate\Database\Eloquent\Factories\Factory;

class DonHangFactory extends Factory
{
    protected $model = DonHang::class;

    public function definition()
    {
        return [
            'khach_hang_id' => KhachHang::factory(), // Giả định có factory cho KhachHang
             'user_id' =>User::factory(),
            'tin_nhan' => $this->faker->sentence, // Tin nhắn ngẫu nhiên
            'voucher' => $this->faker->randomFloat(2, 0, 100), // Voucher ngẫu nhiên từ 0 đến 100
            'sale' => $this->faker->randomFloat(2, 0, 100),
            'diem_thuong' => $this->faker->numberBetween(0, 1000), // Điểm thưởng ngẫu nhiên
            'don_vi_van_chuyen' => $this->faker->company, // Đơn vị vận chuyển ngẫu nhiên
            'phi_van_chuyen' => $this->faker->randomFloat(2, 0, 50), // Phí vận chuyển ngẫu nhiên từ 0 đến 50
            'voucher_van_chuyen' => $this->faker->randomFloat(2, 0, 20), // Voucher vận chuyển ngẫu nhiên từ 0 đến 20
            'tong_thanh_toan' => function (array $attributes) {
                return $attributes['voucher'] + $attributes['phi_van_chuyen'] - $attributes['voucher_van_chuyen']- $attributes['sale']- $attributes['diem_thuong'];
            },
            'phuong_thuc_thanh_toan' => $this->faker->randomElement([
                'Thanh toán khi nhận hàng',
                'Zalopay',
                'Ví điện tử MoMo',
                'Thẻ tín dụng/ghi nợ nội địa',
                'Thẻ ATM nội địa',
                'VNPAY',
            ]),
            'tinh_trang' => $this->faker->randomElement(['Chưa giao', 'Đã giao', 'Hủy đơn']), // Tình trạng ngẫu nhiên
        ];
    }
}
