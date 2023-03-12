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

    public function grantPermission(Permission $permission)
    {
        $this->permissions()->attach($permission);
    }

    public function hasPermission($permission): bool
    {
        $permissions = [];

        // Direct permissions
        if (!is_null($this->permissions)) {
            array_push($permissions, ...$this->permissions->map(function($p) { return $p->code;}) );
        }

        // Role's permissions
        if (!is_null($this->roles)) {
            foreach($this->roles as $role) {
                array_push($permissions, ...$role->permissions->map(function($p) { return $p->code;}) );
            }
        }

        return in_array($permission, $permissions) ? true : false;
    }
}
