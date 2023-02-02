<?php

namespace Database\Factories;

use App\Models\FamilyRelationshipType;
use App\Models\HouseholdMember;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FamilyRelationship>
 */
class FamilyRelationshipFactory extends Factory
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
            'relationship_type_id'  =>  FamilyRelationshipType::factory(),
            'relative_id'           =>  HouseholdMember::factory(),
        ];
    }
}
