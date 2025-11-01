<?php

namespace Database\Factories;

use App\Models\Permission;
use App\Models\Screen;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PermissionScreen>
 */
class PermissionScreenFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'permission_id' => Permission::factory(),
            'screen_id' => Screen::factory(),
            'is_view' => $this->faker->boolean(),
            'is_add' => $this->faker->boolean(),
            'is_edit' => $this->faker->boolean(),
            'is_delete' => $this->faker->boolean(),
            'is_scan' => $this->faker->boolean(),
        ];
    }
}
