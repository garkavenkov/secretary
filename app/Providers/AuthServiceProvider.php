<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if (!app()->runningInConsole()) {
            $this->definePermissions();
        }
    }

    private function definePermissions()
    {

        try {
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
                        // dd($user->hasPermission($permission->code, 8));
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
        } catch (\Exception $e) {
            report($e);
            return false;
        }
    }
}
