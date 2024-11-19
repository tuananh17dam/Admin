<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address'); // Cột address
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('seller'); // Giá trị mặc định là 'seller'
            $table->rememberToken();
            $table->timestamps();
        });

        // Tạo user admin với địa chỉ Thai Nguyen
        User::create([
            'name' => 'admin',
            'address' => 'Thai Nguyen', // Địa chỉ admin
            'email' => 'admin@themesbrand.com',
            'phone' => null,
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'email_verified_at' => '2023-05-17 17:04:58',
            'created_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
