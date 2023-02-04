<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Household;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\HouseholdRequest;
use App\Http\Resources\API\v1\Household\HouseholdResource;
use App\Http\Resources\API\v1\Household\HouseholdResourceCollection;

class HouseholdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\Household\HouseholdResourceCollection
     */
    public function index()
    {
        if (request()->query('search')) {
            $search = '%' . str_replace(' ', '%', request()->query('search')) . '%';
            $households = Household::with('settlement')->where('address', 'like', $search)->take(10)->get();
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
            $households = $households->get();
        } else {
            $households = Household::with('settlement')->get();
        }

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

    public function addOwner(Request $request)
    {
        dd($request->all());
    }
}
