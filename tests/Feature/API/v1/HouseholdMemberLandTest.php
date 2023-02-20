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
}
