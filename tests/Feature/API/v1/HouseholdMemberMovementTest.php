<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\HouseholdMember;
use App\Models\HouseholdMemberMovement;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HouseholdMemberMovementTest extends TestCase
{
    use RefreshDatabase;

    protected $url = '/api/v1/household-member-movements';

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_api_should_return_movement_events()
    {
        $member = HouseholdMember::factory()->create();

        HouseholdMemberMovement::factory()->count(2)->create(['member_id' => $member->id]);

        $response = $this->get($this->url)->getData();

        $this->assertCount(2, $response->data);
    }

    public function test_api_should_create_ovement_event()
    {
        $member = HouseholdMember::factory()->create();

        $movement = HouseholdMemberMovement::factory()
                        ->create(['member_id' => $member->id])
                        ->toArray();

        $this->post($this->url, $movement)->assertStatus(201);

        $this->assertDatabaseHas('household_member_movements', ['member_id' => $member->id]);

    }

    public function test_api_should_delete_movement_event()
    {
        $movement = HouseholdMemberMovement::factory()
                        ->create();
        $this->delete("$this->url/$movement->id")->assertStatus(200);

        $this->assertDatabaseMissing('household_member_movements', ['id' => $movement->id]);
    }

    public function test_api_should_update_movement_event()
    {
        $movement = HouseholdMemberMovement::factory()
                        ->create([
                            'comment' => 'Comment for update'
                        ])
                        ->toArray();
        $data = $movement;
        $data['comment'] = 'Updated comment';

        $this->patch("$this->url/{$movement['id']}", $data)->assertStatus(200);

        $this->assertDatabaseHas('household_member_movements', ['id' => $movement['id'], 'comment' => 'Updated comment']);
    }
}
