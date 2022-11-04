<?php

namespace Database\Factories;

use App\Models\Community;
use App\Models\CouncilType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Council>
 */
class CouncilFactory extends Factory
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
            'council_type_id'   =>  CouncilType::factory(),
            'name'              =>  $this->faker->sentence(3),
            'address'           =>  $this->faker->cityAndRegion() . ", " . $this->faker->streetName(),
            'edrpou'            =>  $this->faker->unique()->regexify('[0-9]{8}'),
            'koatuu'            =>  $this->faker->unique()->regexify('[0-9]{10}'),
        ];
    }
}
