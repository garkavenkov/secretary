<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdditionalParamValueType;
use App\Http\Requests\API\v1\AdditionalParamValueTypeRequest;
use App\Http\Resources\API\v1\AdditionalParamValueType\AdditionalParamValueTypeResource;
use Exception;

class AdditionalParamValueTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\AdditionalParamValueType\AdditionalParamValueTypeResource
     */
    public function index()
    {
        $types = AdditionalParamValueType::all();

        return AdditionalParamValueTypeResource::collection($types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\AdditionalParamValueTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdditionalParamValueTypeRequest $request)
    {
        $type = AdditionalParamValueType::create($request->validated());

        if($type) {
            return response()->json(['message' => 'Тип був успішно додадн'], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Resources\API\v1\AdditionalParamValueType\AdditionalParamValueTypeResource
     */
    public function show($id)
    {
        $type = AdditionalParamValueType::findOrFail($id);

        return new AdditionalParamValueTypeResource($type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\API\v1\AdditionalParamValueTypeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdditionalParamValueTypeRequest $request, $id)
    {
        $type = AdditionalParamValueType::findOrFail($id);

        $type->update($request->validated());

        if ($type->save()) {
            return response()->json(['message' => 'Тип був успішно змінен']);
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
        $type = AdditionalParamValueType::findOrFail($id);

        if ($type->params->count() > 0) {
            $params_count = $type->params->count();
            $msg = 'Неможливо видалити тип.<br>';
            $msg .='Існує ' . trans_choice('plural.additional_param', $params_count, ['value' => $params_count]) . ' з даним типом значення.';
            throw new Exception($msg, 500);
        }

        if ($type->delete()) {
            return response()->json(['message' => 'Тип був успішно видален']);
        }
    }
}
