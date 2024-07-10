<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\AdditionalParam;
use App\Models\AdditionalParamCategory;
use App\Models\AdditionalParamValue;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdditionalParamTest extends TestCase
{
    use RefreshDatabase;

    private $url;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = '/api/v1/additional-params';
    }

    public function test_api_should_return_additional_params()
    {
        AdditionalParam::factory()->count(3)->create();

        $response = $this->get($this->url)->getData();

        $this->assertCount(3, $response->data);
    }

    public function test_api_should_return_param()
    {
        $param = AdditionalParam::factory()->create(['code' =>  'param']);

        $response = $this->get("$this->url/$param->id")->getData();

        $this->assertEquals($response->data->code, $param->code);
    }

    public function test_api_should_create_param()
    {
        $param = AdditionalParam::factory()->make(['code' => 'param'])->toArray();

        $this->post($this->url, $param)->assertStatus(201);

        $this->assertDatabaseHas('additional_params', ['code' => $param['code']]);
    }

    public function test_api_should_update_param()
    {
        $param = AdditionalParam::factory()->create(['code' => 'Code before update']);

        $data = $param->toArray();
        $data['code'] = 'Updated code';

        $this->patch("$this->url/$param->id", $data)->assertStatus(200);

        $this->assertDatabaseHas('additional_params', ['code' => $data['code'], 'id' => $param->id]);
    }

    public function test_api_should_delete_param()
    {
        $param = AdditionalParam::factory()->create();

        $this->delete("$this->url/$param->id")->assertStatus(200);

        $this->assertDatabaseMissing('additional_params', ['id' => $param->id]);
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_api_MUST_NOT_create_param_if_data_did_not_pass_validation($field, $value)
    {
        $category = AdditionalParamCategory::factory()->create(['code' => 'category']);
        AdditionalParam::factory()
                            ->create([
                                'category_id'   =>  $category->id,
                                'code'          =>  'param',
                                'name'          =>  'Параметр'
                            ]);

        $param = AdditionalParam::factory()
                        ->make([
                            'category_id'   =>  $category->id,
                            $field  => $value
                        ])
                        ->toArray();

        $this->post($this->url, $param)->assertSessionHasErrors($field);

        $this->assertDatabaseCount('additional_params', 1);
    }

    public function dataProvider(): array
    {
        return [
            'category_id is empty'                  =>  ['category_id',     ''],
            'category_id does not exist'            =>  ['category_id',     99],
            'code is empty'                         =>  ['code',            ''],
            'code is not long enough'               =>  ['code',          'qw'],
            'code is already exists for category'   =>  ['code',       'param'],
            'name is empty'                         =>  ['name',            ''],
            'name is not long enough'               =>  ['name',          'qw'],
            'name is already exists for category'   =>  ['name',    'Параметр'],
            'value_type_id is empty'                =>  ['value_type_id',   ''],
            'value_type_id does not exist'          =>  ['value_type_id',   99],
        ];
    }

    public function test_api_should_return_additional_params_by_category_code()
    {
        $category = AdditionalParamCategory::factory()->create(['code' => 'category1']);        

        AdditionalParam::factory()
                            ->count(3)
                            ->create([
                                'category_id'   =>  $category->id,
                            ])
                            ->each(function($p) {
                                AdditionalParamValue::factory()->create(['param_id' => $p->id, 'owner_id' => 2 ]);
                            });
        
        $response = $this->get($this->url . "?category_code=$category->code&owner_id=2")->getData();        
        $this->assertCount(3, $response->data);
                            
    }
}
