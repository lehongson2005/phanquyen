<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    // Đã sửa từ private thành protected
    protected $faker;

    public function __construct()
    {
        parent::__construct();
        // Ép buộc Faker phải dùng ngôn ngữ tiếng Việt, bỏ qua file config
        $this->faker = \Faker\Factory::create('vi_VN');
    }

    public function definition()
    {
        $mssv = '24211TT' . str_pad($this->faker->unique()->numberBetween(1, 9999), 4, '0', STR_PAD_LEFT);
        $email = strtolower($mssv) . '@gmail.tdc.edu.vn';

        return [
            'user_student_code' => $mssv,
            'user_full_name' => $this->faker->name(),
            'user_first_name' => $this->faker->firstName(),
            'user_last_name' => $this->faker->lastName(),
            'user_gender' => $this->faker->randomElement(['Nam', 'Nữ']),
            'user_date_of_birth' => $this->faker->dateTimeBetween('-25 years', '-18 years')->format('Y-m-d'),
            'user_email' => $email,
            'user_phone_number' => $this->faker->numerify('09########'),
            'user_address' => $this->faker->address(),
            'user_city' => $this->faker->city(),
            'user_country' => 'Vietnam',
            'user_faculty_id' => 1,
            'user_class_id' => 1,
            'user_major' => 'Công nghệ thông tin',
            'user_course_year' => '2024',
            'user_status' => 'Đang học',
            'user_username' => $mssv,
            'user_password' => Hash::make('password'),
            'user_email_verified_at' => now(),
            'user_last_login_at' => now(),
            'user_remember_token' => Str::random(10),
            'user_is_active' => true,
            'user_emergency_contact_name' => $this->faker->name(),
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
