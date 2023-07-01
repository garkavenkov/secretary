<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\HouseholdMember;
use App\Traits\Models\UserRights;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\v1\HouseholdMemberRequest;
use App\Http\Resources\API\v1\HouseholdMember\HouseholdMemberResource;
use App\Http\Resources\API\v1\HouseholdMember\HouseholdMemberResourceCollection;

class HouseholdMemberController extends Controller
{
    use UserRights;

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
            $members = HouseholdMember::with('household')->get();
            // $members = HouseholdMember::get();
            // dd($members);
            return new HouseholdMemberResourceCollection($members);
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
        $member = HouseholdMember::with('household', 'workPlace', 'movements.type', 'land')->findOrFail($id);

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
        $this->checkIfUserHasRightsTo('App\Models\HouseholdMember');

        $member = HouseholdMember::findOrFail($id);

        if ($member->delete()) {
            return response()->json(['message' => 'Член домогосподарства був успішно відален']);
        }
    }

    public function setAdditionalParams(Request $request)
    {
        $permission = Permission::where('code', 'App\Models\HouseholdMember')->first();
        if (!Auth::user()->hasPermission($permission->code, 8)) {
            $error_msg = 'У Вас відсутні права на редагування додаткової інформації члена домогосподарства';
            return response()->json(['message' => $error_msg], 403);
        }

        // dd($request->all());
        if (!isset($request->owner_id)) {
            throw new \Exception('Відсутній ID члена родини');
        }
        $member = HouseholdMember::findOrFail($request->owner_id);
        $request->request->remove('owner_id');

        foreach($request->all() as $param => $value) {
            $param = $member->getAdditionalParam($param);

            if ($param) {
                if ($value) {
                    $member->setAdditionalParamValue($param->id, $value);
                } else {
                    $member->clearAdditionalParam($param->id);
                }
            }
        }
        return response()->json(['message' => 'Додаткова параметри були успішно додані']);
    }
}
