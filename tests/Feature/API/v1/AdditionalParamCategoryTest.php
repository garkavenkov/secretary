<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\AdditionalParamCategory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdditionalParamCategoryTest extends TestCase
{
    use RefreshDatabase;

    private $url;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = '/api/v1/additional-param-categories';

        $this->loginWithPermission('App\Models\AdditionalParamCategory', 15);
    }

    public function test_api_should_return_additional_param_categories()
    {
        AdditionalParamCategory::factory()->count(3)->create();

        $response = $this->get($this->url)->getData();

        $this->assertCount(3, $response->data);
    }

    public function test_api_should_return_category()
    {
        $category = AdditionalParamCategory::factory()->create(['code' => 'category']);

        $response = $this->get("$this->url/$category->id")->getData();

        $this->assertEquals($response->data->code, $category->code);
    }

    public function test_api_should_create_category()
    {
        $category = AdditionalParamCategory::factory()->make(['code' => 'Category'])->toArray();

        $this->post($this->url, $category)->assertStatus(201);

        $this->assertDatabaseHas('additional_param_categories', ['code' => 'Category']);
    }

    public function test_api_should_update_category()
    {
        $category = AdditionalParamCategory::factory()->create(['code' => 'Code before update']);

        $data = $category->toArray();
        $data['code'] = 'Update Category';

        $this->patch("$this->url/$category->id", $data)->assertStatus(200);

        $this->assertDatabaseHas('additional_param_categories', ['code' => $data['code']]);
    }

    public function test_api_should_delete_category()
    {
        $category = AdditionalParamCategory::factory()->create();

        $this->delete("$this->url/$category->id")->assertStatus(200);

        $this->assertDatabaseMissing('additional_param_categories', ['id' => $category->id]);
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_api_MUST_NOT_create_category_if_data_did_not_pass_validation($field, $value)
    {
        AdditionalParamCategory::factory()->create(['code'  => 'category', 'name' => 'Категорія' ]);

        $category = AdditionalParamCategory::factory()
                        ->make([
                            $field => $value
                        ])
                        ->toArray();

        $this->post($this->url, $category)->assertSessionHasErrors($field);

        $this->assertDatabaseCount('additional_param_categories', 1);
    }

    public function dataProvider(): array
    {
        return [
            'code is empty'             =>  ['code',    ''          ],
            'code is not long enough'   =>  ['code',    'qw'        ],
            'code is already exists'    =>  ['code',    'category'  ],
            'name is empty'             =>  ['name',    ''          ],
            'name is not long enough'   =>  ['name',    'qw'        ],
            'name is already exists'    =>  ['name',    'Категорія' ],
        ];
    }
}
