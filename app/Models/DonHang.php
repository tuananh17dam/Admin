<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHang extends Model
{
    use HasFactory;

    // Khai báo tên bảng (tùy chọn, nếu tên bảng không theo quy tắc mặc định của Laravel)
    protected $table = 'don_hangs';

    // Danh sách các cột có thể fillable (cho phép nhập liệu hàng loạt)
    protected $fillable = [
        'khach_hang_id',
        'san_pham_id',
        'so_luong',
        'vocher',
        'thanh_tien',
        'don_vi_van_chuyen',
        'tinh_trang',
    ];

    /**
     * Quan hệ với bảng khách hàng
     */
    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'khach_hang_id');
    }

    /**
     * Quan hệ với bảng sản phẩm
     */
    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id');
    }
}
