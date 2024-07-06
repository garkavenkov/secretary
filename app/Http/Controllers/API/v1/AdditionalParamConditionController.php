<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\AdditionalParamConditionRequest;
use App\Http\Resources\API\v1\AdditionalParamCondition\AdditionalParamConditionResource;
use App\Models\AdditionalParam;
use App\Models\AdditionalParamCondition;
use Illuminate\Http\Request;

class AdditionalParamConditionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $param_id = request()->input('param_id');

        if($param_id) {
            $parameter = AdditionalParam::findOrFail($param_id);
            $conditions = AdditionalParamCondition::where('param_id', $parameter->id)->get();    
        } else {
            $conditions = AdditionalParamCondition::all();
        }
        
        return AdditionalParamConditionResource::collection($conditions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\AdditionalParamConditionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdditionalParamConditionRequest $request)
    {        
        $condition = AdditionalParamCondition::create($request->validated());

        if($condition) {
            return response()->json(['message' => 'Умова відображення параметра успішно додана'], 201);
        }
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
     * @param  App\Http\Requests\API\v1\AdditionalParamConditionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdditionalParamConditionRequest $request, $id)
    {
        $condition = AdditionalParamCondition::findOrFail($id);

        $condition->update($request->validated());

        if ($condition->save())  {
            return response()->json(['message' => 'Умова відображення параметра успішно змінена'], 200);
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
        $condition = AdditionalParamCondition::findOrFail($id);

        if ($condition->delete()) {
            return response()->json(['message' => 'Умова відображення параметра успішно видалена'], 200);
        }
    }
}
