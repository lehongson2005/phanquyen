<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Screen;
use App\Models\PermissionScreen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionScreenSeeder extends Seeder
{
    /**
     * Tạo dữ liệu mẫu cho bảng permission_screens bằng tiếng Việt.
     *
     * @return void
     */
    public function run()
    {
        // Vô hiệu hóa khóa ngoại
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Xóa dữ liệu cũ trong bảng permission_screens
        DB::table('permission_screens')->truncate();

        // Lấy danh sách ID từ bảng permissions và screens
        $permissionIds = Permission::pluck('id')->toArray();
        $screenIds = Screen::pluck('id')->toArray();

        if (empty($permissionIds) || empty($screenIds)) {
            echo "Lỗi: Bảng permissions hoặc screens không có dữ liệu. Vui lòng chạy PermissionSeeder và ScreenSeeder trước.\n";
            return;
        }

        // Tạo danh sách các cặp permission_id và screen_id duy nhất
        $combinations = [];
        foreach ($permissionIds as $permissionId) {
            foreach ($screenIds as $screenId) {
                $combinations[] = [
                    'permission_id' => $permissionId,
                    'screen_id' => $screenId,
                    'is_view' => rand(0, 100) < 80, // 80% có quyền xem
                    'is_add' => rand(0, 100) < 50, // 50% có quyền thêm
                    'is_edit' => rand(0, 100) < 50, // 50% có quyền sửa
                    'is_delete' => rand(0, 100) < 30, // 30% có quyền xóa
                    'is_scan' => rand(0, 100) < 20, // 20% có quyền quét
                    'is_all' => rand(0, 100) < 10, // 10% có quyền toàn bộ
                    'status' => rand(0, 1), // Trạng thái ngẫu nhiên
                    'sequence' => rand(1, 100), // Thứ tự ngẫu nhiên
                    'version' => 1,
                    'created_user_id' => 1,
                    'updated_user_id' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Chọn ngẫu nhiên tối đa 50 cặp (hoặc ít hơn nếu số cặp nhỏ hơn)
        $selectedCombinations = array_slice($combinations, 0, min(50, count($combinations)));

        // Chèn dữ liệu
        PermissionScreen::insert($selectedCombinations);

        // Kích hoạt lại khóa ngoại
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Thông báo hoàn thành
        echo "Đã tạo " . count($selectedCombinations) . " bản ghi mẫu cho bảng permission_screens bằng tiếng Việt.\n";
    }
}