<?php

namespace Database\Factories;

use App\Models\Household;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HouseholdLand>
 */
class HouseholdLandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'household_id'                  =>  Household::factory(),
            'year'                          =>  $this->faker->numberBetween(2015, 2025),
            // 'purpose'                       =>  $this->faker->randomFloat(3, 1, 3),
            'maintenance'                   =>  $this->faker->randomFloat(3, 1, 3),
            'personal_agriculture'          =>  $this->faker->randomFloat(3, 1, 3),
            'commercial_agriculture'        =>  $this->faker->randomFloat(3, 1, 3),
            // 'arable'                        =>  $this->faker->randomFloat(3, 1, 3),
            // 'perennial_plantations'         =>  $this->faker->randomFloat(3, 1, 3),
            // 'pastures'                      =>  $this->faker->randomFloat(3, 1, 3),
        ];
    }
}
