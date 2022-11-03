<?php

namespace App\Http\Controllers\API\v1;

use App\Models\CouncilType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\CouncilTypeRequest;
use App\Http\Resources\API\v1\CouncilType\CouncilTypeResource;
use App\Http\Resources\API\v1\CouncilType\CouncilTypeResourceCollection;

class CouncilTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\CouncilType\CouncilTypeResourceCollection
     */
    public function index()
    {
        $types = CouncilType::all();

        return new CouncilTypeResourceCollection($types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\CouncilTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouncilTypeRequest $request)
    {
        $type = CouncilType::create($request->validated());

        if ($type) {
            return response()->json(['message' => 'Тип ради був успішно додан'], 201);
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
        $type = CouncilType::findOrFail($id);

        return new CouncilTypeResource($type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\API\v1\CouncilTypeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CouncilTypeRequest $request, $id)
    {
        $type = CouncilType::findOrFail($id);

        $type->update($request->validated());

        if ($type->save()) {
            return response()->json(['message' => 'Тип ради був успішно відредагован']);
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
        $type = CouncilType::findOrFail($id);

        if($type->delete()) {
            return response()->json(['message' => 'Тип ради був успішно видален']);
        }
    }
}
