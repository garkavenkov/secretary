<?php

namespace App\Http\Controllers\API\v1;

use DateTime;
use App\Models\Household;
use App\Models\Permission;
use App\Models\Settlement;
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
use App\Models\HouseholdMemberMovement;
use App\Snippets\SqlSnippet;

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
        // dd(request()->all());
        $members = HouseholdMember::sqlBuilder();

        if (request()->query('household_id')) {

            $household_id = request()->query('household_id');            
            
            $members = $members
                            ->where('household_members.household_id', $household_id)
                            ->get();            

            return new HouseholdMemberResourceCollection($members);

        } 
        if (request()->query('where')) {            
            $conditions = explode(';', request()->query('where'));
          
            foreach($conditions as $condition) {                
                
                $parts = explode('=', $condition);

                if (count($parts) == 2) {

                    if ($parts[0] == 'settlement_id') {
                        
                        if (HouseholdMember::isFieldFilterable($parts[0])) {                            
                      
                            $members = $members->where('h.settlement_id', '=', $parts[1]);
                        }

                    } else if ($parts[0] == 'additional_params') {
                       
                        $members->whereRaw(
                            SqlSnippet::filled_additional_params(
                                model:'App\\Models\\HouseholdMember', 
                                owner: 'household_members.id',
                                value_type: 'boolean', 
                                parameters: $parts[1]
                            )
                        );
                    
                    }  else if ($parts[0] == 'age') {                            
                        
                        $ageRange =  array_map('intval', explode(',', $parts[1], 2));                        
                       
                        $members = $members->whereRaw(SqlSnippet::memberFullAgeRange(), $ageRange);                      

                    }  else if ($parts[0] == 'status') {
                        
                        if ($parts[1] == 'alive') {
                            $members = $members->whereNull('household_members.death_date');
                        } else if ($parts[1] == 'dead') {
                            $members = $members->whereNotNull('household_members.death_date');
                        }

                    }  else if ($parts[0] == 'sex') {

                        $members = $members->where('household_members.sex', '=', $parts[1]);

                    }  else {

                        $members = $members->where($parts[0], $parts[1]);

                    }
                }
            }

        } 
        // $date = date('Y-m-d');
        $members = $members
                        // ->where(function($q) use($date) {
                        //     return $q->whereNull('household_members.death_date')
                        //              ->orWhere('household_members.death_date', '>', $date);
                        // })
                        ->paginate($per_page);

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
        // $member = HouseholdMember::with('household', 'workPlace', 'movements.type', 'landYears')->findOrFail($id);
        
        $member = HouseholdMember::sqlBuilder()->findOrFail($id);
        
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

    /*    
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
    */

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
        // dd($member->additionalParams());

        // $additional_params = $member->memberInfo();
        // dd($additional_params);
        return AdditionalParamValueResource::collection($member->memberInfo());
        // return AdditionalParamValueResource::collection($member->additionalParams());
    }

    public function memberMovements($id)
    {
        // $member = HouseholdMember::findOrFail($id);

        $movements = HouseholdMemberMovement::query()
                            ->from('household_member_movements as hmm')
                            ->select(
                                'hmm.id',
                                'hmm.member_id',
                                'hmm.movement_type_id',
                                'hmm.date',
                                'hmm.comment',
                                'mt.name as type_name'
                            )
                            ->join('movement_types as mt', 'mt.id', '=', 'hmm.movement_type_id')
                            ->where('hmm.member_id', $id)
                            ->get();

        // return HouseholdMemberMovementResource::collection($member->movements);
        return HouseholdMemberMovementResource::collection($movements);
    }

    public function memberRelatives($id)
    {
        $member = HouseholdMember::findOrFail($id);
        
        return HouseholdMemberRelativesResource::collection($member->relatives());
    }

    /**
     * Get the oldest living person on date
     * If date isn't set - current date will be used
     *
     * @param Request $request
     * @return integer|null
     */
    public function getAgeOfOldestPerson(Request $request): ?int
    {   
        $date = (new DateTime())->format('Y-m-d');
        if ($request->input('date')) {
            $date = $request->input('date');
        }
        
        $sql = "SELECT ";
        $sql .= HouseholdMember::memberFullAgeSQLSnippet($date);       
        $sql .= "FROM household_members hm WHERE hm.death_date  IS NULL || hm.death_date > DATE('$date') ORDER BY 1 desc LIMIT 1";
        
        $res = DB::select($sql);
        
        if ($res) {
            return $res[0]->full_age;        
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

            $sql = "MONTH(birthdate) = ?";
        }
        
        return HouseholdMember::alive()->whereRaw($sql, $month)->count();
    }

    /**
     * Return array with members count in which age group.     
     * Data will be groupped by settlement and gender on $request->input(date) or current date
     *
     * @param Request $request
     * @return array
     */
    public function membersByAgeRange(Request $request): array
    {   
        if ($request->input('ranges')) {
            $age_ranges = $request->input('ranges');
        } else {
            $age_ranges = [
                '0 - 17' => [0,17],
                '18 - 59' => [18,59],
                '> 60' => [60, 200],
            ];
        }

        $date = $request->input('date') ??  (new DateTime)->format('Y-m-d');

        $by_settlement = false;
        $by_gender = false;
        if ($request->input('groupBy')) {
            $by_settlement = in_array('settlement', $request->input('groupBy')) ? true : false ;
            $by_gender = in_array('gender', $request->input('groupBy')) ? true : false;
        }

        $settlement_id = $request->input('settlement_id') ? $request->input('settlement_id') : null;
        $gender = $request->input('gender') ? $request->input('gender') : null;

        $result = HouseholdMember::groupByAgeRanges(
                    ages: $age_ranges, 
                    settlement_id: $settlement_id, 
                    gender: $gender, 
                    date: $date, 
                    group_by_settlement: $by_settlement, 
                    group_by_gender: $by_gender
                );        
        // dd($result);
        return $result;
    }
}

