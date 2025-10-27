<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassModel;

class ClassSeeder extends Seeder
{
    public function run(): void
    {
        // Xóa dữ liệu cũ
        ClassModel::truncate();

        // Tạo 10 lớp mẫu
        ClassModel::factory()->count(10)->create();
    }
}
