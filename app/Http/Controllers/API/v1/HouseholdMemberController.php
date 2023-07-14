<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\HouseholdMember;
use App\Traits\Models\UserRights;
use App\Models\HouseholdMemberLand;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\v1\HouseholdMemberRequest;
use App\Http\Resources\API\v1\HouseholdMember\HouseholdMemberResource;
use App\Http\Resources\API\v1\HouseholdMemberLand\HouseholdMemberLandResource;
use App\Http\Resources\API\v1\AdditionalParamValue\AdditionalParamValueResource;
use App\Http\Resources\API\v1\HouseholdMember\HouseholdMemberResourceCollection;
use App\Http\Resources\API\v1\HouseholdMemberMovement\HouseholdMemberMovementResource;

use function PHPUnit\Framework\isNan;
use function PHPUnit\Framework\isNull;

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
        if (request()->query('per_page')) {
            $per_page = request()->query('per_page');
        } else {
            $per_page = 3;
        }
        if (request()->query('household_id')) {
            $household_id = request()->query('household_id');
            $members = HouseholdMember::with('familyRelationshipType','workPlace','movements')->where('household_id', $household_id)->get();
        } else if (request()->query('where')) {
            $conditions = explode(';', request()->query('where'));
            $members = HouseholdMember::with('household')->first();
            foreach($conditions as $condition) {
                $parts = explode('=', $condition);
                if (count($parts) == 2) {
                    if ($parts[0] == 'settlement_id') {
                        if (HouseholdMember::isFieldFilterable($parts[0])) {
                            $members = $members->whereHas('household', function($q) use($parts){
                                return $q->where($parts[0], $parts[1]);
                            });
                        }
                    } else {
                        $members = $members->where($parts[0], $parts[1]);
                    }
                }
            }
            $members = $members->paginate($per_page);
            // return new HouseholdMemberResourceCollection($members);
        } else {
            $members = HouseholdMember::with('household')->paginate($per_page);
            // return new HouseholdMemberResourceCollection($members);
        }

        // return HouseholdMemberResource::collection($members);
        return new HouseholdMemberResourceCollection($members->withQueryString());
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

    public function landYears(Request $request, $id)
    {
        $per_page = $request->query('per_page');
        // dd($per_page);
        if (is_null($per_page)) {
            $per_page = 5;
        }
        // dd($per_page);
        $member = HouseholdMember::findOrFail($id);
        return HouseholdMemberLandResource::collection($member->land()->paginate($per_page)->withQueryString());
        // return new HouseholdMemberLandResource($member->land(5)->get());
    }

    public function additionalParams($id)
    {
        $member = HouseholdMember::findOrFail($id);

        return AdditionalParamValueResource::collection($member->memberInfo());
    }

    public function movements($id)
    {
        $member = HouseholdMember::findOrFail($id);

        return HouseholdMemberMovementResource::collection($member->movements);
    }
}
