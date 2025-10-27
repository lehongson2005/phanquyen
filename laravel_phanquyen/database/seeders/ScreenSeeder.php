<?php

namespace Database\Seeders;

use App\Models\Screen;
use Illuminate\Database\Seeder;

class ScreenSeeder extends Seeder
{
    /**
     * Tạo dữ liệu mẫu cho bảng screens bằng tiếng Việt.
     *
     * @return void
     */
    public function run()
    {
        // Tạo 20 bản ghi mẫu
        Screen::factory()->count(20)->create();

        // Thông báo hoàn thành
        echo "Đã tạo 20 bản ghi mẫu cho bảng screens bằng tiếng Việt.\n";
    }
}