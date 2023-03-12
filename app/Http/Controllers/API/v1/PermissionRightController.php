<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Role;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\API\v1\PermissionRight\PermissionRightResource;
use App\Models\PermissionRight;

class PermissionRightController extends Controller
{

    public function grantPermissions(Request $request)
    {
        // dd($request->all());
        if (!$request->owner) {
            return response()->json(['message' => 'Відсутній ID власника'], 404);
        }
        $owner_id = $request->owner;

        if (!$request->owner_type) {
            return response()->json(['message' => 'Відсутній тип власника'], 404);
        }
        $owner_type = $request->owner_type;

        if (!$request->rights) {
            return response()->json(['message' => 'Відсутній перелік дозволів'], 404);
        }

        // $permissions = [];
        $rights = [];
        // check if rights is not null, i.e. all right has been revoked
        foreach (explode(',', $request->rights) as $right) {
            $pair = explode(':', $right);

            if (count($pair) !== 2) {
                return response()->json(['message' => 'Неприпустимий формат'], 500);
            } else {
                // $permissions[] = $pair[0];
                $rights[$pair[0]] = $pair[1];
            }
        };

        // dd($rights);
        $permission_ids = array_keys($rights);
        // dd($permission_id);
        $permissions = Permission::findOrFail($permission_ids);

        if ($owner_type == 'role') {
            $owner_type = 'App\Models\Role';
            $owner = Role::findOrFail($owner_id);
        } else if ($owner_type == 'user') {
            $owner_type = 'App\Models\User';
            $owner = User::findOrFail($owner_id);
        }


        if (count($rights) > 0) {
            $owner->permissions()->detach($permission_ids);
            foreach($permissions as $permission) {
                // $owner->permissions()->attach($permission->id, ['right' => $rights[$permission->id]]);
                PermissionRight::create([
                    'owner_id' =>  $owner_id,
                    'owner_type' => $owner_type,
                    'permission_id' =>  $permission->id,
                    'right' =>  $rights[$permission->id]
                ]);
            }
            return response()->json(['message' => 'Дозволи були успішно надані']);
        } else {
            $owner->permissions()->detach();
            return response()->json(['message' => 'Дозволи були успішно відкликані']);
        }


    }

    public function grantedPermissions(Request $request)
    {
        if (!isset($request->type)) {
            return response()->json(['message' => 'Відсутній тип'], 404);
        }

        if (!isset($request->owner)) {
            return response()->json(['message' => 'Відсутній ID'], 404);
        }

        $type = '';
        if ($request->type == 'role') {
            $type = 'App\Models\Role';
        } else if ($request->type == 'user') {
            $type = 'App\Models\User';
        } else {
            return response()->json(['message' => "Тип $request->type  підтримується"], 500);
        }


        $owner = $type::findOrFail($request->owner);


        $result = DB::table('permissions as p')
                    ->select([
                        'p.id',
                        'p.name',
                        'pr.right',
                        DB::raw("CASE (pr.right & 8)  WHEN 8 THEN true ELSE false END AS 'create'"),
                        DB::raw("CASE (pr.right & 4)  WHEN 4 THEN true ELSE false END AS 'read'"),
                        DB::raw("CASE (pr.right & 2)  WHEN 2 THEN true ELSE false END AS 'update'"),
                        DB::raw("CASE (pr.right & 1)  WHEN 1 THEN true ELSE false END AS 'delete'")
                    ])
                    ->leftJoin('permission_rights as pr', function($leftJoin) use($type, $owner) {
                        $leftJoin
                            ->on('pr.permission_id', '=', 'p.id')
                            ->on('pr.owner_id', $owner->id)
                            ->on('pr.owner_type', $type);
                    })
                    // ->where('pr.owner_type', $type)
                    // ->where('pr.owner_id', $owner->id)
                    ->get();

        // $permissions = Permission::all();

        // return response()->json($result);
        return PermissionRightResource::collection($result);
    }
}
