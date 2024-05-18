<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\AdditionalParam;
use App\Models\HouseholdMember;
use App\Traits\Models\UserRights;
use Illuminate\Support\Facades\DB;
use App\Models\HouseholdMemberLand;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\AdditionalParamCategory;
use App\Models\AdditionalParamValueType;
use App\Http\Requests\API\v1\HouseholdMemberRequest;
use App\Http\Resources\API\v1\HouseholdMember\HouseholdMemberResource;
use App\Http\Resources\API\v1\HouseholdMemberLand\HouseholdMemberLandResource;
use App\Http\Resources\API\v1\HouseholdMember\HouseholdMemberRelativesResource;
use App\Http\Resources\API\v1\AdditionalParamValue\AdditionalParamValueResource;
use App\Http\Resources\API\v1\HouseholdMember\HouseholdMemberResourceCollection;
use App\Http\Resources\API\v1\HouseholdMemberMovement\HouseholdMemberMovementResource;
use App\Models\Household;

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
            $per_page = 10;
        }

        if (request()->query('household_id')) {

            $household_id = request()->query('household_id');
            $members = HouseholdMember::with('familyRelationshipType','workPlace','movements')
                        ->where('household_id', $household_id)
                        ->get();
            // return new HouseholdMemberResourceCollection($members);
            return HouseholdMemberResource::collection($members);

        } else if (request()->query('where')) {            
            $conditions = explode(';', request()->query('where'));
            // dd($conditions);
            $members = HouseholdMember::with('household')->alive();//->first();
            // dd($members->fullAge);
            foreach($conditions as $condition) {                
                
                $parts = explode('=', $condition);

                if (count($parts) == 2) {
                    if ($parts[0] == 'settlement_id') {
                        if (HouseholdMember::isFieldFilterable($parts[0])) {                            
                            $members = $members->whereHas('household', function($q) use($parts){
                                return $q->where($parts[0], $parts[1]);
                            });
                        }
                    } else if ($parts[0] == 'additional_params') {
                        $params = explode(',', $parts[1]);                        
                        $members = $members->whereHas('additionalParamsFilled.param', function($q) use($params) {
                            return $q->whereIn('code', $params);
                        });
                    
                    }  else if ($parts[0] == 'age') {                      
                        $ageRange =  array_map('intval', explode(',', $parts[1], 2));
                        
                        $db_conn = config('database.default');
                        if ($db_conn == 'sqlite') {

                            $sql = "strftime('%Y', DATE('now')) - strftime('%Y', birthdate) + 			
                                    case 
                                        when(strftime('%m', DATE('now')) - strftime('%m', birthdate) ) < 0  then -1
                                        when (strftime('%m', DATE('now')) - strftime('%m', birthdate) ) = 0 then 
                                            case 
                                                when (strftime('%d', DATE('now')) - strftime('%d', birthdate) ) < 0 then -1
                                                else 0
                                            end
                                        else 0
                                    end  between ? and  ?";

                        } else if ($db_conn == 'mysql') {

                            $sql = "YEAR(CURDATE()) - YEAR (birthdate) +
                                    case 
                                        when ( MONTH(CURDATE()) - MONTH(birthdate) ) < 0 then -1
                                        when ( MONTH(CURDATE()) - MONTH(birthdate) ) = 0 then
                                            case
                                                when ( DAY(CURDATE()) - DAY(birthdate) ) < 0 then -1
                                                else 0
                                            end
                                        else 0			
                                    end	between ? and ?";
                        }

                        $members = $members->whereRaw($sql, $ageRange);
                        // $members = $members->where(function($q) use($ageRange, $sql) {
                        //     $q->whereNull('death_date')
                        //         ->whereRaw($sql, $ageRange);                            
                        // }); 
                        
                        // dd($members->paginate(10));

                    }  else {
                        $members = $members->where($parts[0], $parts[1]);
                    }
                }
            }

            $members = $members->paginate($per_page);
            

        } else {

            $members = HouseholdMember::with('household')->alive()->paginate($per_page);

        }

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
        $member = HouseholdMember::with('household', 'workPlace', 'movements.type', 'landYears')->findOrFail($id);

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
        return HouseholdMemberLandResource::collection($member->landYears()->paginate($per_page)->withQueryString());
        // return new HouseholdMemberLandResource($member->land(5)->get());
    }

    public function additionalParams($id)
    {
        $member = HouseholdMember::findOrFail($id);

        return AdditionalParamValueResource::collection($member->memberInfo());
    }

    public function memberMovements($id)
    {
        $member = HouseholdMember::findOrFail($id);

        return HouseholdMemberMovementResource::collection($member->movements);
    }

    public function memberRelatives($id)
    {
        $member = HouseholdMember::findOrFail($id);

        return new HouseholdMemberRelativesResource($member);
    }

    public function getAgeOfOldestPerson(Request $request)
    {
        // $per_page = $request->query('per_page');
        $member = HouseholdMember::alive()->get()->sortBy([['fullAge', 'desc']])->first();

        if ($member) {
            return $member->fullAge;
        }
        return null;
    }

    public function totalCount(): int
    {
        return HouseholdMember::alive()->count();
    }

    public function birthdayPeople(int $month = null): int
    {
        $month ??= (Carbon::now())->month;
                
        $db_conn = config('database.default');
        $sql = '';
        if ($db_conn == 'sqlite') {

            $sql = "cast(strftime('%m', birthdate) as integer) = ?";

        } else if ($db_conn == 'mysql') {

            $sql = "MONTH(birthdate) ?";
        }
        
        return HouseholdMember::alive()->whereRaw($sql, $month)->count();
    }
}
