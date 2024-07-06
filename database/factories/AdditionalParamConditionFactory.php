<?php

namespace Database\Factories;

use App\Models\AdditionalParam;
use App\Models\ModelAttribute;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdditionalParamCondition>
 */
class AdditionalParamConditionFactory extends Factory
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
            'attribute_id'  =>  ModelAttribute::factory(),
            'condition'     =>  '>=',
            'value'         =>  $this->faker->numberBetween(10, 30),
        ];
    }
}
