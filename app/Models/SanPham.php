<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;

    protected $table = 'san_phams';

    protected $fillable = [
        'ten_san_pham',
        'gia_nhap',
        'gia_ban',
        'hinh_anh',
    ];
    public function donHangSanPhams()
    {
        return $this->hasMany(DonHangSanPham::class, 'san_pham_id');
    }
    
    public function khoHang()
    {
        return $this->hasOne(KhoHang::class, 'san_pham_id');
    }
   
}
