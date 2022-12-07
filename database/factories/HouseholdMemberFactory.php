<?php

namespace Database\Factories;

use App\Models\FamilyRelationship;
use App\Models\Household;
use App\Models\PlaceWork;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HouseholdMember>
 */
class HouseholdMemberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $sex = $this->faker->randomElement(['чоловіча', 'жіноча']);
        return [
            'household_id'              =>  Household::factory(),
            'surname'                   =>  $sex == 'чоловіча' ? $this->faker->lastName($gender = 'male') : $this->faker->lastName($gender = 'female'),
            'name'                      =>  $sex == 'чоловіча' ? $this->faker->firstName($gender = 'male') : $this->faker->firstName($gender = 'female'),
            'patronymic'                =>  $sex == 'чоловіча' ? $this->faker->middleName($gender = 'male') : $this->faker->middleName($gender = 'female'),
            'sex'                       =>  $sex,
            'birthday'                  =>  $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'family_relationship_id'    =>  FamilyRelationship::factory(),
            'employment_information'    =>  $this->faker->company(),
            'place_work_id'             =>  PlaceWork::factory()
        ];
    }
}
