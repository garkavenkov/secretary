<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Models\FamilyRelationship;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\FamilyRelationshipRequest;
use App\Http\Resources\API\v1\FamilyRelationship\FamilyRelationshipResource;
use App\Http\Resources\API\v1\FamilyRelationship\FamilyRelationshipResourceCollection;

class FamilyRelationshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\FamilyRelationship\FamilyRelationshipResourceCollection
     */
    public function index()
    {
        $relationships = FamilyRelationship::all();

        return new FamilyRelationshipResourceCollection($relationships);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\FamilyRelationshipRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FamilyRelationshipRequest $request)
    {
        $relationship = FamilyRelationship::create($request->validated());

        if ($relationship) {
            return response()->json(['message' => 'Тип родинних стосунків був успішно додан'], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Resources\API\v1\FamilyRelationship\FamilyRelationshipResource
     */
    public function show($id)
    {
        $relationship = FamilyRelationship::findOrFail($id);

        return new FamilyRelationshipResource($relationship);
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
        $relationship = FamilyRelationship::findOrFail($id);

        $relationship->update($request->all());

        if($relationship->save()) {
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
        $relationship = FamilyRelationship::findOrFail($id);

        if ($relationship->delete()) {
            return response()->json(['message' => 'Тип родинних стосунків був успішно виделен']);
        }
    }
}
