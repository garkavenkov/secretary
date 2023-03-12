<?php

namespace App\Models;

use App\Traits\Models\PermissionRights;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory, PermissionRights;

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_role');
    }

}
