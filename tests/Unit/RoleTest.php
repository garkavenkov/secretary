<?php

namespace Tests\Unit;

use App\Models\Permission;
use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    private $role;

    protected function setUp(): void
    {
        parent::setUp();

        $this->role = Role::factory()->create();
    }


    public function test_role_may_be_assigned_to_user()
    {
        $user = User::factory()->create();

        $user->assignRole($this->role);

        $this->assertCount(1, $this->role->users);
    }

    public function test_permission_may_have_been_granted_to_role()
    {
        $this->role->grantPermission(Permission::factory()->create());

        $this->assertCount(1, $this->role->permissions);
    }

    public function test_role_has_a_permission()
    {
        $this->role->grantPermission(Permission::factory()->create(['code' => 'permission']));

        $this->assertTrue($this->role->hasPermission('permission'));
    }
}
