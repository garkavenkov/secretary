<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\v1\Household\HouseholdResource;
use App\Http\Resources\API\v1\Household\HouseholdResourceCollection;
use App\Models\Household;
use Illuminate\Http\Request;

class HouseholdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\Household\HouseholdResourceCollection
     */
    public function index()
    {
        $households = Household::all();

        return new HouseholdResourceCollection($households);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Resources\API\v1\Household\HouseholdResource
     */
    public function show($id)
    {
        $household = Household::findOrFail($id);

        return new HouseholdResource($household);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
