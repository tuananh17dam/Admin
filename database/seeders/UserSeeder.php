<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run():void
    {
        // Tạo 50 tài khoản bán hàng ngẫu nhiên
       
        User::factory()->count(20)->create();
    }
}
