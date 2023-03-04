<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RoleTest extends TestCase
{
    use RefreshDatabase;

    public function test_role_may_be_assigned_to_user()
    {
        $user = User::factory()->create();

        $role = Role::factory()->create();

        $user->assignRole($role);

        $this->assertCount(1, $role->users);
    }
}
