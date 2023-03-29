<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\PositionRequest;
use App\Http\Resources\API\v1\Position\PositionResource;


class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\Appointment\PositionResource
     */
    public function index()
    {
        $positions = Position::all();

        return PositionResource::collection($positions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\POsitionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PositionRequest $request)
    {
        $position = Position::create($request->validated());

        if ($position) {
            return response()->json(['message' => 'Должность була успішно додана'], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Resources\API\v1\Appointment\PositionResource
     */
    public function show($id)
    {
        $position = Position::findOrFail($id);

        return new PositionResource($position);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\API\v1\PositionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PositionRequest $request, $id)
    {
        $position = Position::findOrFail($id);

        $position->update($request->validated());

        if ($position->save()) {
            return response()->json(['message' => 'Должность була успішно змінена']);
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
        $position = Position::findOrFail($id);

        if ($position->delete()) {
            return response()->json(['message' => 'Должность була успішно видалена']);
        }
    }
}
