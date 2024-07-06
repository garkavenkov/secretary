<?php

namespace Tests\Unit;

use App\Models\AdditionalParamCondition;
use App\Models\ModelAttribute;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdditionalParamCondiotionTest extends TestCase
{
    use RefreshDatabase;

    public function test_additional_param_condiotion_MUST_HAVE_attribute()
    {
        $attribute = ModelAttribute::factory()->create(['code' => 'full_age']);

        $condition = AdditionalParamCondition::factory()->create(
            [
                'attribute_id'  => $attribute->id,
            ]
        );
        
        $this->assertEquals('full_age', $condition->attribute->code);
    }
}
