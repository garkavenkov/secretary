<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\Household;
use App\Models\HouseholdOwner;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HouseholdOwnerTest extends TestCase
{
    use RefreshDatabase;

    private $url = '/api/v1/household-owners';

    public function test_api_should_return_household_owners()
    {
        $household = Household::factory()->create();

        HouseholdOwner::factory()->count(3)->create(['household_id' => $household->id]);

        $response = $this->get($this->url)->getData();

        $this->assertCount(3, $response->data);
    }

    public function test_api_should_return_owner()
    {
        $owner = HouseholdOwner::factory()->create(['name' => 'Іваненко Іван Іванович']);

        $response = $this->get("$this->url/$owner->id")->getData();

        $this->assertEquals($response->data->name, 'Іваненко Іван Іванович');
    }

    public function test_api_should_create_household_owner()
    {
        $owner = HouseholdOwner::factory()->make()->toArray();

        $this->post($this->url, $owner)->assertStatus(201);

        $this->assertDatabaseHas('household_owners', ['name' => $owner['name']]);
    }

    public function test_api_should_update_owner()
    {
        $owner = HouseholdOwner::factory()->create(['name' => 'Name for update']);
        $data = $owner->toArray();
        $data['name'] = 'Іваненко Іван Іванович';

        $this->patch("$this->url/$owner->id", $data)->assertStatus(200);

        $this->assertDatabaseHas('household_owners', ['id' => $owner->id, 'name' => $data['name']]);
    }

    public function test_api_should_delete_household_owner()
    {
        $owner = HouseholdOwner::factory()->create();

        $this->delete("$this->url/$owner->id")->assertStatus(200);

        $this->assertDatabaseMissing('household_owners', ['id' => $owner->id]);
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_api_MUST_NOT_create_owner_if_data_did_not_pass_validation($field, $value)
    {
        $owner = HouseholdOwner::factory()->make([$field => $value])->toArray();

        $this->post($this->url, $owner)->assertSessionHasErrors($field);

        $this->assertDatabaseCount('household_owners', 0);
    }

    public function dataProvider(): array
    {
        return [
            'household is empty'            =>  ['household_id', ''],
            'household does not exist'      =>  ['household_id', 99],
            'name is empty'                 =>  ['name',         ''],
            'name is not long enough'       =>  ['name',       'qw'],
            'address is empty'              =>  ['address',      ''],
            'address is not long enough'    =>  ['address',    'qw'],
        ];
    }
}
