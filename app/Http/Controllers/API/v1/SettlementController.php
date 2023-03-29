<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Settlement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\SettlementRequest;
use App\Http\Resources\API\v1\Settlement\SettlementResource;
use App\Http\Resources\API\v1\Settlement\SettlementResourceCollection;
use App\Traits\Models\UserRights;

class SettlementController extends Controller
{
    use UserRights;

    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\Settlement\SettlementResourceCollection
     */
    public function index()
    {
        $settlements = Settlement::with('council', 'type')->get();

        return new SettlementResourceCollection($settlements);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\SettlementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettlementRequest $request)
    {
        $settlement = Settlement::create($request->validated());

        if ($settlement) {
            return response()->json(['message' => 'Поселення успішно додано'], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Resources\API\v1\Settlement\SettlementResource
     */
    public function show($id)
    {
        $settlement = Settlement::with('council.community.district.region', 'type')->findOrFail($id);

        return new SettlementResource($settlement);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\API\v1\SettlementRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettlementRequest $request, $id)
    {
        $settlement = Settlement::findOrFail($id);

        $settlement->update($request->validated());

        if ($settlement->save()) {
            return response()->json(['message' => 'Поселення було успішно змінено']);
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
        $this->checkIfUserHasRightsTo('App\Models\Settlement');

        $settlement = Settlement::findOrFail($id);

        if ($settlement->delete()) {
            return response()->json(['message' => 'Поселення було успішно видалено']);
        }
    }
}
