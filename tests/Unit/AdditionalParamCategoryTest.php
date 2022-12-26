<?php

namespace Tests\Unit;

use App\Models\AdditionalParam;
use App\Models\AdditionalParamCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdditionalParamCategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_additional_param_category_may_have_params()
    {
        $category = AdditionalParamCategory::factory()->create(['code' => 'category']);

        AdditionalParam::factory()
                        ->count(3)
                        ->create(['category_id' => $category->id]);

        $this->assertCount(3, $category->params);
    }
}
