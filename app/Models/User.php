<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_role');
    }

    public function hasRole(Role $role): bool
    {
        return $this->roles->contains(function($r) use($role) {
            return $r->id == $role->id;
        });
    }

    public function assignRole(Role $role)
    {
        return $this->roles()->attach($role);
    }

    public function assignRoles($roles)
    {
        if (!is_array($roles)) {
            $roles = explode(',', $roles);
            $roles = Role::findOrFail($roles);
            foreach($roles as $role) {
                $this->assignRole($role);
            }
        } else {
            foreach($roles as $role) {
                if ($role instanceof \App\Models\Role) {
                    $this->assignRole($role);
                } else {
                    $role = Role::findOrFail($role);
                    $this->assignRole($role);
                }
            }
        }


    }
}
