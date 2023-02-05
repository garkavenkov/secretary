<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Models\HouseholdMember;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\HouseholdMemberRequest;
use App\Http\Resources\API\v1\HouseholdMember\HouseholdMemberResource;

class HouseholdMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->query('household_id')) {
            $household_id = request()->query('household_id');
            $members = HouseholdMember::with('familyRelationshipType','workPlace','movements')->where('household_id', $household_id)->get();
        } else {
            $members = HouseholdMember::all();
        }

        return HouseholdMemberResource::collection($members);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\HouseholdMemberRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HouseholdMemberRequest $request)
    {
        $member = HouseholdMember::create($request->validated());

        if ($member) {
            return response()->json(['message' => 'Член домогосподарства був успішно додан'], 201);
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
        $member = HouseholdMember::with('movements.type')->findOrFail($id);

        return new HouseholdMemberResource($member);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\API\v1\HouseholdMemberRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HouseholdMemberRequest $request, $id)
    {
        $member = HouseholdMember::findOrFail($id);

        $member->update($request->validated());

        if ($member->save()) {
            return response()->json(['message' => 'Інформація була успішно змінена']);
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
        $member = HouseholdMember::findOrFail($id);

        if ($member->delete()) {
            return response()->json(['message' => 'Член домогосподарства був успішно відален']);
        }
    }
}
