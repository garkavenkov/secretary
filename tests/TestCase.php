<?php

namespace Tests;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();

        $this->be($user);
    }

    public function loginWithPermission($permission, $right = 0)
    {
        $user = $this->userWithPermissions($permission, $right);

        $this->definePermissions();

        $this->actingAs($user);

        return $user;
    }

    /**
     * Create user with permissions.
     *
     * @param $permissions
     * @param null $user
     * @return mixed|null
     */
    private function userWithPermissions($permission, $right = 0, $user = null)
    {
        $permission = Permission::factory()->create(['code'=>$permission]);
        if (!$user) {
            $role = Role::factory()->create(['code'=>'role', 'name'=>'Role']);
            $user = User::factory()->create();
            $user->assignRole($role);
        } else {
            $role = $user->roles->first();
        }
        $role->grantPermission($permission, $right);

        return $user;
    }

    /**
     * Registers defined permissions.
     */
    private function definePermissions()
    {
        $actions = ['create', 'read', 'update', 'delete'];

        Permission::get()->map(function ($permission) use($actions) {

            foreach($actions as $action) {
                $code = "$permission->code:$action";
                switch ($action) {
                    case 'create':
                        $right = 8;
                        $_action = 'створення';
                        break;
                    case 'read':
                        $right = 4;
                        $_action = 'читання';
                        break;
                    case 'update':
                        $right = 2;
                        $_action = 'редагування';
                        break;
                    case 'delete':
                        $right = 1;
                        $_action = 'видалення';
                        break;
                }
                Gate::define($code, function ($user) use ($permission, $right, $_action) {
                    return $user->hasPermission($permission->code, $right)
                                ? Response::allow()
                                : Response::deny(
                                    isset($permission->error)
                                    ? str_replace('{{action}}', $_action , $permission->error)
                                    : 'У Вас відсутні права на виконання данної операції'
                                );
                });
            }
        });
    }
}
