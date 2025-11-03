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
            ClassSeeder::class, // Phải chạy sau FacultySeeder
            UserSeeder::class,    // Phải chạy sau FacultySeeder và ClassSeeder

            // Dữ liệu quan hệ (bảng trung gian) - chạy cuối cùng
            UserRoleSeeder::class,
            RolePermissionSeeder::class,
            PermissionScreenSeeder::class,
        ]);
    }
}