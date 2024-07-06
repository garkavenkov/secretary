<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ModelAttribute>
 */
class ModelAttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $code = $this->faker->unique()->sentence(1);
        return [
            'model'     =>  $this->faker->unique()->sentence(2),
            'code'      =>  $code,
            'name'      =>  $code,       
        ];
    }
}
