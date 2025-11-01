<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    public function run(): void
    {
        Faculty::firstOrCreate(
            ['faculty_code' => 'IT'],
            [
                'faculty_name' => 'Công nghệ thông tin',
                'faculty_dean' => 'GS. TS. Nguyễn Văn A',
                'faculty_email' => 'cntt@example.edu.vn',
                'faculty_phone' => '123-456-7890',
                'faculty_established_date' => '1995-10-20',
            ]
        );

        Faculty::firstOrCreate(
            ['faculty_code' => 'ECO'],
            [
                'faculty_name' => 'Kinh tế & Quản trị kinh doanh',
                'faculty_dean' => 'PGS. TS. Trần Thị B',
                'faculty_email' => 'kinhte@example.edu.vn',
                'faculty_phone' => '123-456-7891',
                'faculty_established_date' => '2001-05-15',
            ]
        );
    }
}
