<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdditionalParamValue;
use Illuminate\Support\Facades\Auth;

class AdditionalParamValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $values = AdditionalParamValue::get();

        return AdditionalParamValueResource::collection($values);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function setAdditionalParams(Request $request)
    {
        // dd($request->all());
        // Owner model
        if (!isset($request->owner)) {
            throw new \Exception('Відсутній тип власника додаткових параметрів');
        }
        $model = $request->owner;
        $request->request->remove('owner');

        // $permission = Permission::where('code', 'App\Models\AdditionalParamValue')->first();
        // $permission = Permission::where('code', $model)->first();
        // if (!Auth::user()->hasPermission($permission->code, 8)) {
        //     $error_msg = 'У Вас відсутні права на редагування додаткових параметрів';
        //     return response()->json(['message' => $error_msg], 403);
        // }

        // Owner ID
        if (!isset($request->owner_id)) {
            throw new \Exception('Відсутній ID власника додаткових параметрів');
        }
        $owner_id = $request->owner_id;
        $request->request->remove('owner_id');
        // dd($owner_id);
        $owner = $model::findOrFail($owner_id);

        // dd($owner);

        foreach($request->all() as $param => $value) {
            $param = $owner->getAdditionalParam($param);

            if ($param) {
                if ($value) {
                    $owner->setAdditionalParamValue($param->id, $value);
                } else {
                    $owner->clearAdditionalParam($param->id);
                }
            }
        }
        return response()->json(['message' => 'Додаткова параметри були успішно встановлені']);
    }
}
