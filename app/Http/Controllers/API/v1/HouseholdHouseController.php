<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Models\HouseholdHouse;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\HouseholdHouseRequest;
use App\Http\Resources\API\v1\HouseholdHouse\HouseholdHouseResource;
use App\Http\Resources\API\v1\HouseholdHouse\HouseholdHouseResourceCollection;

class HouseholdHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\HouseholdHouse\HouseholdHouseResource
     */
    public function index()
    {
        $year = HouseholdHouse::all();

        return HouseholdHouseResource::collection($year);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\HouseholdHouseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HouseholdHouseRequest $request)
    {
        $year = HouseholdHouse::create($request->validated());

        if ($year) {
            return response()->json(['message' => 'Дані успішно додані'], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Resources\API\v1\HouseholdHouse\HouseholdHouseResource
     */
    public function show($id)
    {
        $year = HouseholdHouse::findOrFail($id);

        return new HouseholdHouseResource($year);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\API\v1\HouseholdHouseRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HouseholdHouseRequest $request, $id)
    {
        $year = HouseholdHouse::findOrFail($id);

        $year->update($request->validated());
        if($year->save()) {
            return response()->json(['message' => 'Дані були успішно змінені']);
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
        $year = HouseholdHouse::findOrFail($id);

        if ($year->delete()) {
            return response()->json(['message' => 'Дані пули успішно видалені']);
        }
    }
}
