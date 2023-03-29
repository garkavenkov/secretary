<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\Models\UserRights;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\API\v1\User\UserResource;

class UserController extends Controller
{
    use UserRights;

    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\User\UserResource
     */
    public function index()
    {
        $users = User::all();

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->checkIfUserHasRightsTo('App\Models\User');

        Validator::make(
            $request->all(),
            [
                'name'      =>  ['required', 'string', 'max:255'],
                'user_name' =>  ['required', 'string', 'max:255', 'min:3', 'unique:users'],
                'email'     =>  ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password'  =>  ['required', 'string', 'min:8', 'confirmed'],
                'position'  =>  ['nullable', 'min:3']
            ],
            [
                'user_name.required'    =>  'Ви не указали логін користувача',
                'user_name.min'         =>  'Логін повинен бути більш ніж :min символів',
                'user_name.unique'      =>  'Такий лоігн вже існує',
                'name.required'         =>  'Ви не указали ПІБ користувача',
                'name.min'              =>  'ПІБ користувача повинен бути більш ніж :min символів',
            ]
        )->validate();

        $user = User::create($request->all());

        if ($user) {
            return response()->json(['message' => 'Користувач був успішно додан'], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Resources\API\v1\User\UserResource
     */
    public function show($id)
    {
        $user = User::with('roles')->findOrFail($id);

        return new UserResource($user);
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
        $this->checkIfUserHasRightsTo('App\Models\User');

        $user = User::findOrFail($id);

        $user->update($request->all());

        if ($user->save()) {
            return response()->json(['message' => 'Інформація була успішно змінена']);
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
        $this->checkIfUserHasRightsTo('App\Models\User');
    }

    public function uploadPhoto(Request $request, User $user)
    {
        // dd($request->photo);
        if (isset($request->photo)) {
            $imageName = $user->user_name .'.' .$request->photo->extension();
            // dd($imageName);
            $path = $request->photo->storeAs('users', $imageName);
            // dd($path);
            // $request->file->move(public_path('img/users'), $imageName);
            $user->photo = $imageName;

            if ($user->save()) {
                return response()->json(['message' => 'Фото користувача було успішно додано']);
            }
        } else {
            throw new \Exception('File did not send');
        }
    }

    public function userRoles(Request $request, User $user)
    {
        $this->checkIfUserHasRightsTo('App\Models\User');

        // dd($user, $request->rolesIds);
        if (!isset($request->roles)) {
            $user->roles()->detach();
            return response()->json(['message' => 'Ролі були успішно відкликані']);
        } else {
            $ids = explode(',', $request->roles);
            $roles = Role::findOrFail($ids);

            $user->roles()->detach();

            foreach($roles as $role) {
                $user->assignRole($role);
            }
            return response()->json(['message' => 'Ролі були успішно надані']);
        }
    }
}
