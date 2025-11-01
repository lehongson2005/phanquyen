<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Lấy faculty và class mẫu
        $faculty = Faculty::first();
        $class = ClassModel::first();

        // Tạo admin user
        User::firstOrCreate(
            ['user_email' => 'admin@gmail.com'],
            [
                'user_student_code' => 'ADMIN01',
                'user_full_name' => 'Adminstrator',
                'user_gender' => 'Nam',
                'user_date_of_birth' => '2000-01-01',
                'user_faculty_id' => $faculty?->faculty_id,
                'user_class_id' => $class?->class_id,
                'user_major' => 'System Admin',
                'user_course_year' => '2020',
                'user_username' => 'admin',
                'user_password' => Hash::make('123456'),
                'user_is_active' => true,
            ]
        );

        // Tạo 10 user sinh viên mẫu
        User::factory(10)->create([
            'user_faculty_id' => $faculty?->faculty_id,
            'user_class_id' => $class?->class_id,
        ]);
    }
}