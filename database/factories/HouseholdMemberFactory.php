<?php

namespace Database\Factories;

use App\Models\Household;
use App\Models\WorkPlace;
use App\Models\FamilyRelationshipType;
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
        $birthdate = $this->faker->date($format = 'Y-m-d', $max = 'now');
        // $death_date = $this->faker->dateTimeBetween('+40 year', '+60 years');
        return [
            'household_id'                  =>  Household::factory(),
            'surname'                       =>  $sex == 'чоловіча' ? $this->faker->lastName($gender = 'male') : $this->faker->lastName($gender = 'female'),
            'name'                          =>  $sex == 'чоловіча' ? $this->faker->firstName($gender = 'male') : $this->faker->firstName($gender = 'female'),
            'patronymic'                    =>  $sex == 'чоловіча' ? $this->faker->middleName($gender = 'male') : $this->faker->middleName($gender = 'female'),
            'sex'                           =>  $sex,
            'birthdate'                     =>  $birthdate,            
            'family_relationship_type_id'   =>  FamilyRelationshipType::factory(),
            'employment_information'        =>  $this->faker->company(),
            'work_place_id'                 =>  WorkPlace::factory(),
            // 'death_date'                =>  $death_date,
        ];
    }
}
