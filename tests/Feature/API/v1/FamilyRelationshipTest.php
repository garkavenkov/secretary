<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\FamilyRelationship;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;

class FamilyRelationshipTest extends TestCase
{
    use RefreshDatabase;

    private $url;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = '/api/v1/family-relationships';
    }

    public function test_api_should_return_relationships()
    {
        FamilyRelationship::factory()->count(3)->create();

        $response = $this->get($this->url)->getData();

        $this->assertCount(3, $response->data);
    }

    public function test_api_should_return_single_relationship()
    {
        $relationship = FamilyRelationship::factory()->create(['name' => 'голова домогосподарства']);

        $response = $this->get("$this->url/$relationship->id")->getData();

        $this->assertEquals($relationship->name, $response->data->name);
    }

    public function test_api_should_create_relationship()
    {
        $relationship = FamilyRelationship::factory()->make(['name' => 'голова домогосподарства'])->toArray();

        $this->post($this->url, $relationship)->assertStatus(201);

        $this->assertDatabaseHas('family_relationships', ['name' => $relationship['name']]);
    }

    public function test_api_should_update_relationship()
    {
        $relationship = FamilyRelationship::factory()->create(['name' => 'голова']);

        $data = $relationship->toArray();
        $data['name'] = 'голова домогосподарства';

        $this->patch("$this->url/$relationship->id", $data)->assertStatus(200);

        $this->assertDatabaseHas('family_relationships', ['name' => $data['name']]);
    }

    public function test_api_should_delete_relationship()
    {
        $relationship = FamilyRelationship::factory()->create();

        $this->delete("$this->url/$relationship->id")->assertStatus(200);

        $this->assertDatabaseMissing('family_relationships', ['id' => $relationship->id]);
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_api_MUST_NOT_create_relationship_if_data_did_not_pass_validation($field, $value)
    {
        FamilyRelationship::factory()->create(['name' => 'голова домогосподарства']);
        $relationship = FamilyRelationship::factory()->make([$field => $value])->toArray();

        $this->post($this->url, $relationship)->assertSessionHasErrors($field);

        $this->assertDatabaseCount('family_relationships', 1);
    }

    public function dataProvider(): array
    {
        return [
            'name is empty'             =>  ['name',    ''],
            'name is not long enough'   =>  ['name',    'qw'],
            'name is already exists'    =>  ['name',    'голова домогосподарства']
        ];
    }
}
