<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\FamilyRelationshipType;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FamilyRelationshipTypeTest extends TestCase
{
    use RefreshDatabase;

    private $url;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = '/api/v1/family-relationship-types';

        $this->loginWithPermission('App\Models\FamilyRelationshipType', 15);
    }

    public function test_api_should_return_relationship_types()
    {
        FamilyRelationshipType::factory()->count(3)->create();

        $response = $this->get($this->url)->getData();

        $this->assertCount(3, $response->data);
    }

    public function test_api_should_return_single_relationship_type()
    {
        $type = FamilyRelationshipType::factory()->create(['name' => 'голова домогосподарства']);

        $response = $this->get("$this->url/$type->id")->getData();

        $this->assertEquals($type->name, $response->data->name);
    }

    public function test_api_should_create_relationship_type()
    {
        $type = FamilyRelationshipType::factory()->make(['name' => 'голова домогосподарства'])->toArray();

        $this->post($this->url, $type)->assertStatus(201);

        $this->assertDatabaseHas('family_relationship_types', ['name' => $type['name']]);
    }

    public function test_api_should_update_relationship_type()
    {
        $type = FamilyRelationshipType::factory()->create(['name' => 'голова']);

        $data = $type->toArray();
        $data['name'] = 'голова домогосподарства';

        $this->patch("$this->url/$type->id", $data)->assertStatus(200);

        $this->assertDatabaseHas('family_relationship_types', ['name' => $data['name']]);
    }

    public function test_api_should_delete_relationship_type()
    {
        $type = FamilyRelationshipType::factory()->create();

        $this->delete("$this->url/$type->id")->assertStatus(200);

        $this->assertDatabaseMissing('family_relationship_types', ['id' => $type->id]);
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_api_MUST_NOT_create_relationship_type_if_data_did_not_pass_validation($field, $value)
    {
        FamilyRelationshipType::factory()->create(['name' => 'голова домогосподарства']);
        $type = FamilyRelationshipType::factory()->make([$field => $value])->toArray();

        $this->post($this->url, $type)->assertSessionHasErrors($field);

        $this->assertDatabaseCount('family_relationship_types', 1);
    }

    public function dataProvider(): array
    {
        return [
            'name is empty'             =>  ['name',    ''],
            'name is not long enough'   =>  ['name',    'qw'],
            'name is already exists'    =>  ['name',    'голова домогосподарства']
        ];
    }

    /**
     * Custom messages for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required'                 =>  'Ви не вказали назву типу родинних відносин',
            'name.min'                      =>  'Назва типу родинних відносин повинна бути більш ніж :min символів',
            'name.unique'                   =>  'Тип родинних відносин с такою назвою вже існує',
        ];
    }
}
