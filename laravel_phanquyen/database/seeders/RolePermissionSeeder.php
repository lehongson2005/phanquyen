<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('role_code', 'SUPER_ADMIN')->first();
        $allPermissions = Permission::all();

        // Gán mọi quyền cho Super Admin
        if ($adminRole) {
            $adminRole->permissions()->sync($allPermissions->pluck('id'));
        }

        $studentRole = Role::where('role_code', 'STUDENT')->first();
        $viewPermission = Permission::where('permission_code', 'VIEW')->first();

        // Gán quyền VIEW cho Sinh viên
        if ($studentRole && $viewPermission) {
            $studentRole->permissions()->syncWithoutDetaching([$viewPermission->id]);
        }
    }
}
