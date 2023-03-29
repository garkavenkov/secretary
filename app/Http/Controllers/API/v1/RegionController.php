<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Region;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\RegionRequest;
use App\Http\Resources\API\v1\Region\RegionResource;
use App\Http\Resources\API\v1\Region\RegionResourceCollection;
use App\Traits\Models\UserRights;

class RegionController extends Controller
{
    use UserRights;

    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\Region\RegionResourceCollection
     */
    public function index()
    {
        $regions = Region::all();

        return new RegionResourceCollection($regions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\RegionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegionRequest $request)
    {
        $region = Region::create($request->validated());

        if ($region) {
            return response()->json(['message' => 'Область була успішно додана'], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Resources\API\v1\Region\RegionResource
     */
    public function show($id)
    {
        $region = Region::with('districts')->findOrFail($id);

        return new RegionResource($region);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\API\v1\RegionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RegionRequest $request, $id)
    {
        $region = Region::findOrFail($id);

        $region->update($request->validated());

        if ($region->save()) {
            return response()->json(['message' => 'Область була успішно відредагована']);
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
        $this->checkIfUserHasRightsTo('App\Models\Region');

        $region = Region::findOrFail($id);

        if ($region->delete()) {
            return response()->json(['message' => 'Область була успішно видалена']);
        }
    }
}
