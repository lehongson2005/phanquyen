<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Screen;
use Illuminate\Database\Seeder;

class PermissionScreenSeeder extends Seeder
{
    public function run(): void
    {
        $allScreens = Screen::all();
        $allPermissions = Permission::all();

        // Gán tất cả quyền cho màn hình Quản lý người dùng làm ví dụ
        $userManagementScreen = Screen::where('screen_code', 'USER_MANAGEMENT')->first();
        if ($userManagementScreen) {
            foreach ($allPermissions as $permission) {
                $userManagementScreen->permissions()->syncWithoutDetaching([
                    $permission->id => [
                        'is_view' => true,
                        'is_add' => true,
                        'is_edit' => true,
                        'is_delete' => true,
                        'is_scan' => true,
                        'is_all' => true,
                    ]
                ]);
            }
        }
    }
}