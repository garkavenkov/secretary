<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Models\AdditionalParam;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\AdditionalParamRequest;
use App\Http\Resources\API\v1\AdditionalParam\AdditionalParamResource;

class AdditionalParamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\AdditionalParam\AdditionalParamResource
     */
    public function index()
    {
        if (request()->input('category_id')) {
            $params = AdditionalParam::with('valueType')->where('category_id', request()->input('category_id'))->get();
        } else {
            $params = AdditionalParam::with('valueType')->get();
        }

        return AdditionalParamResource::collection($params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\AdditionalParamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdditionalParamRequest $request)
    {
        $param = AdditionalParam::create($request->validated());

        if ($param) {
            return response()->json(['message' => 'Додатковий параметр був успішно додан'], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Resources\API\v1\AdditionalParam\AdditionalParamResource
     */
    public function show($id)
    {
        $param = AdditionalParam::findOrFail($id);

        return new AdditionalParamResource($param);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\API\v1\AdditionalParamRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdditionalParamRequest $request, $id)
    {
        $param = AdditionalParam::findOrFail($id);

        $param->update($request->validated());

        if ($param->save()) {
            return response()->json(['message' => 'Додатковий параметр був успішно змінен']);
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
        $param = AdditionalParam::findOrFail($id);

        if ($param->delete()) {
            return response()->json(['message' => 'Додатковий параметр був успішно видален']);
        }
    }
}
