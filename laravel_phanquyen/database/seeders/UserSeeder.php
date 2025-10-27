<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Tạo dữ liệu mẫu cho bảng users bằng tiếng Việt.
     *
     * @return void
     */
    public function run()
    {
        // Tạo 50 bản ghi mẫu
        User::factory()->count(50)->create();

        // Thông báo hoàn thành
        echo "Đã tạo 50 bản ghi mẫu cho bảng users bằng tiếng Việt.\n";
    }
}