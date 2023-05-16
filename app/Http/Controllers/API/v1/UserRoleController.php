<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserRoleController extends Controller
{
    public function assignRole(Request $request)
    {
        if (!isset($request->user_id)) {
            throw new \Exception('Відсутній ID користувача');
        }
        if (!isset($request->role_id)) {
            throw new \Exception('Відсутній ID ролі');
        }

        $user = User::findOrFail($request->user_id);

        $ids  = explode(',',$request->role_id);

        $roles = Role::findOrFail($ids);

        foreach($roles as $role) {
            if (!$user->hasRole($role)) {
                $user->roles()->attach($role);
            }
        }
    }

    public function rejectRole(Request $request)
    {
        if (!isset($request->user_id)) {
            throw new \Exception('Відсутній ID користувача');
        }
        if (!isset($request->role_id)) {
            throw new \Exception('Відсутній ID ролі');
        }

        $user = User::findOrFail($request->user_id);

        $ids  = explode(',',$request->role_id);

        $roles = Role::findOrFail($ids);

        foreach($roles as $role) {
            if ($user->hasRole($role)) {
                $user->roles()->detach($role);
            }
        }
    }
}
