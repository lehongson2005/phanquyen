<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            // Dữ liệu gốc, không phụ thuộc
            FacultySeeder::class,
            RoleSeeder::class,
            PermissionSeeder::class,
            ScreenSeeder::class,

            // Dữ liệu phụ thuộc
            ClassSeeder::class, // Phụ thuộc vào Faculty
            UserSeeder::class,    // Phụ thuộc vào Faculty, Class

            // Dữ liệu quan hệ (bảng trung gian)
            UserRoleSeeder::class,
            RolePermissionSeeder::class,
            PermissionScreenSeeder::class,
        ]);
    }
}
