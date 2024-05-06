<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\Report;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReportTest extends TestCase
{
    use RefreshDatabase;
    
    private $url;

    public function setUp(): void
    {
        parent::setUp();
        $this->url = "api/v1/reports";

        $this->loginWithPermission('App\Models\Report', 15);
    }

    public function test_api_should_return_reports()
    {
        Report::factory()->count(3)->create();
        $response = $this->get($this->url)->getData();        
        
        $this->assertCount(3, $response->data);
    }

    public function test_api_shoult_return_single_report()
    {
        $report = Report::factory()->create(['name' => 'Report']);
        
        $response = $this->get($this->url . "/" . $report->id)->getData();

        $this->assertEquals($response->data->name, $report->name);
    }
}
