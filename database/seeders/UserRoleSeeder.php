<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    public function run(): void
    {
        $adminUser = User::where('user_email', 'admin@gmail.com')->first();
        $adminRole = Role::where('role_code', 'SUPER_ADMIN')->first();

        if ($adminUser && $adminRole) {
            $adminUser->roles()->syncWithoutDetaching([$adminRole->id]);
        }

        $studentRole = Role::where('role_code', 'STUDENT')->first();
        $studentUsers = User::where('user_email', '!=', 'admin@gmail.com')->get();

        if ($studentRole) {
            foreach ($studentUsers as $student) {
                $student->roles()->syncWithoutDetaching([$studentRole->id]);
            }
        }
    }
}
