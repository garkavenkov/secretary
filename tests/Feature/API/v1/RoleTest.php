<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\Role;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    private $url;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = '/api/v1/roles';
    }

    public function test_api_should_return_roles()
    {
        Role::factory()->count(5)->create();

        $response = $this->get($this->url)->getData();

        $this->assertCount(5, $response->data);
    }

    public function test_api_should_return_single_role()
    {
        $role = Role::factory()->create(['code' => 'role']);

        $response = $this->get("$this->url/$role->id")->getData();

        $this->assertEquals($response->data->code, $role->code);
    }

    public function test_api_should_create_role()
    {
        $role = Role::factory()->make(['code' => 'role'])->toArray();

        $this->post($this->url, $role)->assertStatus(201);

        $this->assertCount(1, Role::all());
    }

    public function test_api_should_update_role()
    {
        $role = Role::factory()->create(['code' => 'code for update']);

        $data = $role->toArray();
        $data['code'] = 'updated role';

        $this->patch("$this->url/$role->id", $data)->assertStatus(200);

        $this->assertDatabaseHas('roles', ['id' => $role->id, 'code' => $data['code']]);
    }

    public function test_api_should_delete_role()
    {
        $role = Role::factory()->create();

        $this->delete("$this->url/$role->id")->assertStatus(200);

        $this->assertCount(0, Role::all());
    }

    public function test_api_MUST_NOT_delete_system_role()
    {
        $role = Role::factory()->create(['system' => true]);

        $this->delete("$this->url/$role->id")->assertStatus(500);

        $this->assertCount(1, Role::all());
    }

    /**
     * @dataProvider dataProvider
     */
    public function test_api_MUST_NOT_create_role_id_data_did_not_pass_validation($field, $value)
    {
        Role::factory()->create(['code' => 'code', 'name' => 'name']);
        $role = Role::factory()->make([$field => $value])->toArray();

        $this->post($this->url, $role)->assertSessionHasErrors($field);

        $this->assertCount(1, Role::all());
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
        ];
    }
}
