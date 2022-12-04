<?php

namespace Database\Factories;

use App\Models\Household;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HouseholdHouse>
 */
class HouseholdHouseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'household_id'          =>  Household::factory(),
            'year'                  =>  $this->faker->numberBetween(2015, 2022),
            'total_area'            =>  $this->faker->randomFloat(2, 201, 250),
            'total_living_area'     =>  $this->faker->randomFloat(2, 181, 200),
            'living_area'           =>  $this->faker->randomFloat(2, 150, 180),
            'room_count'            =>  $this->faker->numberBetween(2, 5),
            'total_non_living_area' =>  $this->faker->randomFloat(2, 30, 80),
            'water_supply'          =>  $this->faker->boolean(),
            'hot_water_supply'      =>  $this->faker->boolean(),
            'sewage'                =>  $this->faker->boolean(),
            'central_heating'       =>  $this->faker->boolean(),
            'individual_heating'    =>  $this->faker->boolean(),
            'furnace_heating'       =>  $this->faker->boolean(),
            'natural_gas'           =>  $this->faker->boolean(),
            'liquefied_gas'         =>  $this->faker->boolean(),
            'electric_stove'        =>  $this->faker->boolean(),
        ];
    }
}
