<?php

namespace Tests\Unit;

use App\Models\AdditionalParam;
use App\Models\AdditionalParamCategory;
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
}
