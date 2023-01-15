<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HouseholdMemberMovement;
use App\Http\Requests\API\v1\HouseholdMemberMovementRequest;
use App\Http\Resources\API\v1\HouseholdMemberMovement\HouseholdMemberMovementResource;

class HouseholdMemberMovementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movements = HouseholdMemberMovement::all();

        return HouseholdMemberMovementResource::collection($movements);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\HouseholdMemberMovementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HouseholdMemberMovementRequest $request)
    {
        $movement = HouseholdMemberMovement::create($request->validated());

        if ($movement) {
            return response()->json(['message' => 'Подія успошно додана'], 201);
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
        //
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
        $event = HouseholdMemberMovement::findOrFail($id);

        $event->update($request->all());

        if ($event->save()) {
            return response()->json(['message' => 'Подія була успішно змінена']);
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
        $movement = HouseholdMemberMovement::findOrFail($id);

        if ($movement->delete()) {
            return response()->json(['message' => 'Подія була успішно видалена']);
        }
    }
}
