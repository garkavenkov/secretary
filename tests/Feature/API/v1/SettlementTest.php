<?php

namespace Tests\Feature\API\v1;

use App\Models\Council;
use Tests\TestCase;
use App\Models\Settlement;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SettlementTest extends TestCase
{
    use RefreshDatabase;

    private $url;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = '/api/v1/settlements';

        $this->loginWithPermission('App\Models\Settlement', 15);
    }

    public function test_api_should_return_settlements()
    {
        Settlement::factory()->count(3)->create();

        $response = $this->get($this->url)->getData();

        $this->assertCount(3, $response->data);
    }

    public function test_api_should_return_single_settlements()
    {
        $settlement = Settlement::factory()->create(['name' => 'Шаповалівка']);

        $response = $this->get("$this->url/$settlement->id")->getData();

        $this->assertEquals('Шаповалівка', $response->data->name);
    }

    public function test_api_should_create_settlement()
    {
        $settlement = Settlement::factory()->make(['name' => 'Шаповалівка']);

        $this->post($this->url, $settlement->toArray())->assertStatus(201);

        $this->assertDatabaseCount('settlements', 1);
    }

    public function test_api_should_update_settlement()
    {
        $settlement = Settlement::factory()->create(['name' => 'шаповалівка']);
        $data = $settlement->toArray();
        $data['name'] = 'Шаповалівка';
        $this->withoutExceptionHandling();
        $this->patch("$this->url/$settlement->id", $data)->assertStatus(200);

        $this->assertDatabaseHas('settlements', ['name' => $data['name']]);
    }

    public function test_api_should_delete_settlement()
    {
        $settlement = Settlement::factory()->create();

        $this->delete("$this->url/$settlement->id")->assertStatus(200);

        $this->assertDatabaseMissing('settlements', ['id' => $settlement->id]);
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_api_MUST_NOT_create_settlement_if_data_did_not_pass_validation($field, $value)
    {
        $council = Council::factory()->create(['name' => 'Шаповалівська сільска рада']);

        Settlement::factory()
                    ->create([
                        'council_id' => $council->id,
                        'name' => 'Шаповалівка',
                        'katottg' => 'UA59020130250036991',
                        'inner_code' => 1
                    ]);

        $settlement = Settlement
                        ::factory()
                        ->make([
                            'council_id' => $council->id,
                            $field => $value
                        ])
                        ->toArray();

        $this->post($this->url, $settlement)->assertSessionHasErrors($field);

        $this->assertDatabaseCount('settlements', 1);
    }

    public function dataProvider(): array
    {
        return [
            'council is empty'                          =>  ['council_id',          ''  ],
            'council does not exist'                    =>  ['council_id',          99  ],
            'settlement_type'                           =>  ['settlement_type_id',  ''  ],
            'settlement_type does not exist'            =>  ['settlement_type_id',  99  ],
            'name is empty'                             =>  ['name',                ''  ],
            'name is not long enough'                   =>  ['name',                'qw'],
            'name is unique per council'                =>  ['name',       'Шаповалівка'],
            'inner_code is empty'                       =>  ['inner_code',            ''],
            'inner_code is less than 1'                 =>  ['inner_code',             0],
            'inner_code is not a number'                =>  ['inner_code',           1.1],
            'inner_code is already exist in council'    =>  ['inner_code',             1],
            'postcode is empty'                         =>  ['postcode',            ''  ],
            'postcode has wrong format'                 =>  ['postcode',         '1q2w3'],
            'katottg is empty'                          =>  ['katottg',             ''  ],
            'katottg has wrong format'                  =>  ['katottg',          '1q2w3'],
            'katottg is already exists'                 =>  ['katottg', 'UA59020130250036991'],
        ];
    }
}
