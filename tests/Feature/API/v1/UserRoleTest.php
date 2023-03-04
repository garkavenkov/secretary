<?php

namespace Tests\Feature\API\v1;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRoleTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_api_should_assign_user_roles()
    {
        $url = '/api/v1/assign-user-role';

        $role_1 = Role::factory()->create();
        $role_2 = Role::factory()->create();

        $data['user_id'] = $this->user->id;
        $data['role_id'] = "$role_1->id,$role_2->id";

        $this->post($url, $data)->assertStatus(200);

        $this->assertCount(2, $this->user->roles);
    }

    public function test_api_should_reject_user_role()
    {
        $url = "/api/v1/reject-user-role";

        $role_1 = Role::factory()->create();
        $role_2 = Role::factory()->create();

        $this->user->assignRoles([
            $role_1,
            $role_2
        ]);

        $data['user_id'] = $this->user->id;
        $data['role_id'] = $role_2->id;

        $this->post($url, $data)->assertStatus(200);

        $this->assertFalse($this->user->hasRole($role_2));
    }
}
