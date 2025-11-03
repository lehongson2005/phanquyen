<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ScreenFactory extends Factory
{
    public function definition(): array
    {
        return [
            'screen_name' => 'Màn hình ' . $this->faker->word(),
            'screen_code' => $this->faker->unique()->lexify('SCREEN_???'),
            'screen_description' => $this->faker->sentence(),
        ];
    }
}
