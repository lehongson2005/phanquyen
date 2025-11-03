<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        Permission::firstOrCreate(['permission_code' => 'VIEW'], ['permission_name' => 'Xem']);
        Permission::firstOrCreate(['permission_code' => 'CREATE'], ['permission_name' => 'Thêm']);
        Permission::firstOrCreate(['permission_code' => 'UPDATE'], ['permission_name' => 'Sửa']);
        Permission::firstOrCreate(['permission_code' => 'DELETE'], ['permission_name' => 'Xóa']);
        Permission::firstOrCreate(['permission_code' => 'SCAN'], ['permission_name' => 'Quét QR']);
    }
}
