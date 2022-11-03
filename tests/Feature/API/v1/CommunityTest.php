<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\Community;
use App\Models\District;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommunityTest extends TestCase
{
    use RefreshDatabase;

    private $url;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = '/api/v1/communities';
    }

    public function test_api_should_return_communities()
    {
        Community::factory()->count(3)->create();

        $response = $this->get($this->url)->getData();

        $this->assertCount(3, $response->data);
    }

    public function test_api_should_return_single_community()
    {
        $community = Community::factory()->create(['name' => 'Попівська громада']);

        $response = $this->get("$this->url/$community->id")->getData();

        $this->assertEquals($community->name, $response->data->name);
    }

    public function test_api_should_create_community()
    {
        $community = Community::factory()->make(['name' => 'Попівська громада']);

        $this->post($this->url, $community->toArray())->assertStatus(201);

        $this->assertDatabaseHas('communities', ['name' => $community['name']]);
    }

    public function test_api_should_update_community()
    {
        $community = Community::factory()->create(['name' => 'Попівська']);
        $data = $community->toArray();
        $data['name'] = 'Попівська громада';

        $this->patch("$this->url/$community->id", $data)->assertStatus(200);

        $this->assertDatabaseHas('communities', ['name' => $data['name']]);
    }

    public function test_api_should_delete_community()
    {
        $community = Community::factory()->create(['name' => 'Попівська громада']);

        $this->delete("$this->url/$community->id")->assertStatus(200);

        $this->assertDatabaseMissing('communities', ['id' => $community->id]);
    }


    /**
     * @dataProvider dataProvider
     */
    public function test_api_MUST_NOT_create_community_id_data_did_not_pass_validation($field, $value)
    {
        $district = District::factory()->create(['name' => 'Конотопський район']);
        Community::factory()->create([
            'district_id' => $district->id,
            'name' => 'Попівська громада',
            'koatuu' => '0123456789',
            'edrpou' => '01234567'
        ]);

        $community = Community::factory()->make(['district_id' => $district->id, $field => $value])->toArray();
        $this->post($this->url, $community)->assertSessionHasErrors($field);

        $this->assertDatabaseCount('communities', 1);
    }

    public function dataProvider(): array
    {
        return [
            'district is null'              =>  ['district_id', ''],
            'district does not exist'       =>  ['district_id', 99],
            'name is empty'                 =>  ['name',        ''],
            'name is not long enough'       =>  ['name',        'qw'],
            'name is unique per district'   =>  ['name',        'Попівська громада'],
            'address is empty'              =>  ['address',     ''],
            'address is not long enough'    =>  ['address',     'qw'],
            'koatuu is null'                =>  ['koatuu',      ''],
            'koatuu is not correct format'  =>  ['koatuu',      'q1w2e3r4t5'],
            'koatuu is unique'              =>  ['koatuu',      '0123456789'],
            'edrpou is null'                =>  ['edrpou',      ''],
            'edrpou is not correct format'  =>  ['edrpou',      'q1w2e3r4'],
            'edrpou is unique'              =>  ['edrpou',      '01234567'],
        ];
    }

}
