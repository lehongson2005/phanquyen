<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FacultyFactory extends Factory
{
    protected $model = \App\Models\Faculty::class;

    public function definition(): array
    {
        // Danh sách tên khoa
        $facultyNames = [
            'Công nghệ Thông tin',
            'Kế toán',
            'Quản trị Kinh doanh',
            'Ngôn ngữ Anh',
            'Công nghệ Kỹ thuật Cơ khí',
            'Y Dược',
            'Luật',
            'Điện tử Viễn thông',
            'Kiến trúc',
            'Khoa học Tự nhiên',
        ];

        // Danh sách mô tả khoa
        $descriptions = [
            'Khoa cung cấp chương trình đào tạo công nghệ tiên tiến.',
            'Đào tạo chuyên sâu về kế toán và tài chính.',
            'Chương trình học tập trung vào quản lý và kinh doanh.',
            'Đào tạo ngôn ngữ Anh chất lượng cao.',
            'Khoa chuyên về kỹ thuật cơ khí và tự động hóa.',
            'Đào tạo nhân lực ngành y tế và dược phẩm.',
            'Chương trình đào tạo luật sư và tư vấn pháp lý.',
            'Đào tạo kỹ sư điện tử và viễn thông hiện đại.',
            'Khoa chuyên về thiết kế và quy hoạch kiến trúc.',
            'Nghiên cứu và giảng dạy các môn khoa học cơ bản.',
        ];

        // Danh sách tên trưởng khoa
        $deans = [
            'TS. Nguyễn Văn Hùng',
            'PGS.TS. Trần Thị Mai',
            'GS.TS. Lê Hoàng Anh',
            'TS. Phạm Quốc Tuấn',
            'PGS.TS. Vũ Thị Hồng',
            'TS. Đặng Minh Châu',
            'GS.TS. Hoàng Văn Nam',
            'TS. Ngô Thị Lan',
            'PGS.TS. Bùi Văn Tâm',
            'TS. Đỗ Thị Ngọc',
        ];

        // Danh sách địa chỉ
        $addresses = [
            'Tòa A1, Đại học Quốc gia, Quận Cầu Giấy, Hà Nội',
            'Tòa B2, Đường Nguyễn Huệ, Quận 1, TP Hồ Chí Minh',
            'Số 123, Đường Lê Lợi, TP Đà Nẵng',
            'Số 45, Đường Trần Phú, TP Hải Phòng',
            'Tòa C3, Đường 3/2, TP Cần Thơ',
        ];

        // Tạo mã khoa: 1 chữ cái + 3 số
        $facultyCode = $this->faker->unique()->regexify('[A-Z]{1}[0-9]{3}');

        // Chọn tên khoa ngẫu nhiên
        $index = array_rand($facultyNames);
        $name = $facultyNames[$index];
        $description = $descriptions[$index]; // Mô tả tương ứng với tên khoa

        return [
            'faculty_code' => $facultyCode, // Mã khoa: ví dụ K123
            'faculty_name' => $name, // Tên khoa
            'faculty_description' => $this->faker->optional(0.8)->randomElement($descriptions), // 80% có mô tả
            'faculty_dean' => $this->faker->randomElement($deans), // Trưởng khoa
            'faculty_email' => strtolower('khoa.' . str_replace(' ', '.', $name)) . '@university.edu.vn', // Email khoa
            'faculty_phone' => $this->faker->numerify('02########'), // Số điện thoại cố định
            'faculty_address' => $this->faker->randomElement($addresses), // Địa chỉ cụ thể
            'faculty_total_students' => $this->faker->numberBetween(50, 2000), // Tổng số sinh viên
            'faculty_total_teachers' => $this->faker->numberBetween(5, 200), // Tổng số giảng viên
            'faculty_established_date' => $this->faker->dateTimeBetween('-50 years', '-5 years')->format('Y-m-d'), // Ngày thành lập
            'faculty_status' => $this->faker->randomElement([0, 1]), // Trạng thái: 0 (tắt) hoặc 1 (bật)
            'faculty_sequence' => $this->faker->numberBetween(1, 100), // Thứ tự
            'faculty_version' => 1, // Phiên bản
            'faculty_created_user_id' => 1, // ID người tạo
            'faculty_updated_user_id' => 1, // ID người cập nhật
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}