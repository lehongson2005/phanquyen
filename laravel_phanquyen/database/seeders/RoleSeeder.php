<?php
// database/seeders/RoleSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Xóa dữ liệu cũ nếu cần
        Role::truncate();

        $roles = [
            ['role_name' => 'Admin', 'role_code' => 'admin', 'role_description' => 'Quản trị hệ thống'],
            ['role_name' => 'Volunteer', 'role_code' => 'volunteer', 'role_description' => 'Tình nguyện viên'],
            ['role_name' => 'Student', 'role_code' => 'student', 'role_description' => 'Sinh viên'],
        ];

        foreach ($roles as $role) {
            Role::create([
                'role_name' => $role['role_name'],
                'role_code' => $role['role_code'],
                'role_description' => $role['role_description'],
                'status' => 1,
                'sequence' => 1,
                'version' => 1,
                'created_user_id' => 1,
                'updated_user_id' => 1,
            ]);
        }
    }
}
