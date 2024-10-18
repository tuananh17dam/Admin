<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonHangSanPham extends Model
{
    use HasFactory;

    protected $table = 'don_hang_san_pham';

    protected $fillable = [
        'don_hang_id',
        'san_pham_id',
        'so_luong',
        'thanh_tien',
    ];

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id');
    }

    public function donHang()
    {
        return $this->belongsTo(DonHang::class, 'don_hang_id');
    }
    
}
