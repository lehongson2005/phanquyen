<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ClassModelFactory extends Factory
{
    public function definition(): array
    {
        // Danh sách ngành học tiếng Việt
        $majors = [
            'Công nghệ Thông tin',
            'Kế toán',
            'Quản trị Kinh doanh',
            'Ngôn ngữ Anh',
            'Cơ khí',
            'Kỹ thuật Điện',
            'Luật',
            'Marketing',
            'Kiến trúc',
            'Y học',
        ];

        // Danh sách mô tả lớp học
        $descriptions = [
            'Lớp học chuyên ngành với đội ngũ giảng viên giàu kinh nghiệm.',
            'Khóa học cung cấp kiến thức thực tiễn và ứng dụng cao.',
            'Lớp học dành cho sinh viên yêu thích sáng tạo và đổi mới.',
            'Hỗ trợ sinh viên phát triển kỹ năng chuyên môn.',
            'Chương trình học kết hợp lý thuyết và thực hành.',
        ];

        // Danh sách tên giáo viên tiếng Việt
        $teachers = [
            'Nguyễn Văn Hùng',
            'Trần Thị Mai',
            'Lê Hoàng Anh',
            'Phạm Quốc Tuấn',
            'Vũ Thị Hồng',
            'Đặng Minh Châu',
            'Hoàng Văn Nam',
            'Ngô Thị Lan',
            'Bùi Văn Tâm',
            'Đỗ Thị Ngọc',
        ];

        // Danh sách tên sinh viên (lớp trưởng/phó)
        $students = [
            'Nguyễn Thanh Tùng',
            'Trần Thị Hồng Nhung',
            'Lê Minh Khang',
            'Phạm Thị Lan Anh',
            'Vũ Văn Đạt',
            'Đặng Thị Mai',
            'Hoàng Văn Long',
            'Ngô Thị Thúy',
            'Bùi Minh Đức',
            'Đỗ Thị Hà',
        ];

        // Danh sách ghi chú
        $notes = [
            'Lớp học tổ chức các buổi hội thảo chuyên đề.',
            'Cần hoàn thành bài tập nhóm trước hạn chót.',
            'Lớp có lịch học bổ sung vào cuối tuần.',
            'Sinh viên cần tham gia đầy đủ các buổi thực hành.',
            'Lớp học có hỗ trợ học bổng cho sinh viên xuất sắc.',
        ];

        // Mã lớp: Chữ cái + 3 số (ví dụ: A123, B456)
        $classCode = $this->faker->unique()->regexify('[A-Z]{1}[0-9]{3}');

        // Chọn ngành ngẫu nhiên
        $major = $this->faker->randomElement($majors);

        // Năm khóa học
        $courseYear = $this->faker->numberBetween(2018, 2025);

        return [
            'class_code' => $classCode, // Mã lớp: ví dụ A123
            'class_name' => $major . ' - Lớp ' . $this->faker->numberBetween(1, 10), // Ví dụ: Công nghệ Thông tin - Lớp 5
            'class_description' => $this->faker->optional(0.7)->randomElement($descriptions), // 70% có mô tả
            'class_faculty_id' => $this->faker->numberBetween(1, 5), // ID khoa từ 1 đến 5
            'class_major' => $major, // Ngành học
            'class_course_year' => $courseYear, // Năm khóa học
            'class_total_students' => $this->faker->numberBetween(20, 50), // Số lượng sinh viên
            'class_max_students' => 50, // Số lượng tối đa
            'class_teacher_in_charge' => $this->faker->randomElement($teachers), // Giáo viên chủ nhiệm
            'class_monitor' => $this->faker->randomElement($students), // Lớp trưởng
            'class_vice_monitor' => $this->faker->randomElement($students), // Lớp phó
            'class_note' => $this->faker->optional(0.7)->randomElement($notes), // 70% có ghi chú
            'class_status' => $this->faker->randomElement([0, 1]), // Trạng thái: 0 (tắt) hoặc 1 (bật)
            'class_sequence' => $this->faker->numberBetween(1, 100), // Thứ tự
            'class_version' => 1, // Phiên bản
            'class_created_user_id' => 1, // ID người tạo
            'class_updated_user_id' => 1, // ID người cập nhật
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}