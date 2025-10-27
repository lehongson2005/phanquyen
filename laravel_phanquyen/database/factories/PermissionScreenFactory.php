<?php

namespace Database\Factories;

use App\Models\Permission;
use App\Models\Screen;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionScreenFactory extends Factory
{
    protected $model = \App\Models\PermissionScreen::class;

    public function definition(): array
    {
        // Lấy danh sách ID từ bảng permissions và screens
        $permissionIds = Permission::pluck('id')->toArray();
        $screenIds = Screen::pluck('id')->toArray();

        // Kiểm tra xem có dữ liệu trong bảng permissions và screens không
        if (empty($permissionIds) || empty($screenIds)) {
            throw new \Exception('Bảng permissions hoặc screens không có dữ liệu. Vui lòng chạy PermissionSeeder và ScreenSeeder trước.');
        }

        // Chọn ngẫu nhiên permission_id và screen_id
        $permissionId = $this->faker->randomElement($permissionIds);
        $screenId = $this->faker->randomElement($screenIds);

        return [
            'permission_id' => $permissionId, // ID quyền
            'screen_id' => $screenId, // ID màn hình
            'is_view' => $this->faker->boolean(80), // 80% có quyền xem
            'is_add' => $this->faker->boolean(50), // 50% có quyền thêm
            'is_edit' => $this->faker->boolean(50), // 50% có quyền sửa
            'is_delete' => $this->faker->boolean(30), // 30% có quyền xóa
            'is_scan' => $this->faker->boolean(20), // 20% có quyền quét
            'is_all' => $this->faker->boolean(10), // 10% có quyền toàn bộ
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