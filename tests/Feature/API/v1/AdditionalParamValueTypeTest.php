<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\AdditionalParam;
use App\Models\AdditionalParamValueType;
use Database\Seeders\AdditionalParamSeeder;
use Exception;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdditionalParamValueTypeTest extends TestCase
{
    use RefreshDatabase;

    private $url;
    private $table_name;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = '/api/v1/additional-param-value-types';
        $this->table_name = 'additional_param_value_types';
    }


    public function test_api_should_return_value_types()
    {
        AdditionalParamValueType::factory()->count(5)->create();

        $response = $this->get($this->url)->getData();

        $this->assertCount(5, $response->data);
    }

    public function test_api_should_return_single_type()
    {
        $type = AdditionalParamValueType::factory()->create(['code' => 'text']);

        $response = $this->get("$this->url/$type->id")->getData();

        $this->assertEquals($response->data->code, $type->code);
    }

    public function test_api_should_create_type()
    {
        $type = AdditionalParamValueType::factory()->make(['code' => 'text'])->toArray();

        $this->post($this->url, $type)->assertStatus(201);

        $this->assertDatabaseHas($this->table_name, ['code' => 'text']);
    }

    public function test_api_should_update_type()
    {
        $type = AdditionalParamValueType::factory()->create(['code' => 'for_update']);
        $data = $type->toArray();
        $data['code'] = 'text';

        $this->patch("$this->url/$type->id", $data)->assertStatus(200);

        $this->assertDatabaseHas($this->table_name, ['code' => 'text']);
    }

    public function test_api_should_delete_type()
    {
        $type = AdditionalParamValueType::factory()->create();

        $this->delete("$this->url/$type->id")->assertStatus(200);

        $this->assertDatabaseMissing($this->table_name, ['id' => $type->id]);
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_api_MUST_NOT_create_type_if_data_did_not_pass_validation($field, $value)
    {
        AdditionalParamValueType::factory()->create(['code' => 'text', 'name' => 'Text']);
        $type = AdditionalParamValueType::factory()->make([$field => $value])->toArray();

        $this->post($this->url, $type)->assertSessionHasErrors($field);

        $this->assertDatabaseCount($this->table_name, 1);
    }

    public function dataProvider(): array
    {
        return [
            'code is empty'                     =>  ['code',            ''],
            'code is not long enough'           =>  ['code',          'qw'],
            'code is already exists'            =>  ['code',        'text'],
            'name is empty'                     =>  ['name',            ''],
            'name is not long enough'           =>  ['name',          'qw'],
            'name is already exists'            =>  ['name',        'Text'],
            'description is empty'              =>  ['description',     ''],
            'description is not long enough'    =>  ['description',   'qw'],
        ];
    }

    public function test_api_MUST_NOT_delete_type_if_there_is_exists_at_least_one_parameter_with_this_value_type()
    {
        $type = AdditionalParamValueType::factory()->create();

        AdditionalParam::factory()->count(3)->create(['value_type_id' => $type->id]);
        $this->withoutExceptionHandling();
        $this->expectException(Exception::class);
        $this->expectExceptionMessageMatches('/3/');
        $this->delete("$this->url/$type->id")->assertStatus(500);
        $this->assertDatabaseHas($this->table_name, ['id' => $type->id]);
    }
}
