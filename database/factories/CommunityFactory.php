<?php

namespace Database\Factories;

use App\Models\District;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Community>
 */
class CommunityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // $edrpou = implode("", $this->faker->unique()->randomElements($array = array ('0','1','2', '3', '4', '5', '6', '7', '8', '9'), $count = 8));
        // $koatuu = implode("", $this->faker->unique()->randomElements($array = array ('0','1','2', '3', '4', '5', '6', '7', '8', '9'), $count = 10));
        return [
            'district_id'   =>  District::factory(),
            'name'          =>  $this->faker->sentence(3),
            'address'       =>  $this->faker->cityAndRegion() . ", " . $this->faker->streetName(),
            // 'edrpou'        =>  $edrpou,
            // 'koatuu'        =>  $koatuu
            'edrpou'        =>  $this->faker->unique()->regexify('[0-9]{8}'),
            'koatuu'        =>  $this->faker->unique()->regexify('[0-9]{10}'),
        ];
    }
}
