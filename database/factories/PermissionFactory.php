<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permission>
 */
class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code'          =>  $this->faker->unique()->sentence(1),
            'name'          =>  $this->faker->unique()->sentence(1),
            // 'description'   =>  $this->faker->sentence(3),
            'error'         =>  $this->faker->sentence(3),
        ];
    }
}
