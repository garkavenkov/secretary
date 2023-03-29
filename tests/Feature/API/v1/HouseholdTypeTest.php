<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\HouseholdType;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HouseholdTypeTest extends TestCase
{
    use RefreshDatabase;

    private $url;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = "api/v1/household-types";

        $this->loginWithPermission('App\Models\HouseholdType', 15);

    }

    public function test_api_should_return_household_types()
    {
        HouseholdType::factory()->count(3)->create();

        $response = $this->get($this->url)->getData();

        $this->assertCount(3, $response->data);
    }

    public function test_api_should_return_single_type()
    {
        $type = HouseholdType::factory()->create();

        $response = $this->get("$this->url/$type->id")->getData();

        $this->assertEquals($type->name, $response->data->name);
    }

    public function test_api_should_create_household_type()
    {
        $type = HouseholdType::factory()->make();

        $this->post("$this->url", $type->toArray())->assertStatus(201);

        $this->assertDatabaseHas('household_types', ['name' => $type->name]);
    }

    public function test_api_should_update_household_type()
    {
        $type = HouseholdType::factory()->create(['name' => 'Name for update']);

        $data = $type->toArray();
        $data['name'] = 'Updated name';

        $this->patch("$this->url/$type->id", $data)->assertStatus(200);

        $this->assertDatabaseHas('household_types', ['name' => $data['name']]);
    }

    public function test_api_should_delete_type()
    {
        $type = HouseholdType::factory()->create();

        $this->delete("$this->url/$type->id")->assertStatus(200);

        $this->assertDatabaseMissing('household_types', ['id' => $type->id]);
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_api_MUST_NOT_create_household_type_id_data_did_not_pass_validation($field, $value)
    {
        HouseholdType::factory()->create(['name' => 'type']);
        $type = HouseholdType::factory()->make([$field => $value])->toArray();

        $this->post($this->url, $type)->assertSessionHasErrors($field);

        $this->assertDatabaseCount('household_types', 1);
    }

    public function dataProvider(): array
    {
        return [
            'name is empty'             =>  ['name',   ''   ],
            'name is not long enough'   =>  ['name',   'qw' ],
            'name is already exists'    =>  ['name',   'type']
        ];
    }
}
