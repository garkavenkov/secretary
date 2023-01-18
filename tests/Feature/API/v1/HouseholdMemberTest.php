<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\Household;
use App\Models\HouseholdMember;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HouseholdMemberTest extends TestCase
{
    use RefreshDatabase;

    private $url;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = '/api/v1/household-members';
    }


    public function test_api_should_return_household_members()
    {
        $household = Household::factory()->create();
        HouseholdMember::factory()->count(3)->create(['household_id' => $household->id]);

        $response = $this->get($this->url)->getData();
        $this->assertCount(3, $response->data);
    }

    public function test_api_should_return_single_household_member()
    {
        $household = Household::factory()->create();
        $member = HouseholdMember::factory()->create(['household_id' => $household->id]);

        $response = $this->get("$this->url/$member->id")->getData();
        $this->assertEquals($response->data->surname, $member->surname);
    }

    public function test_api_should_create_household_member()
    {
        $member = HouseholdMember::factory()->make()->toArray();
        $this->post($this->url, $member)->assertStatus(201);

        $this->assertDatabaseCount('household_members', 1);
    }

    public function test_api_should_update_household_member()
    {
        $member = HouseholdMember::factory()->create(['surname' => 'Іванченко']);

        $data = $member->toArray();
        $data['surname'] = 'Онищенко';

        $this->patch("$this->url/$member->id", $data)->assertStatus(200);

        $this->assertDatabaseHas('household_members', ['id' => $member->id, 'surname' => $data['surname']]);
    }

    public function test_api_should_delete_household_member()
    {
        $member = HouseholdMember::factory()->create();

        $this->delete("$this->url/$member->id")->assertStatus(200);

        $this->assertDatabaseMissing('household_members', ['id' => $member->id]);
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_api_MUST_NOT_create_household_member_if_data_did_not_pass_validation($field, $value)
    {
        $household = Household::factory()->create();
        $member = HouseholdMember::factory()
                        ->make([
                            'household_id'  =>  $household->id,
                            'death_date'    =>  '2030-01-01',
                            $field => $value
                        ])->toArray();

        $this->post($this->url, $member)->assertSessionHasErrors($field);

        $this->assertDatabaseCount('household_members', 0);
    }

    public function dataProvider():array
    {
        return [
            'household_id is missing'                       =>  ['household_id', ''],
            'household does not exist'                      =>  ['household_id', 99],
            'surname is empty'                              =>  ['surname', ''],
            'surname is not long enough'                    =>  ['surname', 'qw'],
            'name is empty'                                 =>  ['name', ''],
            'name is not long enough'                       =>  ['name', 'qw'],
            'patronymic is empty'                           =>  ['patronymic', ''],
            'patronymic is not long enough'                 =>  ['patronymic', 'qw'],
            'sex is empty'                                  =>  ['sex', ''],
            'sex is strange'                                =>  ['sex', 'qw'],
            'family_relationship is empty'                  =>  ['family_relationship_id', ''],
            'family_relationship does not exist'            =>  ['family_relationship_id', 99],
            'birthday is empty'                             =>  ['birthday', ''],
            'birthday is not a date'                        =>  ['birthday', 'qw'],
            'birthday is in future'                         =>  ['birthday', date("Y-m-d", strtotime("+1 day"))],
            'work_place does not exist'                     =>  ['work_place_id', 99],
            // Did not pass when use "required_with" rule.
            // 'employment is not long enough'                 =>  ['employment_information', 'qw'],
            'death_date is not a date'                      =>  ['death_date',  '111'],
            'death_date in past'                            =>  ['death_date',  '1900-01-01'],
            'death_number is empty when death_date is set'  =>  ['death_register_number',    ''],
            'death_office is empty when death_date is set'  =>  ['death_register_office',    ''],
            // Did not pass when use "required_with" rule.
            // 'death_office is not long enough'               =>  ['death_register_office',    'qw'],
            'additional is not long enough'                 =>  ['additional_information',  'qw'],
            'social is not long enough'                     =>  ['social_information',      'qw'],
            'land_owned is not number'                      =>  ['land_owned',  'as'],
            'land_owned in less than 0'                     =>  ['land_owned',  -1],
            'land_rented is not number'                     =>  ['land_rented',  'as'],
            'land_rented in less than 0'                    =>  ['land_rented',  -1],
            'land_leased is not number'                     =>  ['land_leased',  'as'],
            'land_leased in less than 0'                    =>  ['land_leased',  -1],
        ];
    }
}
