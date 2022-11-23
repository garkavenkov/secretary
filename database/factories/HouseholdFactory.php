<?php

namespace Database\Factories;

use App\Models\Community;
use App\Models\HouseholdType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Household>
 */
class HouseholdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'community_id'      =>  Community::factory(),
            'household_type_id' =>  HouseholdType::factory(),
            'address'           =>  $this->faker->address(),
            'special_marks'     =>  $this->faker->sentence(5),
            'additional_data'   =>  $this->faker->sentence(2)
        ];
    }
}
