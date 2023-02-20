<?php

namespace Database\Factories;

use App\Models\HouseholdMember;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HouseholdMemberLand>
 */
class HouseholdMemberLandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'member_id'             =>  HouseholdMember::factory(),
            'year'                  =>  $this->faker->numberBetween(2015, 2025),
            'maintenance'           =>  $this->faker->randomFloat(4, 1, 3),
            'personal_agriculture'  =>  $this->faker->randomFloat(4, 1, 3),
            'land_share'            =>  $this->faker->randomFloat(4, 1, 3),
            'property_share'        =>  $this->faker->randomFloat(4, 1, 3),
            'hay_cutting'           =>  $this->faker->randomFloat(4, 1, 3),
            'pastures'              =>  $this->faker->randomFloat(4, 1, 3),
        ];
    }
}
