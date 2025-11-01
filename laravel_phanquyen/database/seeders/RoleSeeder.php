<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(['role_code' => 'SUPER_ADMIN'], ['role_name' => 'Super Admin']);
        Role::firstOrCreate(['role_code' => 'STUDENT'], ['role_name' => 'Sinh viên']);
        Role::firstOrCreate(['role_code' => 'TEACHER'], ['role_name' => 'Giáo viên']);
    }
}
