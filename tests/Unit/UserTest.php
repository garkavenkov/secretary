<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }


    public function test_user_may_have_roles()
    {
        $role = Role::factory()->create();

        $this->user->assignRole($role);

        $this->assertCount(1, $this->user->roles);
    }

    public function test_check_if_user_has_role()
    {
        $role = Role::factory()->create();

        $this->assertFalse($this->user->hasRole($role));
    }

    public function test_attach_several_roles_at_once()
    {
        $this->user->assignRoles([
            Role::factory()->create()->id,
            Role::factory()->create()->id,
            Role::factory()->create()->id,
        ]);

        $this->assertCount(3, $this->user->roles);
    }

    public function test_user_may_have_permission()
    {
        $this->user->grantPermission(Permission::factory()->create());

        $this->assertCount(1, $this->user->permissions);
    }
}
