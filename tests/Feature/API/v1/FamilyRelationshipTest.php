<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\FamilyRelationship;
use App\Models\HouseholdMember;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FamilyRelationshipTest extends TestCase
{
    use RefreshDatabase;

    private $url = '/api/v1/family-relationships';

    protected function setUp(): void
    {
        parent::setUp();
    }

    public function test_api_should_return_family_relationships()
    {
        FamilyRelationship::factory()->count(5)->create();

        $response = $this->get($this->url)->getData();

        $this->assertCount(5, $response->data);
    }

    public function test_api_should_return_relationship()
    {
        $rel = FamilyRelationship::factory()->create(['relative_id' => 5]);

        $response = $this->get("$this->url/$rel->id")->getData();

        $this->assertEquals($response->data->relative_id, 5);
    }

    public function test_api_should_create_relationship()
    {
        $rel = FamilyRelationship::factory()->make()->toArray();

        $this->post($this->url, $rel)->assertStatus(201);

        $this->assertDatabaseHas('family_relationships', ['member_id' => $rel['member_id'], 'relative_id' => $rel['relative_id']]);
    }

    public function test_api_should_update_relationship()
    {
        $rel = FamilyRelationship::factory()->create();
        $relative = HouseholdMember::factory()->create();

        $data = $rel->toArray();
        $data['relative_id'] = $relative->id;

        $this->patch("$this->url/$rel->id", $data)->assertStatus(200);

        $this->assertDatabaseHas('family_relationships', ['id' => $rel->id, 'relative_id' => $relative->id]);
    }

    public function test_api_should_delete_relationship()
    {
        $rel = FamilyRelationship::factory()->create();

        $this->delete("$this->url/$rel->id")->assertStatus(200);

        $this->assertDatabaseMissing('family_relationships', ['id' => $rel->id]);
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_api_MUST_NOT_create_relationship_if_data_did_not_pass_validation($field, $value)
    {
        $rel = FamilyRelationship::factory()->make([$field => $value])->toArray();

        $this->post($this->url, $rel)->assertSessionHasErrors($field);

        $this->assertDatabaseCount('family_relationships', 0);
    }

    public function dataProvider(): array
    {
        return [
            'member_id is null'             =>  ['member_id',               ''],
            'member_id does not exist'      =>  ['member_id',               99],
            'relation_type is null'         =>  ['relationship_type_id',    ''],
            'relation_type does not exist'  =>  ['relationship_type_id',    99],
            'relative_id is null'           =>  ['relative_id',             ''],
            'relative_id does not exist'    =>  ['relative_id',             99],
            'member and relative the same'  =>  ['relative_id',              1]
        ];
    }
}
