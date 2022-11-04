<?php

namespace App\Http\Controllers\API\v1;

use App\Models\PlaceWork;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\PlaceWorkRequest;
use App\Http\Resources\API\v1\PlaceWork\PlaceWorkResource;
use App\Http\Resources\API\v1\PlaceWork\PlaceWorkResourceCollection;

class PlaceWorkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\PlaceWork\PlaceWorkResourceCollection
     */
    public function index()
    {
        $places = PlaceWork::all();

        return new PlaceWorkResourceCollection($places);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\PlaceWorkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlaceWorkRequest $request)
    {
        $place = PlaceWork::create($request->all());

        if ($place) {
            return response()->json(['message' => 'Місце роботи успішно додано'], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Resources\API\v1\PlaceWork\PlaceWorkResource
     */
    public function show($id)
    {
        $place = PlaceWork::findOrfail($id);

        return new PlaceWorkResource($place);
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
        $place = PlaceWork::findOrFail($id);

        $place->update($request->all());

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
        $place = PlaceWork::findOrFail($id);

        if ($place->delete()) {
            return response()->json(['message' => 'Місце роботи успішно видалено']);
        }
    }
}
