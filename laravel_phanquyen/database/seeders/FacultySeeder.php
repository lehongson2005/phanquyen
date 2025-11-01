<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('Running FacultySeeder...');
        $faculty = Faculty::firstOrCreate(
            ['faculty_code' => 'IT'],
            [
                'faculty_name' => 'Công nghệ thông tin',
                'faculty_dean' => 'GS. TS. Nguyễn Văn A',
                'faculty_email' => 'cntt@example.edu.vn',
            ]
        );

        if ($faculty->wasRecentlyCreated) {
            $this->command->info('==> Created Faculty: Công nghệ thông tin.');
        } else {
            $this->command->warn("==> Faculty 'IT' already exists."); // Đã sửa lỗi cú pháp ở đây
        }
    }
}