<?php

namespace Tests\Feature\API\v1;

use App\Models\Community;
use Tests\TestCase;
use App\Models\Household;
use App\Models\HouseholdType;
use App\Models\Settlement;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HouseholdTest extends TestCase
{
    use RefreshDatabase;

    private $url;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = '/api/v1/households';
    }


    public function test_api_should_return_households()
    {
        Household::factory()->count(3)->create();

        $response = $this->get($this->url)->getData();

        $this->assertCount(3, $response->data);
    }

    public function test_api_should_return_single_household()
    {
        $household = Household::factory()->create();

        $response = $this->get("$this->url/$household->id")->getData();

        $this->assertEquals($response->data->address, $household->address);
    }

    public function test_api_should_create_household()
    {
        $household = Household::factory()->make();

        $this->post($this->url, $household->toArray())->assertStatus(201);

        $this->assertDatabaseHas('households', ['address' => $household->address]);
    }

    public function test_api_should_update_household()
    {
        $household = Household::factory()->create(['additional_data' => 'Test']);

        $data = $household->toArray();
        $data['additional_data'] = 'Updated data';

        $this->patch("$this->url/$household->id", $data)->assertStatus(200);

        $this->assertDatabaseHas('households', ['id' => $household->id, 'additional_data' => $data['additional_data']]);
    }

    public function test_api_should_delete_household()
    {
        $household = Household::factory()->create();

        $this->delete("$this->url/$household->id")->assertStatus(200);

        $this->assertDatabaseMissing('households', ['id' => $household->id]);
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_api_MUST_NOT_create_household_id_data_did_not_pass_validation($field, $value)
    {
        $settlement = Settlement::factory()->create();
        $household_type = HouseholdType::factory()->create();
        $household = Household::factory()
                        ->make([
                            'settlement_id' => $settlement->id,
                            'household_type_id' => $household_type->id,
                            $field => $value
                        ])->toArray();

        $this->post($this->url, $household)->assertSessionHasErrors($field);

        $this->assertDatabaseCount('households', 0);
    }

    public function dataProvider(): array
    {
        return [
            'settlement_id is empty'            =>  ['settlement_id',       ''],
            'settlement_id does not exist'      =>  ['settlement_id',       99],
            'household_type_id'                 =>  ['household_type_id',   ''],
            'household_type_id does not exist'  =>  ['household_type_id',   99],
            'address is empty'                  =>  ['address',             ''],
            'address in not long enough'        =>  ['address',           'qw'],
        ];
    }
}
