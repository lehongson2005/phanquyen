<?php

namespace Database\Factories;

use App\Models\Faculty;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassModelFactory extends Factory
{
    public function definition(): array
    {
        return [
            'class_code' => $this->faker->unique()->lexify('C??##'),
            'class_name' => 'Lớp ' . $this->faker->jobTitle(),
            'class_faculty_id' => Faculty::inRandomOrder()->first()?->faculty_id ?? Faculty::factory(),
            'class_major' => 'Công nghệ thông tin',
            'class_course_year' => '2024',
            'class_teacher_in_charge' => $this->faker->name(),
        ];
    }
}