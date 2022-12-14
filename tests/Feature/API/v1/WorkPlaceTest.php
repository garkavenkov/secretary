<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\WorkPlace;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WorkPlaceTest extends TestCase
{
    use RefreshDatabase;

    private $url;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = "/api/v1/work-places";
    }

    public function test_api_should_return_places_of_work()
    {
        WorkPlace::factory()->count(3)->create();

        $response = $this->get($this->url)->getData();

        $this->assertCount(3, $response->data);
    }

    public function test_api_should_return_single_place_of_work()
    {
        $place = WorkPlace::factory()->create(['name' => 'за кордоном']);

        $response = $this->get("$this->url/$place->id")->getData();

        $this->assertEquals($place->name, $response->data->name);
    }

    public function test_api_should_create_place_of_work()
    {
        $place = WorkPlace::factory()->make(['name' => 'за кордоном']);

        $this->post($this->url, $place->toArray())->assertStatus(201);

        // $this->assertDatabaseHas('work_places', ['name' => $place->name]);
    }

    public function test_api_should_update_place_of_work()
    {
        $place = WorkPlace::factory()->create(['name' => 'кордоном']);

        $data = $place->toArray();
        $data['name'] = 'за кордоном';

        $this->patch("$this->url/$place->id", $data)->assertStatus(200);

        $this->assertDatabaseHas('work_places', ['name' => $data['name']]);
    }

    public function test_api_should_delete_place_of_work()
    {
        $place = WorkPlace::factory()->create();

        $this->delete("$this->url/$place->id")->assertStatus(200);

        $this->assertDatabaseMissing('work_places', ['id' => $place->id]);
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_api_MUST_NOT_create_place_of_work_if_data_did_not_pass_validation($field, $value)
    {
        WorkPlace::factory()->create(['name' => 'за кордоном']);
        $place = WorkPlace::factory()->make([$field => $value])->toArray();

        $this->post($this->url, $place)->assertSessionHasErrors($field);

        $this->assertDatabaseCount('work_places', 1);
    }

    public function dataProvider(): array
    {
        return [
            'name is empty'             =>  ['name',    ''  ],
            'name is not long enough'   =>  ['name',    'qw'],
            'name is already exists'    =>  ['name',    'за кордоном']
        ];
    }
}
