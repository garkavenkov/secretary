<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Models\FamilyRelationshipType;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\FamilyRelationshipTypeRequest;
use App\Http\Resources\API\v1\FamilyRelationshipType\FamilyRelationshipTypeResource;

class FamilyRelationshipTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\FamilyRelationship\FamilyRelationshipTypeResource
     */
    public function index()
    {
        $relationships = FamilyRelationshipType::all();

        return FamilyRelationshipTypeResource::collection($relationships);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\FamilyRelationshipTypeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FamilyRelationshipTypeRequest $request)
    // public function store(Request $request)
    {

        $type = FamilyRelationshipType::create($request->validated());

        if ($type) {
            return response()->json(['message' => 'Тип родинних стосунків був успішно додан'], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Resources\API\v1\FamilyRelationship\FamilyRelationshipTypeResource
     */
    public function show($id)
    {
        $type = FamilyRelationshipType::findOrFail($id);

        return new FamilyRelationshipTypeResource($type);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\API\v1\FamilyRelationshipTypeRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FamilyRelationshipTypeRequest $request, $id)
    {
        $type = FamilyRelationshipType::findOrFail($id);

        $type->update($request->validated());

        if($type->save()) {
            return response()->json(['message' => 'Тип родинних стосунків був успішно змінен']);
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
        $type = FamilyRelationshipType::findOrFail($id);

        if ($type->delete()) {
            return response()->json(['message' => 'Тип родинних стосунків був успішно виделен']);
        }
    }
}
