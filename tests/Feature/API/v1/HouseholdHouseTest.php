<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\Household;
use App\Models\HouseholdHouse;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HouseholdHouseTest extends TestCase
{
    use RefreshDatabase;

    private $url;
    private $household;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = '/api/v1/household-houses';
        $this->household = Household::factory()->create();
    }

    public function test_api_should_return_household_houses()
    {
        HouseholdHouse::factory()->count(3)->create(['household_id' => $this->household->id]);

        $response = $this->get($this->url)->getData();

        $this->assertCount(3, $response->data);
    }

    public function test_api_should_return_single_household_house()
    {
        $info = HouseholdHouse::factory()->create(['household_id' => $this->household->id]);

        $response = $this->get("$this->url/$info->id")->getData();

        $this->assertEquals($response->data->year, $info->year);
    }

    public function test_api_should_create_household_house()
    {
        $info = HouseholdHouse::factory()->make(['household_id' => $this->household->id]);

        $response = $this->post($this->url, $info->toArray())->assertStatus(201);

        $this->assertDatabaseHas('household_houses', ['household_id' => $info->household_id]);
    }

    public function test_api_should_update_household_house()
    {
        $info = HouseholdHouse::factory()->create(['household_id' => $this->household->id, 'year' => 2000]);

        $data = $info->toArray();
        $data['year'] = 2022;

        $this->patch("$this->url/$info->id", $data)->assertStatus(200);

        $this->assertDatabaseHas('household_houses', ['id' => $info->id, 'year' => $data['year']]);
    }

    public function test_api_should_delete_household_house()
    {
        $info = HouseholdHouse::factory()->create(['household_id' => $this->household->id]);

        $this->delete("$this->url/$info->id")->assertStatus(200);

        $this->assertDatabaseMissing('household_houses', ['id' => $info->id]);
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_api_MUST_NOT_create_household_house_id_data_did_not_pass_validation($field, $value)
    {
        HouseholdHouse::factory()->create(['household_id' => $this->household->id, 'year' => 2022]);
        $info = HouseholdHouse::factory()->make(['household_id' => $this->household->id, $field => $value ])->toArray();

        $this->post($this->url, $info)->assertSessionHasErrors($field);

        $this->assertDatabaseCount('household_houses', 1);
    }

    public function dataProvider(): array
    {
        return [
            'household_id is empty'                         =>  ['household_id',    ''],
            'household_id does not exist'                   =>  ['household_id',    999],
            'year is empty'                                 =>  ['year',    ''],
            'year is not integer'                           =>  ['year',    'a123'],
            'year is not in valid format YYYY'              =>  ['year',    123],
            'year is not unique for household_house'        =>  ['year',    2022],
            'total area is empty'                           =>  ['total_area', ''],
            'total area is not a number'                    =>  ['total_area', 'as1'],
            'total area is less or equal 0'                 =>  ['total_area', 0],
            'total living area is empty'                    =>  ['total_living_area', ''],
            'total living area is not a number'             =>  ['total_living_area', 'as1'],
            'total living area is less or equal 0'          =>  ['total_living_area', '0'],
            'total living area is greater than total area'  =>  ['total_living_area',   300],
            'living area is empty'                          =>  ['living_area', ''],
            'living area is not a number'                   =>  ['living_area', 'as1'],
            'living area is less or equal 0'                =>  ['living_area', 0],
            'living area is greater than total area'        =>  ['living_area',   300],
            'room count is empty'                           =>  ['room_count', ''],
            'room count is not a number'                    =>  ['room_count', 'as1'],
            'room count is less than 0'                     =>  ['room_count', -1],
            'total nonliving area is empty'                 =>  ['total_non_living_area', ''],
            'total nonliving area is not a number'          =>  ['total_non_living_area', 'as1'],
            'total nonliving area is less than 0'           =>  ['total_non_living_area', -1],
        ];
    }
}
