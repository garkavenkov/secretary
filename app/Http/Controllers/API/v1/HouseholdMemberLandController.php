<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\HouseholdMemberLandRequest;
use App\Http\Resources\API\v1\HouseholdMemberLand\HouseholdMemberLandResource;
use App\Models\HouseholdMember;
use App\Models\HouseholdMemberLand;
use App\Traits\Models\UserRights;
use Illuminate\Http\Request;

class HouseholdMemberLandController extends Controller
{
    use UserRights;

    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\HouseholdMemberLand\HouseholdMemberLandResource
     */
    public function index()
    {
        $years = HouseholdMemberLand::all();

        return HouseholdMemberLandResource::collection($years);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\HouseholdMemberLandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HouseholdMemberLandRequest $request)
    {
        $year = HouseholdMemberLand::create($request->validated());

        if ($year) {
            return response()->json(['message' => 'Інформація була успішно додана'], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Resources\API\v1\HouseholdMemberLand\HouseholdMemberLandResource
     */
    public function show($id)
    {
        $year = HouseholdMemberLand::findOrFail($id);

        return new HouseholdMemberLandResource($year);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\API\v1\HouseholdMemberLandRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HouseholdMemberLandRequest $request, $id)
    {
        $year = HouseholdMemberLand::findOrFail($id);

        $year->update($request->validated());

        if ($year->save()) {
            return response()->json(['message' => 'Інформація була успішно змінена']);
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
        $this->checkIfUserHasRightsTo('App\Models\HouseholdMemberLand');

        $year = HouseholdMemberLand::findOrFail($id);

        if ($year->delete()) {
            return response()->json(['message' => 'Інформація була успішно видалена']);
        }
    }
}
