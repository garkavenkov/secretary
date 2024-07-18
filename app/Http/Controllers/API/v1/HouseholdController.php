<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Household;
use App\Models\Permission;
use App\Snippets\SqlSnippet;
use Illuminate\Http\Request;
use App\Models\HouseholdMember;
use App\Traits\Models\UserRights;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\v1\HouseholdRequest;
use App\Http\Resources\API\v1\AdditionalParamValue\AdditionalParamValueResource;
use App\Http\Resources\API\v1\Household\HouseholdResource;
use App\Http\Resources\API\v1\HouseholdLand\HouseholdLandResource;
use App\Http\Resources\API\v1\Household\HouseholdResourceCollection;
use App\Http\Resources\API\v1\HouseholdHouse\HouseholdHouseResource;
use App\Http\Resources\API\v1\Household\HouseholdFamilyRelationsResource;

class HouseholdController extends Controller
{
    use UserRights;

    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\Household\HouseholdResourceCollection
     */
    public function index()
    {
        if (request()->query('per_page')) {
            $per_page = request()->query('per_page');
        } else {
            $per_page = 3;
        }

        if (request()->query('search')) {
            $search = '%' . str_replace(' ', '%', request()->query('search')) . '%';

            $households = DB::table('households as h')
                                ->select(
                                    'h.id',
                                    'h.address',
                                    's.name as settlement',
                                    'st.name as settlement_type'
                                )
                                ->join('settlements as s', 's.id', '=', 'h.settlement_id')
                                ->join('settlement_types as st', 'st.id', '=', 's.settlement_type_id')
                                ->where('h.address', 'like', $search)
                                ->limit(10)
                                ->get()
                                ->toArray();

            $result = array_map(function($h) {
                                $household['id'] = $h->id;
                                $address_parts = explode(',', $h->address);
                                $household['address'] = mb_substr
                                        (mb_strtolower($h->settlement_type), 0,1) . '. ' .
                                        $h->settlement . ', ' .                                         // settlement
                                        $address_parts[0] . ' ' . $address_parts[1] .                   // street
                                        ', буд. ' . $address_parts[2] .                                 // house
                                        ($address_parts[3] !== '' ? ", корп. $address_parts[3]" : '') . // corps
                                        ($address_parts[4] !== '' ? ", кв. $address_parts[4]" : '');    // apartment
                                return $household;
                            }, $households);

            // Try search by member
            if (count($households) == 0) {
                $name_parts = explode(' ', request()->query('search'));
                $conditions = array();
                $fields = ['hm.surname', 'hm.name', 'hm.patronymic'];
                foreach($name_parts as $index => $part) {
                    $conditions[] = [$fields[$index], 'like', '%' . $part . '%'];
                }
                $members = DB::table('household_members as hm')
                            ->select(
                                'h.id',
                                'hm.id as member_id',
                                'hm.surname',
                                'hm.name',
                                'hm.patronymic',
                                'h.address',
                                's.name as settlement'
                            )
                            ->join('households as h', 'h.id', '=', 'hm.household_id')
                            ->join('settlements as s', 's.id', '=', 'h.settlement_id')
                            ->where($conditions)
                            ->limit(10)
                            ->get()
                            ->toArray();

                $result =   array_map(function($m) {
                                    $member['id'] = $m->id;
                                    $member['member_id'] = $m->member_id;
                                    $member['member_full_name'] = $m->surname . ' ' . $m->name . ' ' . $m->patronymic;
                                    $address_parts = explode(',', $m->address);
                                    $member['address'] =    $m->settlement . ', ' . // settlement
                                                            $address_parts[0] . ' ' . $address_parts[1] . // street
                                                            ', буд. ' . $address_parts[2] . // house
                                                            ($address_parts[3] !== '' ? ", корп. $address_parts[3]" : '') . // corps
                                                            ($address_parts[4] !== '' ? ", кв. $address_parts[4]" : ''); // apartment
                                    return $member;
                            }, $members);

                // return response()->json(['data' => $members]);
            }

            return response()->json(['data' => $result]);

        } else  {    

            $households = Household::sqlBuilder();

            if (request()->query('where')) {

                $conditions = explode(';', request()->query('where'));
                // $households = Household::with('settlement');
                
                foreach($conditions as $condition) {
                    $parts = explode('=', $condition);                
                    if (count($parts) == 2) {
                        if (Household::isFieldFilterable($parts[0])) {
                            if ($parts[0] == 'address') {
                                // check weather address contains street with number 
                                $address = explode(' ', $parts[1]);
                                if (count($address) > 1) {
                                    $address = implode("%", $address);
                                } else {
                                    $address = $parts[1];
                                }                                     
                                $households = $households->where($parts[0], 'like', '%'. $address. '%');
                            } else {
                                $households = $households->where($parts[0], $parts[1]);
                            }
                        } else if ($parts[0] == 'additional_params') {                           
                            $households->whereRaw(
                                SqlSnippet::filled_additional_params(
                                    model:'App\\Models\\Household', 
                                    owner: 'households.id',
                                    value_type: 'boolean', 
                                    parameters: $parts[1]
                                )
                            );
                        }
                    }
                }            
            }
                            
        }


        $households = $households->orderBy('number')->paginate($per_page);
       
        return new HouseholdResourceCollection($households->withQueryString());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\HouseholdRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HouseholdRequest $request)
    {
        // dd($request->validated());
        $household = Household::create($request->validated());

        if ($household) {
            return response()->json(['message' => 'Облікова картка успішно додана'], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Resources\API\v1\Household\HouseholdResource
     */
    public function show($id)
    {
        $household = Household::sqlBuilder()
                        ->join('settlement_types as st', 'st.id', '=', 's.settlement_type_id')
                        ->join('councils as c', 'c.id', '=', 's.council_id')
                        ->join('communities as com', 'com.id', '=', 'c.community_id')
                        ->join('districts as d', 'd.id', '=', 'com.district_id')
                        ->join('regions as r', 'r.id', '=', 'd.region_id')
                        ->join('household_types as ht', 'households.household_type_id', '=', 'ht.id')
                        ->addSelect(
                            'ht.name as household_type',
                            'st.name as settlement_type',
                            'd.name as district',
                            'r.name as region',
                        )                        
                        ->addSelect(SqlSnippet::household_head())
                        ->with('owners')
                        ->findOrFail($id);          

       
        return new HouseholdResource($household);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HouseholdRequest $request, $id)
    {
        $household = Household::findOrFail($id);

        $household->update($request->validated());

        if ($household->save()) {
            return response()->json(['message' => 'Облікова картка була успішно змінена']);
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
        $this->checkIfUserHasRightsTo('App\Models\Household');

        $household = Household::findOrFail($id);

        $msg = '';
        if ($household->members->count() > 0) {
            $members_count =  $household->members->count();
            $msg =  'В картці ' . ($members_count > 1 ? ' присутні ' : ' присутній ')
                    . trans_choice('plural.member', $members_count, ['value' => $members_count])
                    . ' домогосподарства.<br>';
        }
        if ($household->houseYears->count() > 0) {
            $house_years_count = $household->houseYears->count();
            $msg =  $msg
                    . 'В картці присутня інформація по будинку за '
                    . trans_choice('plural.years', $house_years_count, ['value' => $house_years_count]) . '<br>';
        }
        if ($household->landYears->count() > 0) {
            $land_years_count = $household->landYears->count();
            $msg =  $msg
                    . 'В картці присутня інформація по землі за '
                    . trans_choice('plural.years', $land_years_count, ['value' => $land_years_count]) . '<br>';
        }
        if ($msg !== '') {
            $msg = $msg . '<br>Видаліть цю інформацию і спробуйте знову.';
            return response()->json(['message' => $msg], 500);
        }

        if ($household->delete()) {
            return response()->json(['message' => 'Облікова картка була успішно видалена']);
        }
    }

   
    public function houseInfo($id)
    {
        $household = Household::findOrFail($id);

        $info = $household->houseInfo();

        return response()->json($info);
    }

    public function landYears(Request $request, $id)
    {
        $per_page = $request->query('per_page');
        if (is_null($per_page)) {
            $per_page = 5;
        }
        $household = Household::findOrFail($id);
        return HouseholdLandResource::collection($household->landYears()->paginate($per_page)->withQueryString());

    }

    public function houseYears(Request $request, $id)
    {
        $per_page = $request->query('per_page');
        if (is_null($per_page)) {
            $per_page = 5;
        }
        $household = Household::findOrFail($id);
        return HouseholdHouseResource::collection($household->houseYears()->paginate($per_page)->withQueryString());

    }

  
    public function landInfo($id)
    {
        $household = Household::findOrFail($id);

        $info = $household->landInfo();

        return response()->json($info);
    }


    /*
    public function setAdditionalParams(Request $request)
    {
        $permission = Permission::where('code', 'App\Models\Household')->first();
        if (!Auth::user()->hasPermission($permission->code, 8)) {
            $error_msg = 'У Вас відсутні права на редагування додаткової інформації домогосподарства';
            return response()->json(['message' => $error_msg], 403);
        }

        if (!isset($request->owner_id)) {
            throw new \Exception('Відсутній ID домогосподарства');
        }
        $household = Household::findOrFail($request->owner_id);
        $request->request->remove('owner_id');

        foreach($request->all() as $param => $value) {
            $param = $household->getAdditionalParam($param);

            if ($param) {
                if ($value) {
                    $household->setAdditionalParamValue($param->id, $value);
                } else {
                    $household->clearAdditionalParam($param->id);
                }
            }
        }
        return response()->json(['message' => 'Додаткова параметри були успішно додані']);
    }*/

    public function familyRelations($id)
    {
        $household = Household::findOrFail($id);

        $members = HouseholdMember::where('household_id', $household->id)->get();

        foreach($members as $member) {
                $member['relatives'] = $member->relatives();
        }

        return HouseholdFamilyRelationsResource::collection($members);
    }


    public function familyInfo($id)
    {
        $household = Household::findOrFail($id);

        // $params = $household->familyInfo();
        
        return AdditionalParamValueResource::collection($household->familyInfo());
    }

    public function totalCount(): int 
    {
        return Household::count();
    }

    
    public function householdsByType(Request $request)
    {
        
        $result = [];

        $by_settlement = false;

        if ($request->input('groupBy')) {
            $by_settlement = in_array('settlement', $request->input('groupBy')) ? true : false ;            
        }

        $settlement_id = $request->input('settlement_id') ? $request->input('settlement_id') : null;

        $result = Household::groupByType(settlement_id: $settlement_id, group_by_settlement: $by_settlement);

        return $result;

    }
}
