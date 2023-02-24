<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\HouseholdMember;
use App\Models\HouseholdMemberLand;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HouseholdMemberLandTest extends TestCase
{
    use RefreshDatabase;

    private $url;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = '/api/v1/household-member-lands';
    }

    public function test_api_should_return_member_land_years()
    {
        HouseholdMemberLand::factory()->count(5)->create();

        $response = $this->get($this->url)->getData();

        $this->assertCount(5, $response->data);
    }

    public function test_api_should_return_member_land_info_for_year()
    {
        $year = HouseholdMemberLand::factory()->create();

        $response = $this->get("$this->url/$year->id")->getData();

        $this->assertEquals($response->data->year, $year->year);
    }

    public function test_api_should_create_year_information()
    {
        $year = HouseholdMemberLand::factory()->make(['year' => 2023])->toArray();

        $this->post($this->url, $year)->assertStatus(201);

        $this->assertDatabaseHas('household_member_lands', ['year' => $year['year']]);
    }

    public function test_api_should_update_year_information()
    {
        $year = HouseholdMemberLand::factory()->create(['year' => 2022]);

        $data = $year->toArray();
        $data['year'] = 2023;

        $this->patch("$this->url/$year->id", $data)->assertStatus(200);

        $this->assertDatabaseHas('household_member_lands', ['id' => $year->id, 'year' => $data['year']]);
    }

    public function test_api_should_delete_year_information()
    {
        $year = HouseholdMemberLand::factory()->create(['year' => 2025]);

        $this->delete("$this->url/$year->id")->assertStatus(200);

        $this->assertDatabaseMissing('household_member_lands', ['id' => $year->id]);
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_api_MUST_NOT_create_year_information_if_data_did_not_pass_validation($field, $value)
    {
        $member = HouseholdMember::factory()->create();
        HouseholdMemberLand::factory()->create(['member_id' => $member->id, 'year' => 2023])->toArray();

        $year = HouseholdMemberLand::factory()
                    ->make([
                        'member_id' => $member->id,
                        $field => $value
                    ])
                    ->toArray();

        $this->post($this->url, $year)->assertSessionHasErrors($field);

        $this->assertDatabaseCount('household_member_lands', 1);
    }

    public function dataProvider(): array
    {
        return [
            'member_id is empty'                =>  ['member_id',                 ''],
            'member_id does not exists'         =>  ['member_id',                 99],
            'year is empty'                     =>  ['year',                      ''],
            'year is not integer'               =>  ['year',                  'a123'],
            'year is not in valid format YYYY'  =>  ['year',                     123],
            'year is not unique for member'     =>  ['year',                    2023],
            'maintenance is not number'         =>  ['maintenance',             'aa'],
            'maintenance  >= 0  '               =>  ['maintenance',               -1],
            'personal_agriculture is not number'=>  ['personal_agriculture',    'aa'],
            'personal_agriculture >= 0'         =>  ['personal_agriculture',      -1],
            'land_share is not number'          =>  ['land_share',              'aa'],
            'land_share >= 0'                   =>  ['land_share',                -1],
            'property_share is not number'      =>  ['property_share',          'aa'],
            'property_share >= 0'               =>  ['property_share',            -1],
            'hay_cutting is not number'         =>  ['hay_cutting',             'aa'],
            'hay_cutting >= 0'                  =>  ['hay_cutting',               -1],
            'pastures is not number'            =>  ['pastures',                'aa'],
            'pastures >= 0'                     =>  ['pastures',                  -1],
        ];
    }
}
