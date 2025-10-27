<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        // Mã niên khóa: 22211, 23211, 24211
        $yearCode = $this->faker->randomElement(['22211', '23211', '24211']);
        // Mã ngành học
        $majorCode = $this->faker->randomElement(['TT', 'KT', 'QT', 'NN', 'CK']);
        // Số ngẫu nhiên 4 chữ số
        $randomNumber = str_pad($this->faker->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT);
        $userStudentCode = $yearCode . $majorCode . $randomNumber;

        // Danh sách họ, tên đệm, tên
        $firstNames = ['An', 'Bình', 'Chi', 'Dũng', 'Giang', 'Hà', 'Hoàng', 'Huy', 'Khánh', 'Lan', 'Linh', 'Minh', 'Nam', 'Nga', 'Ngọc', 'Phong', 'Quân', 'Quỳnh', 'Thảo', 'Trang', 'Trung', 'Tú', 'Việt', 'Yến'];
        $lastNames = ['Nguyễn', 'Trần', 'Lê', 'Phạm', 'Hoàng', 'Phan', 'Vũ', 'Đặng', 'Bùi', 'Đỗ', 'Hồ', 'Ngô', 'Dương', 'Lý'];
        $middleNames = ['Văn', 'Thị', 'Xuân', 'Minh', 'Thanh', 'Công', 'Đức', 'Hữu', 'Quốc', 'Kim'];

        // Tạo tên đầy đủ
        $firstName = $this->faker->randomElement($firstNames);
        $lastName = $this->faker->randomElement($lastNames);
        $middleName = $this->faker->randomElement($middleNames);
        $fullName = $lastName . ' ' . $middleName . ' ' . $firstName;

        // Danh sách mô tả ghi chú
        $notes = [
            'Sinh viên đạt học bổng kỳ trước.',
            'Tham gia câu lạc bộ lập trình.',
            'Hoàn thành khóa học bổ trợ.',
            'Cần bổ sung giấy tờ nhập học.',
            'Tham gia hoạt động ngoại khóa tích cực.',
        ];

        // Danh sách địa chỉ cụ thể hơn
        $addresses = [
            'Số 123, Đường Láng, Quận Đống Đa, Hà Nội',
            'Số 45, Đường Nguyễn Huệ, Quận 1, TP Hồ Chí Minh',
            'Số 78, Đường Lê Lợi, TP Đà Nẵng',
            'Số 12, Đường Trần Phú, TP Hải Phòng',
            'Số 56, Đường 3/2, TP Cần Thơ',
        ];

        return [
            'user_student_code' => $userStudentCode, // Mã sinh viên: ví dụ 22211TT1234
            'user_full_name' => $fullName, // Tên đầy đủ: ví dụ Nguyễn Văn An
            'user_first_name' => $firstName, // Tên
            'user_last_name' => $lastName, // Họ
            'user_gender' => $this->faker->randomElement(['Nam', 'Nữ']), // Giới tính
            'user_date_of_birth' => $this->faker->dateTimeBetween('-25 years', '-18 years')->format('Y-m-d'), // Ngày sinh
            'user_avatar' => $this->faker->imageUrl(200, 200, 'people'), // URL avatar ngẫu nhiên

            'user_email' => strtolower(str_replace(' ', '.', $firstName . '.' . $lastName)) . $this->faker->numberBetween(1, 99) . '@sinhvien.university.edu.vn', // Email sinh viên
            'user_phone_number' => $this->faker->numerify('09########'), // Số điện thoại
            'user_address' => $this->faker->randomElement($addresses), // Địa chỉ cụ thể
            'user_city' => $this->faker->randomElement(['Hà Nội', 'TP Hồ Chí Minh', 'Đà Nẵng', 'Hải Phòng', 'Cần Thơ']), // Thành phố
            'user_country' => 'Việt Nam', // Quốc gia

            'user_student_id_card' => $this->faker->numerify('##########'), // CMND/CCCD
            'user_faculty_id' => $this->faker->numberBetween(1, 5), // ID khoa
            'user_class_id' => $this->faker->numberBetween(1, 10), // ID lớp
            'user_major' => $this->getMajorName($majorCode), // Ngành học
            'user_course_year' => $this->getCourseYear($yearCode), // Năm nhập học
            'user_status' => $this->faker->randomElement(['Đang học', 'Bỏ Học', 'Tạm nghỉ']), // Trạng thái

            'user_username' => strtolower($firstName . '.' . $lastName) . $this->faker->numberBetween(10, 99), // Tên đăng nhập
            'user_password' => static::$password ??= Hash::make('Matkhau123@'), // Mật khẩu mặc định
            'user_email_verified_at' => now(), // Thời gian xác minh email
            'user_last_login_at' => $this->faker->optional()->dateTimeThisMonth(), // Thời gian đăng nhập gần nhất
            'user_remember_token' => Str::random(10), // Token nhớ đăng nhập
            'user_is_active' => true, // Trạng thái hoạt động

            'user_social_id' => $this->faker->optional()->numerify('############'), // ID mạng xã hội
            'user_emergency_contact_name' => $lastName . ' ' . $this->faker->randomElement(['Văn Anh', 'Thị Bình', 'Văn Cường', 'Thị Dung', 'Quốc Hưng']), // Người liên hệ khẩn cấp
            'user_emergency_contact_phone' => $this->faker->numerify('09########'), // Số điện thoại khẩn cấp
            'user_note' => $this->faker->optional(0.7)->randomElement($notes), // Ghi chú (70% có)

            'status' => 1, // Trạng thái hệ thống
            'sequence' => $this->faker->numberBetween(1, 100), // Thứ tự
            'version' => 1, // Phiên bản
            'created_user_id' => 1, // ID người tạo
            'updated_user_id' => 1, // ID người cập nhật
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    private function getMajorName(string $majorCode): string
    {
        $majors = [
            'TT' => 'Công nghệ Thông tin',
            'KT' => 'Kế toán',
            'QT' => 'Quản trị Kinh doanh',
            'NN' => 'Ngôn ngữ Anh',
            'CK' => 'Công nghệ Kỹ thuật Cơ khí',
        ];

        return $majors[$majorCode] ?? 'Công nghệ Thông tin';
    }

    private function getCourseYear(string $yearCode): int
    {
        $baseYear = 2000 + (int)substr($yearCode, 1, 2);
        $yearLevel = (int)substr($yearCode, 0, 1);
        return $baseYear - $yearLevel + 1;
    }
}