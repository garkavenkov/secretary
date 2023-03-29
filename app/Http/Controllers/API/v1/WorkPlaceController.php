<?php

namespace App\Http\Controllers\API\v1;

use App\Models\WorkPlace;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\WorkPlaceRequest;
use App\Http\Resources\API\v1\WorkPlace\WorkPlaceResource;
use App\Http\Resources\API\v1\WorkPlace\WorkPlaceResourceCollection;
use App\Traits\Models\UserRights;

class WorkPlaceController extends Controller
{
    use UserRights;

    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\PlaceWork\WorkPlaceResourceCollection
     */
    public function index()
    {
        $places = WorkPlace::all();

        return new WorkPlaceResourceCollection($places);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\WorkPlaceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkPlaceRequest $request)
    {
        $place = WorkPlace::create($request->validated());

        if ($place) {
            return response()->json(['message' => 'Місце роботи успішно додано'], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Resources\API\v1\PlaceWork\WorkPlaceResource
     */
    public function show($id)
    {
        $place = WorkPlace::findOrfail($id);

        return new WorkPlaceResource($place);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\API\v1\WorkPlaceRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WorkPlaceRequest $request, $id)
    {
        $place = WorkPlace::findOrFail($id);

        $place->update($request->validated());

        if ($place->save()) {
            return response()->json(['message' => 'Місце роботи успішно змінено']);
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
        $this->checkIfUserHasRightsTo('App\Models\WorkPlace');

        $place = WorkPlace::findOrFail($id);

        if ($place->delete()) {
            return response()->json(['message' => 'Місце роботи успішно видалено']);
        }
    }
}
