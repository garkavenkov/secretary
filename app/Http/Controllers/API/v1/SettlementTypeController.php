<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Models\SettlementType;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\SettlementTypeRequest;
use App\Http\Resources\API\v1\SettlementType\SettlementTypeResource;
use App\Http\Resources\API\v1\SettlementType\SettlementTypeResourceCollection;

class SettlementTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\SettlementType\SettlementTypeResourceCollection
     */
    public function index()
    {
        $types = SettlementType::all();

        return new SettlementTypeResourceCollection($types);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\SettlementTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettlementTypeRequest $request)
    {
        $type = SettlementType::create($request->validated());

        if ($type) {
            return response()->json(['message' => 'Тип поселення був успішно додан'], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Resources\API\v1\SettlementType\SettlementTypeResource
     */
    public function show($id)
    {
        $type = SettlementType::findOrFail($id);

        return new SettlementTypeResource($type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\API\v1\SettlementTypeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettlementTypeRequest $request, $id)
    {
        $type = SettlementType::findOrFail($id);

        $type->update($request->validated());

        if ($type->save()) {
            return response()->json(['message' => 'Тип поселення був успішно відредагован']);
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
        $type = SettlementType::findOrFail($id);

        if ($type->delete()) {
            return response()->json(['message' => 'Тип поселення був успішно видален']);
        }
    }
}
