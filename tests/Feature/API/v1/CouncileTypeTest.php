<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\CouncilType;
use Illuminate\Foundation\Testing\RefreshDatabase;


class CouncileTypeTest extends TestCase
{
    use RefreshDatabase;

    private $url;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = '/api/v1/council-types';
    }

    public function test_api_should_return_council_types()
    {
        CouncilType::factory()->count(3)->create();

        $response = $this->get($this->url)->getData();

        $this->assertCount(3, $response->data);
    }

    public function test_api_should_return_single_council_type()
    {
        $type = CouncilType::factory()->create(['name' => 'Сільська рада']);

        $response = $this->get("$this->url/$type->id")->getData();

        $this->assertEquals($type->name, $response->data->name);
    }

    public function test_api_should_create_council_type()
    {
        $type = CouncilType::factory()->make(['name' => 'Сільська рада']);

        $this->post($this->url, $type->toArray())->assertStatus(201);

        $this->assertDatabaseHas('council_types', ['name' => $type['name']]);
    }

    public function test_api_should_update_council_type()
    {
        $type = CouncilType::factory()->create(['name' => 'Сільська']);

        $data = $type->toArray();
        $data['name'] = 'Сільська рада';

        $this->patch("$this->url/$type->id", $data)->assertStatus(200);

        $this->assertDatabaseHas('council_types', ['name' => $data['name']]);
    }

    public function test_api_should_delete_council_type()
    {
        $type = CouncilType::factory()->create();

        $this->delete("$this->url/$type->id")->assertStatus(200);

        $this->assertDatabaseMissing('council_types', ['id' => $type->id]);
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_api_MUST_NOT_create_council_type_id_data_did_not_pass_validation($field, $value)
    {
        CouncilType::factory()->create(['name' => 'Сільська рада']);

        $type = CouncilType::factory()->make([$field => $value])->toArray();

        $this->post($this->url, $type)->assertSessionHasErrors($field);

        $this->assertDatabaseCount('council_types', 1);
    }

    public function dataProvider(): array
    {
        return [
            'name is null'              =>  ['name',    ''],
            'name is not long enough'   =>  ['name',    'qw'],
            'name is already exists'    =>  ['name',    'Сільська рада'],
        ];
    }
}
