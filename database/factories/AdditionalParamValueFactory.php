<?php

namespace Database\Factories;

use App\Models\AdditionalParam;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdditionalParamValue>
 */
class AdditionalParamValueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'param_id'      =>  AdditionalParam::factory(),
            'owner_id'      =>  $this->faker->randomNumber(3),
            'value'         =>  $this->faker->sentence(1)
        ];
    }
}
