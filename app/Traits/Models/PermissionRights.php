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
    {
        $this->permissions()->attach($permission, ['right' => $right]);
    }

    public function hasPermission($model, $right)
    {
        $permissions = [];

        // Direct permissions
        if (!is_null($this->permissions)) {
            array_push($permissions, ...$this->permissions->map(function($p) { return $p->code;}) );
        }

        // Role's permissions
        if (!is_null($this->roles)) {
            foreach($this->roles as $role) {
                // dd($role->permissions()->first()->right);
                array_push($permissions, ...$role->permissions->map(function($p) { return ['model' => $p->code, 'right' => $p->pivot->right];}) );
            }
            // dd($permissions);
        }
        // dd($model, $right);
        // dd(15 & 9);
        $result = array_filter($permissions, function($p) use($model, $right) {
            // dd($p);
            return ($p['model'] == $model) && (($p['right'] & $right) == $right);
        });
        return count($result) > 0 ? true : false;
        // return in_array($permission, $permissions) ? true : false;
    }
}
