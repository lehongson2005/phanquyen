<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    protected $model = \App\Models\Role::class;

    public function definition(): array
    {
        // Danh sách vai trò và mã tương ứng
        $roles = [
            ['role_name' => 'Quản trị viên', 'role_code' => 'quan_tri_vien'],
            ['role_name' => 'Sinh viên', 'role_code' => 'sinh_vien'],
            ['role_name' => 'Tình nguyện viên', 'role_code' => 'tinh_nguyen_vien'],
        ];

        // Danh sách mô tả vai trò
        $descriptions = [
            'Quản lý toàn bộ hệ thống và cấp quyền cho người dùng.',
            'Truy cập các chức năng dành cho sinh viên như xem điểm, lịch học.',
            'Quản lý giảng dạy, nhập điểm và xem thông tin lớp học.',
            'Hỗ trợ quản lý hành chính và thông tin khoa.',
            'Tham gia các hoạt động hỗ trợ sự kiện và chương trình của trường.',
        ];

        // Chọn ngẫu nhiên chỉ số để tên và mô tả tương ứng
        $index = array_rand($roles);
        $role = $roles[$index];
        $description = $descriptions[$index];

        return [
            'role_name' => $role['role_name'], // Tên vai trò
            'role_code' => $role['role_code'], // Mã vai trò
            'role_description' => $this->faker->optional(0.8)->randomElement($descriptions), // 80% có mô tả
            'status' => $this->faker->randomElement([0, 1]), // Trạng thái: 0 (tắt) hoặc 1 (bật)
            'sequence' => $this->faker->numberBetween(1, 100), // Thứ tự
            'version' => 1, // Phiên bản
            'created_user_id' => 1, // ID người tạo
            'updated_user_id' => 1, // ID người cập nhật
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}