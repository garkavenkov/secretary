<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Models\FamilyRelationship;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\FamilyRelationshipRequest;
use App\Http\Resources\API\v1\FamilyRelationship\FamilyRelationshipResource;
use App\Traits\Models\UserRights;
use Exception;

class FamilyRelationshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\FamilyRelationship\FamilyRelationshipResource
     */
    public function index()
    {
        $relationships = FamilyRelationship::all();

        return FamilyRelationshipResource::collection($relationships);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FamilyRelationshipRequest $request)
    {
        $rel = FamilyRelationship::create($request->validated());

        if ($rel) {
            return response()->json(['message' => 'Родинний зв\'язок був успішно доданий'], 201);
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
    public function update(FamilyRelationshipRequest $request, $id)
    {
        $relationship = FamilyRelationship::findOrFail($id);

        $relationship->update($request->validated());

        if ($relationship->save()) {
            return response()->json(['message' => 'Родинний зв\'язок був успішно змімений']);
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
            return response()->json(['message' => 'Родинний зв\'язок був успішно видалений']);
        }
    }

    public function establishRelationships(Request $request)
    {
        $count = 0;
        $pairs = $request->all();
        foreach($pairs as $pair => $type) {

            $members = explode('.', $pair);
            // Check if all members in pair were sent
            if (count($members) !== 2) {
                throw new Exception('Invalid members count in pair');
            }
            $link = FamilyRelationship::updateOrInsert(
                        ['member_id' => $members[0], 'relative_id' => $members[1], 'relationship_type_id' => $type],
                        ['relationship_type_id' => $type]
                    );
            if ($link) {
                $count++;
            }
        }
        if ($count > 0) {
            return response()->json(['message' => "$count зв'язків було успішно встановлено"]);
        }
    }
}
