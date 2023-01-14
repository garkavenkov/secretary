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
}
