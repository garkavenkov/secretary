<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Household;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Models\HouseholdMember;
use App\Traits\Models\UserRights;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\API\v1\HouseholdRequest;
use App\Http\Resources\API\v1\Household\HouseholdResource;
use App\Http\Resources\API\v1\Household\HouseholdResourceCollection;

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
        if (request()->query('search')) {
            $search = '%' . str_replace(' ', '%', request()->query('search')) . '%';
            // $households = Household::with('settlement')
            //                     ->where('address', 'like', $search)
            //                     ->take(10);
                                // ->get();
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
                                ->get()
                                ->toArray();

            $result = array_map(function($h) {
                                $household['id'] = $h->id;
                                $address_parts = explode(',', $h->address);
                                $household['address'] = mb_substr(mb_strtolower($h->settlement_type), 0,1) . '. ' .
                                                        $h->settlement . ', ' . // settlement
                                                        $address_parts[0] . ' ' . $address_parts[1] . // street
                                                        ', буд. ' . $address_parts[2] . // house
                                                        ($address_parts[3] !== '' ? ", корп. $address_parts[3]" : '') . // corps
                                                        ($address_parts[4] !== '' ? ", кв. $address_parts[4]" : ''); // apartment
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
        }  else if (request()->query('where')) {
            $conditions = explode(';', request()->query('where'));
            $households = Household::with('settlement');
            foreach($conditions as $condition) {
                $parts = explode('=', $condition);
                if (count($parts) == 2) {
                    if (Household::isFieldFilterable($parts[0])) {
                        $households = $households->where($parts[0], $parts[1]);
                    }
                }
            }
            // $households = $households->get();
        } else {
            $households = Household::with('settlement');//->get();
        }
        $households = $households->orderBy('number')->get();

        return new HouseholdResourceCollection($households);
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
        $household = Household::with('settlement',
                            'type',
                            'members.familyRelationshipType',
                            'members.workPlace',
                            'members.movements',
                            'houseYears',
                            'landYears',
                            'owners'
                        )
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

    public function houseInfo(Request $request)
    {
        $permission = Permission::where('code', 'App\Models\Household')->first();
        if (!Auth::user()->hasPermission($permission->code, 8)) {
            $error_msg = 'У Вас відсутні права на редагування інформації по будинку';
            return response()->json(['message' => $error_msg], 403);
        }

        if (!isset($request->household_id)) {
            throw new \Exception('Відсутній ID домогосподарства');
        }
        $household = Household::findOrFail($request->household_id);
        $request->request->remove('household_id');

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
        return response()->json(['message' => 'Інформация по будинку була успішно додана']);
    }

    public function landInfo(Request $request)
    {
        $permission = Permission::where('code', 'App\Models\Household')->first();
        if (!Auth::user()->hasPermission($permission->code, 8)) {
            $error_msg = 'У Вас відсутні права на редагування інформації по землі';
            return response()->json(['message' => $error_msg], 403);
        }

        if (!isset($request->household_id)) {
            throw new \Exception('Відсутній ID домогосподарства');
        }
        $household = Household::findOrFail($request->household_id);
        $request->request->remove('household_id');

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
        return response()->json(['message' => 'Інформация по землі була успішно додана']);
    }

    public function setAdditionalParams(Request $request)
    {
        $permission = Permission::where('code', 'App\Models\Household')->first();
        if (!Auth::user()->hasPermission($permission->code, 8)) {
            $error_msg = 'У Вас відсутні права на редагування додаткової інформації домогосподарства';
            return response()->json(['message' => $error_msg], 403);
        }

        // dd($request->all());
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
    }
}
