<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Household;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\HouseholdRequest;
use App\Http\Resources\API\v1\Household\HouseholdResource;
use App\Http\Resources\API\v1\Household\HouseholdResourceCollection;

class HouseholdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\Household\HouseholdResourceCollection
     */
    public function index()
    {
        if (request()->query('search')) {
            $search  = request()->query('search');

            $households = Household::with('settlement')->where('address', 'like', '%'. $search . '%')->get();
        } else {
            $households = Household::with('settlement')->get();
        }


        return new HouseholdResourceCollection($households);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\HouseholdRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HouseholdRequest $request)
    {
        // dd($request->validated());
        $household = Household::create($request->validated());

        if ($household) {
            return response()->json(['message' => 'Облікова картка успішно додана'], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Resources\API\v1\Household\HouseholdResource
     */
    public function show($id)
    {
        $household = Household::with('settlement', 'type', 'members.familyRelationship', 'members.workPlace', 'houseYears')->findOrFail($id);

        return new HouseholdResource($household);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HouseholdRequest $request, $id)
    {
        $household = Household::findOrFail($id);

        $household->update($request->validated());

        if ($household->save()) {
            return response()->json(['message' => 'Облікова картка була успішно змінена']);
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
        $household = Household::findOrFail($id);

        if ($household->delete()) {
            return response()->json(['message' => 'Облікова картка була успішно видалена']);
        }
    }

    public function addOwner(Request $request)
    {
        dd($request->all());
    }
}
