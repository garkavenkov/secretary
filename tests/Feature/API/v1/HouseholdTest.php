<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\Household;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HouseholdTest extends TestCase
{
    use RefreshDatabase;

    private $url;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = '/api/v1/households';
    }


    public function test_api_should_return_households()
    {
        Household::factory()->count(3)->create();

        $response = $this->get($this->url)->getData();

        $this->assertCount(3, $response->data);
    }

    public function test_api_should_return_single_household()
    {
        $household = Household::factory()->create();

        $response = $this->get("$this->url/$household->id")->getData();

        $this->assertEquals($response->data->address, $household->address);
    }

}
