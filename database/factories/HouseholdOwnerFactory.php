<?php

namespace Database\Factories;

use App\Models\Household;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HouseholdOwner>
 */
class HouseholdOwnerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'household_id'  =>  Household::factory(),
            'name'          =>  $this->faker->lastName . ' ' . $this->faker->firstName . ' ' . $this->faker->middleName,
            'address'       =>  $this->faker->address,
        ];
    }
}
