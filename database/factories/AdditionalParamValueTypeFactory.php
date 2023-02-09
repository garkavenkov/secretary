<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdditionalParamValueType>
 */
class AdditionalParamValueTypeFactory extends Factory
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
            'code'          =>  $code,
            'name'          =>  $code,
            'description'   =>  $this->faker->sentence(3)
        ];
    }
}
