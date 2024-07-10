<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Models\AdditionalParam;
use App\Traits\Models\UserRights;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\AdditionalParamCategory;
use App\Models\AdditionalParamValueType;
use App\Http\Requests\API\v1\AdditionalParamRequest;
use App\Http\Resources\API\v1\AdditionalParam\AdditionalParamResource;

class AdditionalParamController extends Controller
{
    use UserRights;
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\AdditionalParam\AdditionalParamResource
     */
    public function index()
    {       
        $category_id = request()->input('category_id');
        $category_code = request()->input('category_code');
        $value_type_id = request()->input('value_type_id');
        $value_type_code = request()->input('value_type_code');
        $owner_id   = request()->input('owner_id');

        $params = AdditionalParam::query()
                    ->join('additional_param_value_types as apvt', 'additional_params.value_type_id', '=', 'apvt.id')
                    ->join('additional_param_categories as apc', 'additional_params.category_id', '=', 'apc.id')
                    ->when($owner_id, function($q) use($owner_id) {
                        $q->leftJoin('additional_param_values as apv', function($join) use($owner_id) {
                            $join->on('additional_params.id', '=', 'apv.param_id');
                            $join->on('apv.owner_id', '=', $owner_id);
                        });
                    })
                    ->select(
                        'additional_params.id',
                        'additional_params.code', 
                        'additional_params.name',
                        'additional_params.is_system',
                        'additional_params.category_id',
                        'apc.name as category_name',
                        'apvt.code as value_type_code',                        
                    )
                    ->when($owner_id, function($q) {
                        $q->addSelect('apv.value');
                    })
                    ->when($category_id, function($q) use ($category_id) {
                        $q->where('apc.id', $category_id);
                    })
                    ->when($category_code, function($q) use ($category_code) {
                        $q->where('apc.code', $category_code);
                    })
                    ->when($value_type_id , function($q) use ($value_type_id) {
                        $q->where('apvt.id', $value_type_id);
                    })
                    ->when($value_type_code , function($q) use ($value_type_code) {
                        $q->where('apvt.code', $value_type_code);
                    })                    
                    ->orderBy('additional_params.code')        
                    ->get();
        
        return AdditionalParamResource::collection($params);
        
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
        $param = AdditionalParam::with('conditions.attribute')->findOrFail($id);

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
        $this->checkIfUserHasRightsTo('App\Models\AdditionalParam');

        $param = AdditionalParam::findOrFail($id);

        if ($param->delete()) {
            return response()->json(['message' => 'Додатковий параметр був успішно видален']);
        }
    }
}
