<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\MovementType;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MovementTypeTest extends TestCase
{
    use RefreshDatabase;

    private $url;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = 'api/v1/movement-types';
    }

    public function test_api_should_return_movement_types()
    {
        MovementType::factory()->count(3)->create();

        $response = $this->get($this->url)->getData();

        $this->assertCount(3, $response->data);
    }

    public function test_api_should_return_single_type()
    {
        $type = MovementType::factory()->create(['code' =>  'register']);

        $response = $this->get("$this->url/$type->id")->getData();

        $this->assertEquals($response->data->code, $type->code);
    }
}
