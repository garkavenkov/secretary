<?php

namespace Tests\Feature\API\v1;

use App\Models\AdditionalParam;
use App\Models\AdditionalParamCondition;
use App\Models\ModelAttribute;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdditionalParamConditionTest extends TestCase
{
    use RefreshDatabase;

    private $url;

    protected function setUp():void
    {
        parent::setUp();

        $this->url = '/api/v1/additional-param-conditions';

        $this->loginWithPermission('App\Models\AdditionalParamCondition', 15);
    }

    public function test_api_should_return_param_conditions()
    {        
        AdditionalParamCondition::factory()->count(3)->create();

        $response = $this->get($this->url)->getData();

        $this->assertCount(3, $response->data);
    }

    public function test_api_should_return_param_conditions_for_particula_param()
    {
        $param = AdditionalParam::factory()->create(['code' => 'Passport']);

        AdditionalParamCondition::factory()->count(2)->create();

        AdditionalParamCondition::factory()->create(['param_id' => $param->id]);

        $response = $this->get($this->url . "?param_id=$param->id")->getData();

        $this->assertCount(1, $response->data);
    }

    public function test_api_should_create_param_condition()
    {
        $condition = AdditionalParamCondition::factory()->make()->toArray();

        $this->post($this->url, $condition)->assertStatus(201);

        $this->assertDatabaseCount('additional_param_conditions', 1);
    }

    public function test_api_should_delete_condition()
    {
        $condition = AdditionalParamCondition::factory()->create();

        $this->delete($this->url . "/" . $condition->id)->assertStatus(200);

        $this->assertDatabaseEmpty('additional_param_conditions');
    }

    public function test_api_should_update_condition()
    {
        $condition = AdditionalParamCondition::factory()->create(['value' => 20]);
        
        $this->patch($this->url. "/" . $condition->id, ['value' => 10])->assertStatus(200);

        $this->assertDatabaseHas('additional_param_conditions', ['value' => '10', 'id' => $condition->id]);
    }

    /**
     * @dataProvider dataProvider     
     */
    public function test_api_MUST_NOT_create_param_condition_if_data_did_not_pass_validation($field, $value)
    {
        $attr = ModelAttribute::factory()->create();
        $param = AdditionalParam::factory()->create();
        AdditionalParamCondition::factory()
                                ->create([
                                    'param_id'      =>  $param->id,
                                    'attribute_id'  =>  $attr->id,
                                    'condition'     =>  '>=',
                                    'value'         =>  '14'
                                ]);

        $condition = AdditionalParamCondition::factory()
                            ->make([
                                'param_id'      =>  $param->id,
                                'attribute_id'  =>  $attr->id,
                                'condition'     =>  '>=',
                                $field => $value
                            ])
                            ->toArray();
        // $this->withoutExceptionHandling();
        $this->post($this->url, $condition)->assertSessionHasErrors($field);
        $this->assertDatabaseCount('additional_param_conditions', 1);
    }

    public function dataProvider(): array
    {
        return [
            'param_id is empty'                                     =>  ['param_id',      ''],
            'param_id does not exist'                               =>  ['param_id',      99],
            'attribute_id is empty'                                 =>  ['attribute_id',  ''],
            'attribute_id does not exist'                           =>  ['attribute_id',  99],
            'condition is empty'                                    =>  ['condition',     ''],
            'condition is not in available list'                    =>  ['condition',   '<>'],
            'condition is already exists for attribute'             =>  ['condition',   '>='],
            'value is empty'                                        =>  ['value',         ''],            
        ];
    }
}
