<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\AdditionalParam;
use App\Models\AdditionalParamValue;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdditionalParamValueTest extends TestCase
{
    use RefreshDatabase;

    private $url;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = '/api/v1/additional-param-values';
    }

    public function test_api_should_return_param_values()
    {
        $param = AdditionalParam::factory()->create();

        AdditionalParamValue::factory()->count(3)->create(['param_id' => $param->id]);

        // $response = $this->get($this->url)->getData();

        $this->assertCount(3, $param->values);
    }

}
