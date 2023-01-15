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
                        ->make(['member_id' => $member->id])
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

    /**
     * @dataProvider dataProvider
     */
    public function test_api_MUST_NOT_create_movement_event_when_data_did_not_pass_validation($field, $value)
    {
        $movement = HouseholdMemberMovement::factory()
                        ->make([$field => $value])
                        ->toArray();

        $this->post($this->url, $movement)->assertSessionHasErrors($field);

        $this->assertDatabaseCount('household_member_movements', 0);
    }

    public function dataProvider(): array
    {
        return [
            'member is null'                    =>  ['member_id',           ''],
            'member does not exist'             =>  ['member_id',           99],
            'movement_type is null'             =>  ['movement_type_id',    ''],
            'movement_type does not exist'      =>  ['movement_type_id',    99],
            'date is null'                      =>  ['date',                ''],
            'date is not in date format'        =>  ['date',             'asd'],
            'comment is empty'                  =>  ['comment',             ''],
            'comment is not long enough'        =>  ['comment',           'qw'],
        ];
    }
}
