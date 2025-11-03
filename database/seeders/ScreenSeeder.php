<?php

namespace Database\Seeders;

use App\Models\Screen;
use Illuminate\Database\Seeder;

class ScreenSeeder extends Seeder
{
    public function run(): void
    {
        Screen::firstOrCreate(['screen_code' => 'DASHBOARD'], ['screen_name' => 'Bảng điều khiển']);
        Screen::firstOrCreate(['screen_code' => 'USER_MANAGEMENT'], ['screen_name' => 'Quản lý Người dùng']);
        Screen::firstOrCreate(['screen_code' => 'ROLE_MANAGEMENT'], ['screen_name' => 'Quản lý Vai trò']);
        Screen::firstOrCreate(['screen_code' => 'FACULTY_MANAGEMENT'], ['screen_name' => 'Quản lý Khoa']);
        Screen::firstOrCreate(['screen_code' => 'CLASS_MANAGEMENT'], ['screen_name' => 'Quản lý Lớp học']);
    }
}