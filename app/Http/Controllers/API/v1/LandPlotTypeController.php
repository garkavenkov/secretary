<?php

namespace App\Http\Controllers\API\v1;

use App\Models\LandPlotType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\LandPlotTypeRequest;
use App\Http\Resources\API\v1\LandPlotType\LandPlotTypeResource;
use App\Http\Resources\API\v1\LandPlotType\LandPlotTypeResourceCollection;

class LandPlotTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\LandPlotType\LandPlotTypeResourceCollection
     */
    public function index()
    {
        $types = LandPlotType::all();

        return new LandPlotTypeResourceCollection($types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\LandPlotTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LandPlotTypeRequest $request)
    {
        $type = LandPlotType::create($request->validated());

        if ($type) {
            return response()->json(['message' => 'Код був успішно додан'], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Resources\API\v1\LandPlotType\LandPlotTypeResource
     */
    public function show($id)
    {
        $type = LandPlotType::FindOrFail($id);

        return new LandPlotTypeResource($type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\API\v1\LandPlotTypeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LandPlotTypeRequest $request, $id)
    {
        $type = LandPlotType::findOrFail($id);

        $type->update($request->validated());

        if ($type->save()) {
            return response()->json(['message' => 'Код був успрішно змінен']);
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
        $type = LandPlotType::FindOrFail($id);

        if ($type->delete()) {
            return response()->json(['message' => 'Код був успішно видален']);
        }
    }
}
