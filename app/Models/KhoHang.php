<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhoHang extends Model
{
    use HasFactory;

    protected $table = 'kho_hang';

    protected $fillable = [
        'san_pham_id',
        'so_luong_ton_kho',
    ];

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'san_pham_id');
    }
}
