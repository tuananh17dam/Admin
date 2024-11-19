<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaiKhoanBanHangTable extends Migration
{
    public function up()
    {
        Schema::create('tai_khoan_ban_hang', function (Blueprint $table) {
            $table->id();
            $table->string('ten_tai_khoan')->unique(); // Tên tài khoản (Tên shop)
            $table->string('dia_chi'); // Địa chỉ
            $table->string('so_dien_thoai');
            $table->string('email')->unique(); // Email field
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tai_khoan_ban_hang');
    }
}
