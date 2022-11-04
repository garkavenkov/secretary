<?php

namespace Database\Factories;

use App\Models\Council;
use App\Models\SettlementType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Settlement>
 */
class SettlementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'council_id'            =>  Council::factory(),
            'settlement_type_id'    =>  SettlementType::factory(),
            'name'                  =>  $this->faker->city(),
            'postcode'              =>  $this->faker->unique()->postcode()
        ];
    }
}
