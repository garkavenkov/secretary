<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\ModelAttribute;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ModelAttributeTest extends TestCase
{
    use RefreshDatabase;

    private $url;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = '/api/v1/model-attributes';
    }

    public function test_api_should_return_model_attributes()
    {
        ModelAttribute::factory()->count(2)->create();

        $response = $this->get($this->url)->getData();

        $this->assertCount(2, $response->data);
    }

    public function test_api_should_return_model_attributes_for_particular_model()
    {
        ModelAttribute::factory()->count(2)->create();
        $model = 'App\\Models\\HouseholdMember';
        ModelAttribute::factory()->create(['model' => $model]);

        $response = $this->get($this->url . "?model=$model")->getData();
        $this->assertCount(1, $response->data);
    }
}
