<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Models\HouseholdLand;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\HouseholdLandRequest;
use App\Http\Resources\API\v1\HouseholdLand\HouseholdLandResource;
use App\Traits\Models\UserRights;

class HouseholdLandController extends Controller
{
    use UserRights;

    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\HouseholdLand\HouseholdLandResource
     */
    public function index()
    {
        $years = HouseholdLand::get();

        return HouseholdLandResource::collection($years);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\HouseholdLandRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HouseholdLandRequest $request)
    {
        $year = HouseholdLand::create($request->validated());

        if ($year) {
            return response()->json(['message' => 'Дані успішно додані'], 201);
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
        $year = HouseholdLand::findOrFail($id);

        return new HouseholdLandResource($year);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HouseholdLandRequest $request, $id)
    {
        $year = HouseholdLand::findOrFail($id);

        $year->update($request->validated());

        if ($year->save()) {
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
        $this->checkIfUserHasRightsTo('App\Models\HouseholdLand');

        $year = HouseholdLand::findOrFail($id);

        if ($year->delete()) {
            return response()->json(['message' => 'Дані були успішно видалені']);
        }
    }
}
