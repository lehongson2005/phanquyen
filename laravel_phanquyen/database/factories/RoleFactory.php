<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'role_name' => $this->faker->jobTitle(),
            'role_code' => $this->faker->unique()->lexify('ROLE_???'),
            'role_description' => $this->faker->sentence(),
        ];
    }
}