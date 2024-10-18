<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    use HasFactory;

    // Đặt tên bảng nếu khác với quy tắc mặc định
    protected $table = 'don_hangs';

    // Các trường có thể gán giá trị đại chúng (mass assignable)
    protected $fillable = [
        'khach_hang_id',
        'tin_nhan',
        'voucher',
        'sale',
        'diem_thuong',
        'don_vi_van_chuyen',
        'phi_van_chuyen',
        'voucher_van_chuyen',
        'tong_thanh_toan',
        'phuong_thuc_thanh_toan',
        'tinh_trang',
    ];

    // Quan hệ với model KhachHang
    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'khach_hang_id');
    }

    public function donHangSanPhams()
    {
        return $this->hasMany(DonHangSanPham::class, 'don_hang_id');
    }

    // Nếu cần quan hệ với các sản phẩm, có thể thêm quan hệ này


    // Phương thức để tính tổng thanh toán
    public function calculateTotal()
    {
        $this->tong_thanh_toan = $this->thanh_tien - $this->voucher + $this->phi_van_chuyen - $this->voucher_van_chuyen;
        $this->save(); // Lưu thay đổi vào cơ sở dữ liệu
    }
}
