<?php

namespace App\Traits\Models;

use App\Models\Permission;
use App\Models\PermissionRight;

trait PermissionRights
{
    public function permissions()
    {
        return $this->morphToMany(Permission::class, 'owner', 'permission_rights')->withPivot(['right']);
    }

    public function grantPermission(Permission $permission, $right = 0)
    // public function grantPermission($permission, $right = 0)
    {
        // if (gettype($permission) == 'string') {
        //     $permission = Permission::where('code', $permission)->firstOrFail();
        // } else if (get_class($permission) !== 'App\Models\Permission') {
        //     return;
        // }
        $this->permissions()->attach($permission, ['right' => $right]);
    }

    public function hasPermission($permission, $right)
    {
        $permissions = [];

        // Direct permissions
        if (!is_null($this->permissions)) {
            array_push($permissions, ...$this->permissions->map(function($p) { return $p->code;}) );
        }

        // Role's permissions
        if (!is_null($this->roles)) {
            foreach($this->roles as $role) {
                array_push($permissions, ...$role->permissions->map(function($p) { return ['permission' => $p->code, 'right' => $p->pivot->right];}) );
            }
        }

        $result = array_filter($permissions, function($p) use($permission, $right) {
            return ($p['permission'] == $permission) && (($p['right'] & $right) == $right);
        });

        return count($result) > 0 ? true : false;
    }
}
