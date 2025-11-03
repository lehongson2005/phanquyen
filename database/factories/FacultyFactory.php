<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FacultyFactory extends Factory
{
    public function definition()
    {
        return [
            'faculty_code' => '',
            'faculty_name' => '',
            'faculty_description' => '',
            'faculty_dean' => $this->faker->name(),
            'faculty_email' => '',
            'faculty_phone' => $this->faker->numerify('028#######'),
            'faculty_address' => $this->faker->address(),
            'faculty_total_students' => $this->faker->numberBetween(500, 3000),
            'faculty_total_teachers' => $this->faker->numberBetween(20, 100),
            'faculty_established_date' => $this->faker->dateTimeBetween('-20 years', '-5 years')->format('Y-m-d'),
            'faculty_status' => 1,
            'faculty_sequence' => 0,
            'faculty_version' => 1,
            'faculty_created_user_id' => 1,
            'faculty_updated_user_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}