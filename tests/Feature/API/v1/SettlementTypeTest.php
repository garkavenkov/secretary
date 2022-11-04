<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\SettlementType;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SettlementTypeTest extends TestCase
{
    use RefreshDatabase;

    private $url;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = "/api/v1/settlement-types";
    }

    public function test_api_should_return_settlement_types()
    {
        SettlementType::factory()->count(3)->create();

        $response = $this->get($this->url)->getData();

        $this->assertCount(3, $response->data);
    }

    public function test_api_should_return_single_settlement_type()
    {
        $type = SettlementType::factory()->create(['name' => 'Село']);

        $response = $this->get("$this->url/$type->id")->getData();

        $this->assertEquals('Село', $response->data->name);
    }

    public function test_api_should_create_settlement_type()
    {
        $type = SettlementType::factory()->make(['name' => 'Село']);

        $this->post($this->url, $type->toArray())->assertStatus(201);

        $this->assertDatabaseHas('settlement_types', ['name' => $type->name]);
    }

    public function test_api_should_update_settlement_type()
    {
        $type = SettlementType::factory()->create(['name' => 'село']);

        $data = $type->toArray();
        $data['name'] = 'Село';

        $this->patch("$this->url/$type->id", $data)->assertStatus(200);

        $this->assertDatabaseHas('settlement_types', ['name' => $data['name']]);
    }

    public function test_api_should_delete_settlement_type()
    {
        $type = SettlementType::factory()->create();

        $this->delete("$this->url/$type->id")->assertStatus(200);

        $this->assertDatabaseMissing('settlement_types', ['id' => $type->id]);
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_api_MUST_NOT_create_settlement_type_if_data_did_not_pass_validation($field, $value)
    {
        SettlementType::factory()->create(['name' => 'Село']);
        $type = SettlementType::factory()->make([$field => $value])->toArray();

        $this->post($this->url, $type)->assertSessionHasErrors($field);

        $this->assertDatabaseCount('settlement_types', 1);
    }

    public function dataProvider(): array
    {
        return [
            'name is empty'             =>  ['name',    ''],
            'name is not long enough'   =>  ['name',    'qw'],
            'name is already exists'    =>  ['name',    'Село']
        ];
    }
}
