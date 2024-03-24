<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Models\AdditionalParam;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\AdditionalParamRequest;
use App\Http\Resources\API\v1\AdditionalParam\AdditionalParamResource;
use App\Models\AdditionalParamCategory;
use App\Models\AdditionalParamValueType;
use App\Traits\Models\UserRights;

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
        
        if (!is_null($category_code)) {
            $category = AdditionalParamCategory::where('code', $category_code)->first();
            if ($category) {
                $category_id = $category->id;
            }
        }

        if (!is_null($category_id)) {
            $params = AdditionalParam::with('valueType')
                        ->where('category_id', $category_id);                        
        } else {
            $params = AdditionalParam::with('valueType');
        }
        
        if (!is_null($value_type_code)) {
            $value_type = AdditionalParamValueType::where('code', $value_type_code)->first();

            if ($value_type) {
                $value_type_id = $value_type->id;
            }
        }

        if (!is_null($value_type_id)) {
            $params = $params->where(function ($query) use($value_type_id) {
                                $query->where('value_type_id', '=', $value_type_id)
                                      ->orWhere(0, 0);
                            });                            
        } 

        $params = $params->orderBy('code')->get();
        
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
        $this->checkIfUserHasRightsTo('App\Models\AdditionalParam');

        $param = AdditionalParam::findOrFail($id);

        if ($param->delete()) {
            return response()->json(['message' => 'Додатковий параметр був успішно видален']);
        }
    }
}
