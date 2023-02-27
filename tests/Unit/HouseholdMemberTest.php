<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\MovementType;
use App\Models\AdditionalParam;
use App\Models\HouseholdMember;
use App\Models\HouseholdMemberLand;
use App\Models\AdditionalParamValue;
use App\Models\AdditionalParamCategory;
use App\Models\FamilyRelationship;
use App\Models\FamilyRelationshipType;
use App\Models\HouseholdMemberMovement;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HouseholdMemberTest extends TestCase
{

    use RefreshDatabase;

    public function test_household_member_may_have_movements()
    {
        $member = HouseholdMember::factory()->create();
        $movement_type = MovementType::factory()->create(['code' => 'register']);

        HouseholdMemberMovement::factory()->create([
            'member_id'         =>  $member->id,
            'movement_type_id'  =>  $movement_type->id,
        ]);

        $this->assertCount(1, $member->movements);
    }

    public function test_household_member_should_have_full_years_age()
    {
        $member = HouseholdMember::factory()->create(['birthdate' => '2000-12-12']);
        $this->assertEquals(22, $member->full_age);
    }

    public function test_count_members_depending_on_sex()
    {
        HouseholdMember::factory()->count(5)->create(['sex' => 'чоловіча']);
        HouseholdMember::factory()->count(10)->create(['sex' => 'жіноча']);

        $this->assertCount(5, HouseholdMember::male()->get());
        $this->assertCount(10, HouseholdMember::female()->get());
    }

    public function test_count_dead_members()
    {
        HouseholdMember::factory()->count(2)->create();
        HouseholdMember::factory()->count(3)->create(['death_date' => '2000-01-01']);

        $this->assertCount(3, HouseholdMember::dead()->get());
    }

    public function test_count_alive_members()
    {
        HouseholdMember::factory()->create();
        HouseholdMember::factory()->create(['death_date' => '2023-01-01']);

        $this->assertCount(1, HouseholdMember::alive()->get());
    }

    public function test_count_alive_members_on_date()
    {
        HouseholdMember::factory()->create();
        HouseholdMember::factory()->create(['death_date' => '2023-01-01']);

        $this->assertCount(2, HouseholdMember::alive(date: '2022-12-31')->get());
    }

    public function test_count_members_were_born_on_date()
    {
        HouseholdMember::factory()->count(2)->create();
        HouseholdMember::factory()->count(2)->create(['birthdate' => date('Y-m-d')]);

        $this->assertCount(2, HouseholdMember::alive()->born()->get());
    }

    public function test_member_movement_event_on_date()
    {
        $m = HouseholdMember::factory()->create();

        HouseholdMemberMovement::factory()->create(['member_id' => $m->id, 'date' => '2020-01-01']);
        HouseholdMemberMovement::factory()->create(['member_id' => $m->id, 'date' => '2021-01-01']);
        HouseholdMemberMovement::factory()->create(['member_id' => $m->id, 'date' => '2022-01-01']);
        HouseholdMemberMovement::factory()->create(['member_id' => $m->id, 'date' => '2023-01-01']);

        $this->assertEquals($m->movement('2022-06-06')->date, '2022-01-01');

    }

    public function test_member_may_have_land()
    {
        $m = HouseholdMember::factory()->create();

        HouseholdMemberLand::factory()->create(['member_id' => $m->id, 'year' => 2021]);
        HouseholdMemberLand::factory()->create(['member_id' => $m->id, 'year' => 2022]);
        HouseholdMemberLand::factory()->create(['member_id' => $m->id, 'year' => 2023]);

        $this->assertCount(3, $m->land);
    }

    public function test_member_land_information_MUST_BE_DELETED_during_member_deleting()
    {
        $m = HouseholdMember::factory()->create();

        HouseholdMemberLand::factory()->create(['member_id' => $m->id, 'year' => 2021]);
        HouseholdMemberLand::factory()->create(['member_id' => $m->id, 'year' => 2022]);
        HouseholdMemberLand::factory()->create(['member_id' => $m->id, 'year' => 2023]);

        $m->delete();

        $this->assertDatabaseMissing('household_member_lands', ['member_id' => $m->id]);
    }

    public function test_member_additional_information_MUST_BE_DELETED_during_member_deleting()
    {
        $m = HouseholdMember::factory()->create();

        $apc = AdditionalParamCategory::factory()->create(['code' => 'App\Models\HouseholdMember']);
        $ap = AdditionalParam::factory()->create(['category_id' => $apc->id, 'code' => 'passport_seria']);
        AdditionalParamValue::factory()->create([
            'param_id'  =>  $ap->id,
            'owner_id'  =>  $m->id,
            'value'     =>  'AA'
        ]);

        $m->delete();

        $this->assertDatabaseMissing('additional_param_values', ['owner_id' => $m->id, 'param_id' => $ap->id]);
    }

    public function test_member_movements_MUST_BE_DELETED_during_member_deleting()
    {
        $m = HouseholdMember::factory()->create();

        $mt = MovementType::factory()->create();
        HouseholdMemberMovement::factory()->create(['member_id' => $m->id, 'movement_type_id' => $mt->id]);

        $m->delete();

        $this->assertDatabaseMissing('household_member_movements', ['member_id' => $m->id]);
    }

    public function test_member_family_relationships_MUST_BE_DELETED_during_member_deleting()
    {
        $m = HouseholdMember::factory()->create();
        $r = HouseholdMember::factory()->create();

        $relation_type_1 = FamilyRelationshipType::factory()->create();
        $relation_type_2 = FamilyRelationshipType::factory()->create();

        FamilyRelationship::factory()->create(['member_id' => $m->id, 'relationship_type_id' => $relation_type_1->id, 'relative_id' => $r->id]);
        FamilyRelationship::factory()->create(['member_id' => $r->id, 'relationship_type_id' => $relation_type_2->id, 'relative_id' => $m->id]);

        $m->delete();

        $this->assertDatabaseMissing('family_relationships', ['member_id' => $m->id]);
        $this->assertDatabaseMissing('family_relationships', ['relative_id' => $m->id]);
    }

}
