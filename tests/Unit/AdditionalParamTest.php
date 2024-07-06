<?php

namespace Tests\Unit;

use App\Models\AdditionalParam;
use App\Models\AdditionalParamCategory;
use App\Models\AdditionalParamCondition;
use App\Models\AdditionalParamValue;
use App\Models\AdditionalParamValueType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdditionalParamTest extends TestCase
{
    use RefreshDatabase;

    public function test_additional_param_MUST_HAVE_category()
    {
        $category = AdditionalParamCategory::factory()->create(['code' => 'category']);

        $param = AdditionalParam::factory()->create(['category_id' => $category->id, 'code' => 'param']);

        $this->assertEquals($param->category->code, $category->code);
    }

    public function test_additinal_param_MUST_HAVE_value_type()
    {
        $apvt = AdditionalParamValueType::factory()->create(['code' => 'test']);

        $param = AdditionalParam::factory()->create(['value_type_id' => $apvt->id]);

        $this->assertEquals($param->valueType->code, $apvt->code);
    }

    public function test_additional_param_may_have_values()
    {
        $param = AdditionalParam::factory()->create();

        $value = AdditionalParamValue::factory()->create(['param_id' => $param->id]);

        $this->assertEquals($param->values[0]->value, $value->value);
    }

    public function test_additional_param_MUST_delete_values_during_deleting()
    {
        $param = AdditionalParam::factory()->create();

        AdditionalParamValue::factory()->create([
            'owner_id'  =>  1,
            'param_id'  =>  $param->id,
        ]);

        $param->delete();
        $this->assertDatabaseMissing('additional_params', ['id' => $param->id]);
        $this->assertDatabaseCount('additional_param_values', 0);
    }

    public function test_additional_param_MAY_HAVE_condition_for_display()
    {
        $param = AdditionalParam::factory()->create(
            [
                'code'  =>  'passport',
                'name'  =>  'Паспорт'
            ]
        );

        AdditionalParamCondition::factory()->create(
            [
                'param_id'      =>  $param->id,
            ]
        );

        $this->assertCount(1, $param->conditions);
    }

    public function test_additional_param_conditions_MUST_BE_deleted_during_param_deleting()
    {
        $param = AdditionalParam::factory()->create();

        AdditionalParamCondition::factory()->create(
            [
                'param_id'      =>  $param->id,
            ]
        );

        $param->delete();
        $this->assertDatabaseMissing('additional_params', ['id' => $param->id]);
        $this->assertDatabaseEmpty('additional_param_conditions');
    }
}
