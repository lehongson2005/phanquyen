<?php

namespace Database\Factories;

use App\Models\Screen;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScreenFactory extends Factory
{
    protected $model = Screen::class;

    public function definition(): array
    {
        // Danh sách tên màn hình tiếng Việt
        $screenNames = [
            'Quản lý người dùng',
            'Báo cáo doanh thu',
            'Cấu hình hệ thống',
            'Quản lý đơn hàng',
            'Theo dõi kho hàng',
            'Phân tích dữ liệu',
            'Giao diện dashboard',
            'Quản lý khách hàng',
            'Hệ thống thông báo',
            'Cập nhật sản phẩm',
            'Quản lý lịch học',
            'Quản lý điểm sinh viên',
            'Xét duyệt học bổng',
            'Quản lý khoa',
        ];

        // Danh sách mô tả tiếng Việt
        $descriptions = [
            'Giao diện quản lý thông tin người dùng trong hệ thống.',
            'Hiển thị báo cáo doanh thu theo tháng hoặc quý.',
            'Cấu hình các thông số và thiết lập hệ thống.',
            'Quản lý danh sách đơn hàng và trạng thái giao hàng.',
            'Theo dõi số lượng hàng tồn kho và nhập/xuất kho.',
            'Phân tích dữ liệu kinh doanh và thống kê.',
            'Giao diện tổng quan hiển thị thông tin chính.',
            'Quản lý thông tin khách hàng và lịch sử giao dịch.',
            'Hệ thống gửi thông báo tự động đến người dùng.',
            'Cập nhật thông tin sản phẩm hoặc dịch vụ.',
            'Quản lý lịch học cho các lớp và giảng viên.',
            'Cập nhật và quản lý điểm số của sinh viên.',
            'Xét duyệt hồ sơ học bổng cho sinh viên.',
            'Quản lý thông tin các khoa trong trường.',
        ];

        // Tạo mã màn hình với định dạng MH_XXX
        $screenCode = 'MH_' . strtoupper($this->faker->unique()->regexify('[A-Z]{3}'));

        // Chọn ngẫu nhiên chỉ số để tên và mô tả tương ứng
        $index = array_rand($screenNames);
        $screenName = $screenNames[$index];
        $description = $descriptions[$index];

        return [
            'screen_name' => $screenName, // Chọn ngẫu nhiên tên tiếng Việt
            'screen_code' => $screenCode, // Ví dụ: MH_XYZ
            'screen_description' => $this->faker->optional(0.8)->randomElement($descriptions), // 80% có mô tả
            'status' => $this->faker->randomElement([0, 1]), // Trạng thái: 0 (tắt) hoặc 1 (bật)
            'sequence' => $this->faker->numberBetween(1, 100), // Thứ tự từ 1 đến 100
            'version' => 1, // Phiên bản mặc định
            'created_user_id' => 1, // ID người tạo
            'updated_user_id' => 1, // ID người cập nhật
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
