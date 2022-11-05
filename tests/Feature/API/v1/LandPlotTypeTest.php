<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\LandPlotType;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LandPlotTypeTest extends TestCase
{
    use RefreshDatabase;

    private $url;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = '/api/v1/land-plot-types';
    }

    public function test_api_should_return_types()
    {
        LandPlotType::factory()->count(3)->create();

        $response = $this->get($this->url)->getData();

        $this->assertCount(3, $response->data);
    }

    public function test_api_should_return_single_type()
    {
        $type = LandPlotType::factory()->create();

        $response = $this->get("$this->url/$type->id")->getData();

        $this->assertEquals($type->name, $response->data->name);
    }

    public function test_api_should_create_type()
    {
        $type = LandPlotType::factory()->make()->toArray();

        $this->post($this->url, $type)->assertStatus(201);

        $this->assertDatabaseHas('land_plot_types', ['name' => $type['name']]);
    }

    public function test_api_should_update_type()
    {
        $type = LandPlotType::factory()->create(['name' => 'Name for update']);

        $data = $type->toArray();
        $data['name'] = 'Updated name';

        $this->patch("$this->url/$type->id", $data)->assertStatus(200);

        $this->assertDatabaseHas('land_plot_types', ['name' => $data['name']]);
    }

    public function test_api_should_delete_type()
    {
        $type = LandPlotType::factory()->create();

        $this->delete("$this->url/$type->id")->assertStatus(200);

        $this->assertDatabaseMissing('land_plot_types', ['id' => $type->id]);
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_api_MUST_NOT_create_type_if_data_did_not_pass_validation($field, $value)
    {
        LandPlotType::factory()->create(['name' => 'type']);
        $type = LandPlotType::factory()->make([$field => $value])->toArray();

        $this->post($this->url, $type)->assertSessionHasErrors($field);

        $this->assertDatabaseCount('land_plot_types', 1);
    }

    public function dataProvider(): array
    {
        return [
            'name is empty'             =>  ['name',    ''      ],
            'name is not long enough'   =>  ['name',    'qw'    ],
            'name is already exists'    =>  ['name',    'type'  ]
        ];
    }
}
