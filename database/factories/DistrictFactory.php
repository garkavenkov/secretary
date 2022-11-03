<?php

namespace Database\Factories;

use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\District>
 */
class DistrictFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'region_id' =>  Region::factory(),
            'name'      =>  $this->faker->sentence(2),
            'center'    =>  $this->faker->sentence(1)
        ];
    }
}
