<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\District;
use App\Models\Region;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DistrictTest extends TestCase
{
    use RefreshDatabase;

    private $url;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = '/api/v1/districts';
    }

    public function test_api_should_return_districts()
    {
        District::factory()->count(3)->create();

        $response = $this->get($this->url)->getData();

        $this->assertCount(3, $response->data);
    }

    public function test_api_should_return_single_district()
    {
        $region = Region::factory()->create(['name' => 'Сумська область']);

        $district = District::factory()->create(['region_id' => $region->id, 'name' => 'Конотопський район']);

        $response = $this->get("$this->url/$district->id")->getData();

        $this->assertEquals('Конотопський район', $response->data->name);
    }

    public function test_api_should_create_district()
    {
        $region = Region::factory()->create(['name' => 'Сумська область']);

        $district = District::factory()->make(['region_id' => $region->id, 'name' => 'Конотопський район', 'center' => 'Конотоп']);

        $this->post($this->url, $district->toArray())->assertStatus(201);

        $this->assertDatabaseHas('districts', ['name' => $district['name']]);
    }

    public function test_api_should_update_district()
    {
        $region = Region::factory()->create(['name' => 'Сумська область']);

        $district = District::factory()->create(['region_id' => $region->id, 'name' => 'Конотопський район', 'center' => 'Ромни']);

        $data = $district->toArray();
        $data['center'] = 'Конотоп';
        $this->withExceptionHandling();
        $this->patch("$this->url/$district->id", $data)->assertStatus(200);

        $this->assertDatabaseHas('districts', ['center' => $data['center']]);
    }

    public function test_api_should_delete_district()
    {
        $district = District::factory()->create();

        $this->delete("$this->url/$district->id")->assertStatus(200);

        $this->assertDatabaseMissing('districts', ['id' => $district->id]);
    }


    /**
     * @dataProvider dataProvider
     */
    public function test_api_MUST_NOT_create_district_id_data_did_not_pass_validation($field, $value)
    {
        $region = Region::factory()->create(['name' => 'Сумська область']);

        District::factory()->create(['region_id' => $region->id, 'name' => 'Конотопський район'])->toArray();
        $district = District::factory()->make(['region_id'=> $region->id, $field => $value])->toArray();

        $this->post($this->url, $district)->assertSessionHasErrors($field);

        $this->assertDatabaseCount('districts', 1);
    }


    public function dataProvider(): array
    {
        return [
            'region is null'            =>  ['region_id',   ''],
            'region does not exist'     =>  ['region_id',   999],
            'name is null'              =>  ['name',        ''],
            'name is not long enough'   =>  ['name',        'qw'],
            'name is unique per region' =>  ['name',        'Конотопський район'],
            'center is null'            =>  ['center',      ''],
            'center is not long enough' =>  ['center',      'qw'],
        ];
    }
}
