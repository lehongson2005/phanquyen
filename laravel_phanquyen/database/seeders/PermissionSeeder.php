<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Tạo dữ liệu mẫu cho bảng permissions bằng tiếng Việt.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['name' => 'Quản lý người dùng', 'description' => 'Cho phép quản lý thông tin người dùng trong hệ thống.'],
            ['name' => 'Quản lý vai trò', 'description' => 'Cho phép tạo, chỉnh sửa và xóa vai trò người dùng.'],
            ['name' => 'Xem báo cáo', 'description' => 'Cho phép xem các báo cáo thống kê của hệ thống.'],
            ['name' => 'Chỉnh sửa báo cáo', 'description' => 'Cho phép chỉnh sửa nội dung báo cáo.'],
            ['name' => 'Quản lý lớp học', 'description' => 'Cho phép quản lý thông tin các lớp học.'],
            ['name' => 'Quản lý khoa', 'description' => 'Cho phép quản lý thông tin các khoa trong trường.'],
            ['name' => 'Tạo tài liệu', 'description' => 'Cho phép tạo mới tài liệu học tập.'],
            ['name' => 'Xóa tài liệu', 'description' => 'Cho phép xóa tài liệu khỏi hệ thống.'],
            ['name' => 'Cập nhật điểm sinh viên', 'description' => 'Cho phép cập nhật điểm số cho sinh viên.'],
            ['name' => 'Xem lịch học', 'description' => 'Cho phép xem lịch học của các lớp.'],
            ['name' => 'Quản lý lịch học', 'description' => 'Cho phép tạo và chỉnh sửa lịch học.'],
            ['name' => 'Xét duyệt học bổng', 'description' => 'Cho phép xét duyệt hồ sơ học bổng cho sinh viên.'],
            ['name' => 'Quản lý tài khoản sinh viên', 'description' => 'Cho phép quản lý tài khoản của sinh viên.'],
            ['name' => 'Quản lý tài khoản giảng viên', 'description' => 'Cho phép quản lý tài khoản của giảng viên.'],
        ];

        foreach ($permissions as $index => $perm) {
            // Tạo permission_code từ tên: chuyển chữ thường, thay khoảng trắng bằng gạch dưới
            $permissionCode = strtolower($this->removeVietnameseAccents($perm['name']));
            $permissionCode = str_replace(' ', '_', $permissionCode);

            Permission::updateOrCreate(
                ['permission_code' => $permissionCode],
                [
                    'permission_name' => $perm['name'],
                    'permission_description' => $perm['description'],
                    'status' => 1,
                    'sequence' => $index + 1,
                    'version' => 1,
                    'created_user_id' => 1,
                    'updated_user_id' => 1,
                ]
            );
        }

        echo "Đã tạo/ cập nhật " . count($permissions) . " quyền thành công.\n";
    }

    /**
     * Loại bỏ dấu tiếng Việt
     */
    private function removeVietnameseAccents($str)
    {
        $unicode = [
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i'=>'í|ì|ỉ|ĩ|ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ',
            'd'=>'đ'
        ];
        foreach($unicode as $nonUnicode=>$uni){
            $str = preg_replace("/($uni)/i",$nonUnicode,$str);
        }
        return $str;
    }
}
