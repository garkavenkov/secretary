<?php

namespace Tests\Unit;

use App\Models\HouseholdMember;
use App\Models\HouseholdMemberMovement;
use App\Models\MovementType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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
        HouseholdMember::factory()->count(1)->create();
        HouseholdMember::factory()->count(1)->create(['death_date' => '2023-01-01']);

        $this->assertCount(1, HouseholdMember::alive()->get());
    }

    public function test_count_alive_members_on_date()
    {
        HouseholdMember::factory()->count(1)->create();
        HouseholdMember::factory()->count(1)->create(['death_date' => '2023-01-01']);

        $this->assertCount(2, HouseholdMember::alive(date: '2022-12-31')->get());
    }


}
