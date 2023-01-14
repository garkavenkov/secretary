<?php

namespace Database\Factories;

use App\Models\HouseholdMember;
use App\Models\MovementType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HouseholdMemberMovement>
 */
class HouseholdMemberMovementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'member_id'         =>  HouseholdMember::factory(),
            'movement_type_id'  =>  MovementType::factory(),
            'date'              =>  $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'comment'           =>  $this->faker->sentence(5)
        ];
    }
}
