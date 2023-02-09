<?php

namespace Database\Factories;

use App\Models\AdditionalParamCategory;
use App\Models\AdditionalParamValueType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdditionalParam>
 */
class AdditionalParamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category_id'   =>  AdditionalParamCategory::factory(),
            'code'          =>  $this->faker->unique()->sentence(1),
            'name'          =>  $this->faker->unique()->sentence(2),
            'value_type_id' =>  AdditionalParamValueType::factory(),
            'is_system'     =>  $this->faker->boolean(),
        ];
    }
}
