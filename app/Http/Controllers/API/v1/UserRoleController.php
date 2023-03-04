<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

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
