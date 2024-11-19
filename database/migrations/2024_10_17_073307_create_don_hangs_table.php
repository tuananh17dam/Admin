<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('don_hangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('khach_hang_id')->constrained('khach_hangs')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users');
            $table->string('tin_nhan')->nullable(); // cho phép giá trị null
            $table->integer('voucher')->default(0); // Voucher giảm giá đơn hàng
            $table->integer('sale')->default(0);
            $table->integer('diem_thuong');
            $table->string('don_vi_van_chuyen'); // Đơn vị vận chuyển
            $table->integer('phi_van_chuyen')->default(0); // Phí vận chuyển
            $table->integer('voucher_van_chuyen')->default(0); // Voucher vận chuyển
            $table->integer('tong_thanh_toan')->default(0); // Tổng thanh toán
            $table->enum('phuong_thuc_thanh_toan', [
                'Thanh toán khi nhận hàng',
                'Zalopay',
                'Ví điện tử MoMo',
                'Thẻ tín dụng/ghi nợ nội địa',
                'Thẻ ATM nội địa',
                'VNPAY'
            ])->default('Thanh toán khi nhận hàng');
            $table->enum('tinh_trang', ['Chưa giao', 'Đã giao', 'Hủy đơn','Hoàn hàng'])->default('Chưa giao'); // Tình trạng đơn hàng
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
