<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FacultyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'faculty_code' => $this->faker->unique()->lexify('F??'),
            'faculty_name' => 'Khoa ' . $this->faker->company(),
            'faculty_dean' => $this->faker->name(),
            'faculty_email' => $this->faker->safeEmail(),
            'faculty_phone' => $this->faker->phoneNumber(),
            'faculty_established_date' => $this->faker->date(),
        ];
    }
}