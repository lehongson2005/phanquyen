<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faculty;

class FacultySeeder extends Seeder
{
    public function run(): void
    {
        // Tạo 8 khoa mẫu
        Faculty::factory()->count(8)->create();
    }
}
