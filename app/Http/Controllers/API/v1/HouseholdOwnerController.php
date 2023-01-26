<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Models\HouseholdOwner;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\HouseholdOwnerRequest;
use App\Http\Resources\API\v1\HouseholdOwner\HouseholdOwnerResource;

class HouseholdOwnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\HouseholdOwner\HouseholdOwnerResource
     */
    public function index()
    {
        $owners = HouseholdOwner::all();

        return HouseholdOwnerResource::collection($owners);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\HouseholdOwnerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HouseholdOwnerRequest $request)
    {
        $owner = HouseholdOwner::create($request->validated());

        if ($owner) {
            return response()->json(['message' => 'Власник був уснішно додан'], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Resources\API\v1\HouseholdOwner\HouseholdOwnerResource;
     */
    public function show($id)
    {
        $owner = HouseholdOwner::findOrFail($id);

        return new HouseholdOwnerResource($owner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\API\v1\HouseholdOwnerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HouseholdOwnerRequest $request, $id)
    {
        $owner = HouseholdOwner::findOrFail($id);

        $owner->update($request->validated());

        if ($owner->save()) {
            return response()->json(['message' => 'Власник був успішно змінен']);
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
        $owner = HouseholdOwner::findOrFail($id);

        if ($owner->delete()) {
            return response()->json(['message' => 'Власник був успішно видален']);
        }
    }
}
