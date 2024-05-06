<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'          =>  $this->faker->unique()->sentence(1),
            'description'   =>  $this->faker->sentence(3),            
            'path'          =>  $this->faker->sentence(3),
            'model'         =>  $this->faker->sentence(1),
        ];
    }
}
