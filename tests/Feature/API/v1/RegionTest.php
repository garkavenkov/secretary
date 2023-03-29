<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\Region;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegionTest extends TestCase
{
    use RefreshDatabase;

    private $url;

    protected function setUp(): void
    {
        parent::setUp();
        $this->url = "api/v1/regions";

        $this->loginWithPermission('App\Models\Region', 15);
    }

    public function test_api_should_return_regions()
    {
        Region::factory()->count(5)->create();
        $response = $this->get($this->url)->getData();

        $this->assertCount(5, $response->data);
    }

    public function test_api_should_return_single_region()
    {
        $region = Region::factory()->create(['name' => 'Сумська область']);
        $response = $this->get("$this->url/$region->id")->getData();

        $this->assertEquals('Сумська область', $response->data->name);
    }

    public function test_api_should_create_region()
    {
        $region = Region::factory()->make(['name' => 'Сумська область']);
        $this->post($this->url, $region->toArray())->assertStatus(201);

        $this->assertDatabaseHas('regions', ['name' => 'Сумська область']);
    }

    public function test_api_shoul_update_region()
    {
        $region = Region::factory()->create(['name' => 'Сумська область']);

        $data = $region->toArray();
        $data['name'] = 'Чернігівська область';

        $this->patch("$this->url/$region->id", $data)->assertStatus(200);
        $this->assertDatabaseHas('regions', ['name' => $data['name']]);
    }

    public function test_api_should_delete_region()
    {
        $region = Region::factory()->create();

        $this->delete("$this->url/$region->id")->assertStatus(200);

        $this->assertDatabaseMissing('regions', ['id' => $region->id]);
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_api_MUST_NOT_create_region_if_data_did_not_pass_validation($field, $value)
    {
        Region::factory()->create(['name' =>  'Сумська область']);
        $region = Region::factory()->make([$field => $value])->toArray();

        $this->post($this->url, $region)->assertSessionHasErrors($field);

        $this->assertDatabaseCount('regions', 1);
    }

    public function dataProvider(): array
    {
        return [
            'name is null'              =>  ['name',    ''      ],
            'name is not long enough'   =>  ['name',    'qw'    ],
            'name is already exists'    =>  ['name',    'Сумська область'],
            'center is null'            =>  ['center',  ''  ],
            'center is not long enough' =>  ['center',  'qw'],
        ];
    }
}
