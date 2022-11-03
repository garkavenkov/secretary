<?php

namespace App\Http\Controllers\API\v1;

use App\Models\District;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\DistrictRequest;
use App\Http\Resources\API\v1\District\DistrictResource;
use App\Http\Resources\API\v1\District\DistrictResourceCollection;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\District\DistrictResourceCollection
     */
    public function index()
    {
        $districts = District::all();

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
        $district = District::findOrFail($id);

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
        $district = District::findOrFail($id);

        if ($district->delete()) {
            return response()->json(['message' => 'Район успішно видален']);
        }
    }
}
