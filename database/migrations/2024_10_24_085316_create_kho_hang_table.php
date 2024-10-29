<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKhoHangTable extends Migration
{
    public function up()
    {
        Schema::create('kho_hang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('san_pham_id')->constrained('san_phams')->onDelete('cascade'); // Liên kết với bảng sản phẩm
            $table->integer('so_luong_ton_kho')->default(0); // Số lượng tồn kho
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kho_hang');
    }
}
