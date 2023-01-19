<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\Household;
use App\Models\HouseholdLand;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HouseholdLandTest extends TestCase
{
    use RefreshDatabase;

    protected $url = '/api/v1/household-lands';

    public function test_api_should_return_household_lands_years()
    {
        HouseholdLand::factory()->count(3)->create();

        $responose = $this->get($this->url)->getData();

        $this->assertCount(3, $responose->data);
    }

    public function test_api_should_return_household_land_year()
    {
        $year = HouseholdLand::factory()->create(['year' => '2023']);

        $response = $this->get("$this->url/$year->id")->getData();

        $this->assertEquals($response->data->year, $year->year);
    }

    public function test_api_should_create_household_land_year()
    {
        $year = HouseholdLand::factory()->make(['year' => 2023])->toArray();

        $this->post($this->url, $year)->assertStatus(201);

        $this->assertDatabaseHas('household_lands', ['year' => 2023]);
    }

    public function test_api_should_delete_household_land_year()
    {
        $year = HouseholdLand::factory()->create(['year' => 2023]);

        $this->delete("$this->url/$year->id")->assertStatus(200);

        $this->assertDatabaseMissing('household_lands', ['id' => $year->id]);
    }

    public function test_api_should_update_year_information()
    {
        $year = HouseholdLand::factory()->create(['year' => 2022]);

        $data = $year->toArray();
        $data['year'] = 2023;

        $this->patch("$this->url/$year->id", $data)->assertStatus(200);

        $this->assertDatabaseHas('household_lands', ['year' => $data['year'], 'id' => $year->id]);
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_api_MUST_NOT_cerate_year_information_if_data_did_not_pass_validation($field, $value)
    {
        $household = Household::factory()->create();
        HouseholdLand::factory()->create(['household_id' => $household->id, 'year' => 2023]);
        $year = HouseholdLand::factory()
                    ->make([
                        'household_id'  => $household->id,
                        $field          => $value,
                    ])
                    ->toArray();

        $this->post($this->url, $year)->assertSessionHasErrors($field);

        $this->assertDatabaseCount('household_lands', 1);
    }

    public function dataProvider(): Array
    {
        return [
            'household_id is empty'                     =>  ['household_id',            ''],
            'household_id does not exists'              =>  ['household_id',            99],
            'year is empty'                             =>  ['year',                    ''],
            'year is not integer'                       =>  ['year',                'a123'],
            'year is not in valid format YYYY'          =>  ['year',                   123],
            'year is not unique for household_house'    =>  ['year',                  2023],
            'maintenance is not a number'               =>  ['maintenance',           'qw'],
            'maintenance  >= 0  '                       =>  ['maintenance',             -1],
            'personal_agriculture is not a number'      =>  ['personal_agriculture',  'qw'],
            'personal_agriculture >= 0'                 =>  ['personal_agriculture',    -1],
            'commercial_agriculture is not a number'    =>  ['commercial_agriculture','qw'],
            'commercial_agriculture >= 0'               =>  ['commercial_agriculture',  -1],
        ];
    }
}
