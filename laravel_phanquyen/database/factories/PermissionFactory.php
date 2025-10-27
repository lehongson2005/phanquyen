<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    protected $model = \App\Models\Permission::class;

    public function definition(): array
    {
        // Danh sách tên quyền
        $permissionNames = [
            'Quản lý người dùng',
            'Quản lý vai trò',
            'Xem báo cáo',
            'Chỉnh sửa báo cáo',
            'Quản lý lớp học',
            'Quản lý khoa',
            'Tạo tài liệu',
            'Xóa tài liệu',
            'Cập nhật điểm sinh viên',
            'Xem lịch học',
            'Quản lý lịch học',
            'Xét duyệt học bổng',
            'Quản lý tài khoản sinh viên',
            'Quản lý tài khoản giảng viên',
        ];

        // Danh sách mô tả quyền
        $descriptions = [
            'Cho phép quản lý thông tin người dùng trong hệ thống.',
            'Cho phép tạo, chỉnh sửa và xóa vai trò người dùng.',
            'Cho phép xem các báo cáo thống kê của hệ thống.',
            'Cho phép chỉnh sửa nội dung báo cáo.',
            'Cho phép quản lý thông tin các lớp học.',
            'Cho phép quản lý thông tin các khoa trong trường.',
            'Cho phép tạo mới tài liệu học tập.',
            'Cho phép xóa tài liệu khỏi hệ thống.',
            'Cho phép cập nhật điểm số cho sinh viên.',
            'Cho phép xem lịch học của các lớp.',
            'Cho phép tạo và chỉnh sửa lịch học.',
            'Cho phép xét duyệt hồ sơ học bổng cho sinh viên.',
            'Cho phép quản lý tài khoản của sinh viên.',
            'Cho phép quản lý tài khoản của giảng viên.',
        ];

        // Chọn ngẫu nhiên chỉ số để tên và mô tả tương ứng
        $index = array_rand($permissionNames);
        $permissionName = $permissionNames[$index];
        $description = $descriptions[$index];

        // Tạo mã quyền từ tên: viết thường, thay dấu cách và ký tự tiếng Việt
        $permissionCode = strtolower(str_replace(
            [' ', 'á', 'à', 'ả', 'ã', 'ạ', 'ă', 'ắ', 'ằ', 'ẳ', 'ẵ', 'ặ', 'â', 'ấ', 'ầ', 'ẩ', 'ẫ', 'ậ', 'é', 'è', 'ẻ', 'ẽ', 'ẹ', 'ê', 'ế', 'ề', 'ể', 'ễ', 'ệ', 'í', 'ì', 'ỉ', 'ĩ', 'ị', 'ó', 'ò', 'ỏ', 'õ', 'ọ', 'ô', 'ố', 'ồ', 'ổ', 'ỗ', 'ộ', 'ơ', 'ớ', 'ờ', 'ở', 'ỡ', 'ợ', 'ú', 'ù', 'ủ', 'ũ', 'ụ', 'ư', 'ứ', 'ừ', 'ử', 'ữ', 'ự', 'ý', 'ỳ', 'ỷ', 'ỹ', 'ỵ'],
            ['_', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'u', 'y', 'y', 'y', 'y', 'y'],
            $permissionName
        ));

        return [
            'permission_name' => $permissionName, // Tên quyền
            'permission_code' => $permissionCode, // Mã quyền
            'permission_description' => $this->faker->optional(0.8, null)->randomElement($descriptions), // 80% có mô tả
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