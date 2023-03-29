<?php

namespace App\Traits\Models;

use Exception;
use App\Models\PermissionRight;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

// use Illuminate\Support\Facades\Gate;

trait UserRights {

    /**
     * Check if user has rights to perform operation with module
     *
     * @param String $module
     * @return void
     */
    public function checkIfUserHasRightsTo($model)
    {
        if (Auth::user()->user_name == 'administrator') {
            return true;
        };

        $action = '';
        switch (request()->method()) {
            case 'GET':
                $action = 'read';
                break;
            case 'POST':
                $action = 'create';
                break;
            case 'PATCH':
                $action = 'update';
                break;
            case 'DELETE':
                $action = 'delete';
                break;
            default:
                throw new Exception("Неприпустимий метод '". request()->method() ."'.");
                break;
        }

        // if (!Gate::has("$module:$method")) {
        //     throw new Exception("Разрешение '$module:$method' отсутствует в справочнике 'Разрешения'. <br/>Обратитесь к администратору системы.");
        // }
        Gate::authorize("$model:$action");
        // Gate::authorize($model);
        // Auth::user()->hasPermission($model, $right);
    }
}
