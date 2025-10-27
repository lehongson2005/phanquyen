<?php
// database/seeders/DatabaseSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Tắt kiểm tra khóa ngoại để seed dữ liệu dễ dàng
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Xóa dữ liệu cũ trước khi seed
        $this->truncateTables();

        // Gọi các seeder theo thứ tự quan trọng
        $this->call([
            // 1. Seed các bảng master data trước
            FacultySeeder::class,
            ClassSeeder::class,
            
            // // 2. Seed hệ thống phân quyền
            RoleSeeder::class,
            ScreenSeeder::class,
            PermissionSeeder::class,
            // RolePermissionSeeder::class,
            PermissionScreenSeeder::class,
            
            // 3. Seed users (cần faculties và classes trước)
            UserSeeder::class,
        
            
            // // 4. Seed dữ liệu quan hệ users-roles (cần users và roles trước)
            // UserRoleSeeder::class,
            
            // 5. Seed các bảng dữ liệu khác
            // EventSeeder::class,
            // AttendanceSeeder::class,
            // ...
        ]);

        // Bật lại kiểm tra khóa ngoại
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->command->info('✅ Đã seed dữ liệu thành công!');
    }

    /**
     * Xóa dữ liệu cũ trong các bảng
     */
    private function truncateTables(): void
    {
        $tables = [
            'users',
            'faculties',
            'classes',
            'roles',
            'screens',
            'permissions',
            'user_roles',
            'role_permissions',
            'permission_screens',
        ];

        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }

        $this->command->info('🧹 Đã xóa dữ liệu cũ trong các bảng.');
    }
}