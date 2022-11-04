<?php

namespace Tests\Feature\API\v1;

use App\Models\Community;
use Tests\TestCase;
use App\Models\Council;
use App\Models\CouncilType;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CouncilTest extends TestCase
{
    use RefreshDatabase;

    private $url;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = "/api/v1/councils";
    }

    public function test_api_should_return_councils()
    {
        Council::factory()->count(3)->create();

        $response = $this->get($this->url)->getData();

        $this->assertCount(3, $response->data);
    }

    public function test_api_should_return_single_council()
    {
        $council = Council::factory()->create(['name' => 'Шаповалівська сілька рада']);

        $response = $this->get("$this->url/$council->id")->getData();

        $this->assertEquals('Шаповалівська сілька рада', $response->data->name);
    }

    public function test_api_should_create_council()
    {
        $council = Council::factory()->make(['name' => 'Шаповалівська сілька рада']);

        $this->post($this->url, $council->toArray())->assertStatus(201);

        $this->assertDatabaseHas('councils', ['name' => $council->name]);
    }

    public function test_api_should_update_council()
    {
        $council = Council::factory()->create(['name' => 'Шаповалівська сілька']);

        $data = $council->toArray();
        $data['name'] = 'Шаповалівська сілька рада';

        $this->patch("$this->url/$council->id", $data)->assertStatus(200);

        $this->assertDatabaseHas('councils', ['name' => $data['name']]);
    }

    public function test_api_should_delete_council()
    {
        $council = Council::factory()->create(['name' => 'Шаповалівська сілька']);

        $this->delete("$this->url/$council->id")->assertStatus(200);

        $this->assertDatabaseMissing('councils', ['id' => $council->id]);
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_api_MUST_NOT_create_council_id_data_did_not_pass_validation($field, $value)
    {
        $community = Community::factory()->create(['name' => 'Попівська громада']);
        $council_type = CouncilType::factory()->create(['name' => 'Сільська рада']);

        Council::factory()->create([
            'community_id'      =>  $community->id,
            'council_type_id'   =>  $council_type->id,
            'name'              =>  'Шаповалівська сільська рада',
            'koatuu'            =>  '0123456789',
            'edrpou'            =>  '01234567'
        ]);
        $council = Council::factory()->make(['community_id' => $community->id, $field => $value])->toArray();

        $this->post($this->url, $council)->assertSessionHasErrors($field);

        $this->assertDatabaseCount('councils', 1);
    }

    public function dataProvider(): array
    {
        return  [
            'community is null'             =>  ['community_id',    ''],
            'community does not exists'     =>  ['community_id',    99],
            'council type is null'          =>  ['council_type_id', ''],
            'council type does not exist'   =>  ['council_type_id', 99],
            'name is empty'                 =>  ['name', ''],
            'name is not long enough'       =>  ['name', 'qw'],
            'name is unique per community'  =>  ['name', 'Шаповалівська сільська рада'],
            'address is null'               =>  ['address', ''],
            'address is not long enough'    =>  ['address', 'qw'],
            'koatuu is null'                =>  ['koatuu', ''],
            'koatuu is not correct format'  =>  ['koatuu',      'q1w2e3r4t5'],
            'koatuu is unique'              =>  ['koatuu',      '0123456789'],
            'edrpou is null'                =>  ['edrpou',      ''],
            'edrpou is not correct format'  =>  ['edrpou',      'q1w2e3r4'],
            'edrpou is unique'              =>  ['edrpou',      '01234567'],
        ];
    }

}
