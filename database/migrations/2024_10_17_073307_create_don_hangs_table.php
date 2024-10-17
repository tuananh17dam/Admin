<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('don_hangs', function (Blueprint $table) {
            $table->id();

            // Khóa ngoại đến bảng khách hàng
            $table->foreignId('khach_hang_id')->constrained('khach_hangs')->onDelete('cascade');

            // Khóa ngoại đến bảng sản phẩm
            $table->foreignId('san_pham_id')->constrained('san_phams')->onDelete('cascade');

            // Số lượng sản phẩm trong đơn hàng
            $table->integer('so_luong');

            $table->float('vocher');

            $table->float('thanh_tien');

            // Đơn vị vận chuyển
            $table->string('don_vi_van_chuyen');

            // Tình trạng đơn hàng (0: chưa giao, 1: đã giao, 2: hủy đơn)
            $table->enum('tinh_trang', ['chua_giao', 'da_giao', 'huy_don'])->default('chua_giao');

            // Thời gian tạo và cập nhật
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('don_hangs');
    }
};
