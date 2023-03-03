<?php

namespace App\Http\Controllers\API\v1;

use Exception;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\RoleRequest;
use App\Http\Resources\API\v1\Role\RoleResource;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();

        return RoleResource::collection($roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = Role::create($request->validated());

        if ($role) {
            return response()->json(['message' => 'Роль була успішно додана'], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);

        return new RoleResource($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\API\v1\RoleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id)
    {
        $role = Role::findOrFail($id);

        $role->update($request->validated());

        if ($role->save()) {
            return response()->json(['message' => 'Роль була успішно змінена']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);

        if ($role->system) {
            return response()->json(['message' => 'Неможливо видалити системну роль'], 500);
            throw new Exception();
        }

        if ($role->delete()) {
            return response()->json(['message' => 'Роль була успішно видалена']);
        }
    }
}
