<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\Permission;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    private $url;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = '/api/v1/permissions';
    }

    public function test_api_should_return_permissions()
    {
        Permission::factory()->count(5)->create();

        $response = $this->get($this->url)->getData();

        $this->assertCount(5, $response->data);
    }

    public function test_api_should_return_single_perrmission()
    {
        $permission = Permission::factory()->create(['code' => 'permission']);

        $response = $this->get("$this->url/$permission->id")->getData();

        $this->assertEquals($response->data->code, $permission->code);
    }

    public function test_api_should_create_permission()
    {
        $permission = Permission::factory()->make(['code' => 'permission'])->toArray();

        $this->post($this->url, $permission)->assertStatus(201);

        $this->assertCount(1, Permission::all());
    }

    public function test_api_should_update_permission()
    {
        $permission = Permission::factory()->create(['code' => 'permission for update']);

        $data = $permission->toArray();
        $data['code'] = 'updated permission';

        $this->patch("$this->url/$permission->id", $data)->assertStatus(200);

        $this->assertDatabaseHas('permissions', ['id' => $permission->id, 'code' => $data['code']]);
    }

    public function test_api_should_delete_permission()
    {
        $permission = Permission::factory()->create();

        $this->delete("$this->url/$permission->id")->assertStatus(200);

        $this->assertCount(0, Permission::all());
    }


    /**
     * @dataProvider dataProvider
     */
    public function test_api_MUST_NOT_create_permission_if_data_did_not_pass_validation($field, $value)
    {
        Permission::factory()->create(['code' => 'code', 'name' => 'name']);

        $permission = Permission::factory()->make([$field => $value])->toArray();

        $this->post($this->url, $permission)->assertSessionHasErrors($field);

        $this->assertCount(1, Permission::all());
    }

    public function dataProvider(): array
    {
        return [
            'code is empty'                     =>  ['code',            ''],
            'code is not long enough'           =>  ['code',          'qw'],
            'code is already exists'            =>  ['code',        'code'],
            'name is empty'                     =>  ['name',            ''],
            'name is not long enough'           =>  ['name',          'qw'],
            'name is already exists'            =>  ['name',        'name'],
            'description is empty'              =>  ['description',     ''],
            'description is not long enough'    =>  ['description',   'qw'],
            'error is not long enough'          =>  ['error',         'qw'],
        ];
    }
}
