<?php

namespace App\Http\Controllers\API\v1;

use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\DistrictRequest;
use App\Http\Resources\API\v1\District\DistrictResource;
use App\Http\Resources\API\v1\District\DistrictResourceCollection;
use App\Traits\Models\UserRights;

class DistrictController extends Controller
{
    use UserRights;

    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\District\DistrictResourceCollection
     */
    public function index()
    {
        $districts = District::with('region')->get();

        return new DistrictResourceCollection($districts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\DistrictRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(DistrictRequest $request)
    {
        $district = District::create($request->validated());

        if ($district) {
            return response()->json(['message' => 'Район успішно додан'], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Resources\API\v1\District\DistrictResource
     */
    public function show($id)
    {
        $district = District::with('region', 'communities')->findOrFail($id);

        return new DistrictResource($district);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\API\v1\DistrictRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DistrictRequest $request, $id)
    {
        $district = District::findOrFail($id);

        $district->update($request->validated());

        if ($district->save()) {
            return response()->json(['message' => 'Район успішно відредагован']);
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
        $this->checkIfUserHasRightsTo('App\Models\District');

        $district = District::findOrFail($id);

        if ($district->delete()) {
            return response()->json(['message' => 'Район успішно видален']);
        }
    }
}
