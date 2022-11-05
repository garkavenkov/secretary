<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HouseholdType;
use App\Http\Requests\API\v1\HouseholdTypeRequest;
use App\Http\Resources\API\v1\HouseholdType\HouseholdTypeResource;
use App\Http\Resources\API\v1\HouseholdType\HouseholdTypeResourceCollection;

class HouseholdTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\HouseholdType\HouseholdTypeResourceCollection
     */
    public function index()
    {
        $types = HouseholdType::all();

        return new HouseholdTypeResourceCollection($types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\HouseholdTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HouseholdTypeRequest $request)
    {
        $type = HouseholdType::create($request->validated());

        if ($type) {
            return response()->json(['message' => 'Тип об\'єкта погосподарського отбліку був успішно додан'], 201);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Resources\API\v1\HouseholdType\HouseholdTypeResource
     */
    public function show($id)
    {
        $type = HouseholdType::findOrFail($id);

        return new HouseholdTypeResource($type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\API\v1\HouseholdTypeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HouseholdTypeRequest $request, $id)
    {
        $type = HouseholdType::findOrFail($id);

        $type->update($request->validated());

        if($type->save()) {
            return response()->json(['message' => 'Тип об\'єкта погосподарського обліку був успішно змінен']);
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
        $type = HouseholdType::findOrFail($id);

        if ($type->delete()) {
            return response()->json(['message' => 'Тип об\'єкта погосподарського обліку був успішно видален']);
        }
    }
}
