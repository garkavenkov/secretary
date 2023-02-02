<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\HouseholdMember;
use App\Models\FamilyRelationship;
use App\Models\FamilyRelationshipType;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FamilyRelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_relationship_have_member()
    {
        $member = HouseholdMember::factory()->create();

        $relationship = FamilyRelationship::factory()->create(['member_id' => $member->id]);

        $this->assertEquals($relationship->member->surname, $member->surname);
    }

    public function test_relationship_have_relative()
    {
        $relative = HouseholdMember::factory()->create();

        $relationship = FamilyRelationship::factory()->create(['relative_id' => $relative->id]);

        $this->assertEquals($relationship->relative->surname, $relative->surname);
    }

    public function test_relationship_have_relationship_type()
    {
        $type = FamilyRelationshipType::factory()->create();

        $relationship = FamilyRelationship::factory()->create(['relationship_type_id' => $type->id]);

        $this->assertEquals($relationship->type->name, $type->name);
    }
}
