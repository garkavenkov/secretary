<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\Position;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PositionTest extends TestCase
{
    use RefreshDatabase;

    private $url;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = '/api/v1/positions';
    }

    public function test_api_should_return_positions()
    {
        Position::factory()->count(5)->create();

        $response = $this->get($this->url)->getData();

        $this->assertCount(5, $response->data);
    }

    public function test_api_should_return_single_position()
    {
        $position =Position::factory()->create();

        $response = $this->get("$this->url/$position->id")->getData();

        $this->assertEquals($response->data->name, $position->name);
    }

    public function test_api_should_create_position()
    {
        $position = Position::factory()->make(['name' => 'position'])->toArray();

        $this->post($this->url, $position)->assertStatus(201);

        $this->assertCount(1, Position::all());
    }

    public function test_api_should_update_position()
    {
        $position =Position::factory()->create(['name' => 'Name for update']);

        $data = $position->toArray();
        $data['name'] = 'Updated name';

        $this->patch("$this->url/$position->id", $data)->assertStatus(200);

        $this->assertDatabaseHas('positions', ['id' => $position->id, 'name' => $data['name']]);
    }

    public function test_api_should_delete_position()
    {
        $position =Position::factory()->create();

        $this->delete("$this->url/$position->id")->assertStatus(200);

        $this->assertCount(0, Position::all());
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_api_MUST_NOT_create_position_if_data_did_not_pass_validation($field, $value)
    {
        Position::factory()->create(['name' => 'position']);

        $position =Position::factory()
                            ->make([$field => $value])
                            ->toArray();

        $this->post($this->url, $position)->assertSessionHasErrors($field);

        $this->assertCount(1,Position::all());
    }

    public function dataProvider(): array
    {
        return [
            'name is empty'                     =>  ['name',              ''],
            'name is not long enough'           =>  ['name',            'qw'],
            'name is already exists'            =>  ['name',      'position'],
            'description is empty'              =>  ['description',       ''],
            'description is not long enough'    =>  ['description',     'qw'],
        ];
    }
}
