<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'permission_name' => $this->faker->word(),
            'permission_code' => $this->faker->unique()->lexify('PERM_???'),
            'permission_description' => $this->faker->sentence(),
        ];
    }
}