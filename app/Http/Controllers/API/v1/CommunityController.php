<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Community;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\CommunityRequest;
use App\Http\Resources\API\v1\Community\CommunityResource;
use App\Http\Resources\API\v1\Community\CommunityResourceCollection;
use App\Traits\Models\UserRights;

class CommunityController extends Controller
{
    use UserRights;

    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\Community\CommunityResourceCollection
     */
    public function index()
    {
        $communities = Community::with('district')->get();

        return new CommunityResourceCollection($communities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\CommunityRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommunityRequest $request)
    {
        // dd($request->validated(), Community::all());
        $community = Community::create($request->validated());

        if ($community) {
            return response()->json(['message' => 'Громада успішно додана'], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Resources\API\v1\Community\CommunityResource
     */
    public function show($id)
    {
        $community = Community::with('district.region', 'councils')->findOrFail($id);

        return new CommunityResource($community);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param   App\Http\Requests\API\v1\CommunityRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommunityRequest $request, $id)
    {
        $community = Community::findOrFail($id);
        $community->update($request->validated());

        if ($community->save()) {
            return response()->json(['message' => 'Громада була успішно змінена']);
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
        $this->checkIfUserHasRightsTo('App\Models\Community');

        $community = Community::findOrFail($id);

        if ($community->delete()) {
            return response()->json(['message' => 'Громада була успішно видалена']);
        }
    }
}
