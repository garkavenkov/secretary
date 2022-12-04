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
        $info = HouseholdHouse::all();

        return HouseholdHouseResource::collection($info);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\HouseholdHouseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HouseholdHouseRequest $request)
    {
        $info = HouseholdHouse::create($request->validated());

        if ($info) {
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
        $info = HouseholdHouse::findOrFail($id);

        return new HouseholdHouseResource($info);
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
        $info = HouseholdHouse::findOrFail($id);

        $info->update($request->validated());
        if($info->save()) {
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
        $info = HouseholdHouse::findOrFail($id);

        if ($info->delete()) {
            return response()->json(['message' => 'Дані пули успішно видалені']);
        }
    }
}
