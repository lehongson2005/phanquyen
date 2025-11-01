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
        return [
            'user_student_code' => 'SV' . $this->faker->unique()->numberBetween(1000, 9999),
            'user_full_name' => $this->faker->name(),
            'user_gender' => $this->faker->randomElement(['Nam', 'Nữ']),
            'user_date_of_birth' => $this->faker->date(),
            'user_email' => $this->faker->unique()->safeEmail(),
            'user_phone_number' => $this->faker->phoneNumber(),
            'user_major' => 'Kỹ thuật phần mềm',
            'user_course_year' => $this->faker->year(),
            'user_username' => $this->faker->unique()->userName(),
            'user_password' => static::$password ??= Hash::make('123456'),
            'user_email_verified_at' => now(),
            'user_is_active' => true,
        ];
    }
}