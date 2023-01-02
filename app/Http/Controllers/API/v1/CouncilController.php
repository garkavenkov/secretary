<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Council;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\v1\CouncilRequest;
use App\Http\Resources\API\v1\Council\CouncilResource;
use App\Http\Resources\API\v1\Council\CouncilResourceCollection;

class CouncilController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\Council\CouncilResourceCollection
     */
    public function index()
    {
        $councils = Council::with('community')->get();

        return new CouncilResourceCollection($councils);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\CouncilRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CouncilRequest $request)
    {
        $council = Council::create($request->validated());

        if ($council) {
            return response()->json(['message' => 'Рада була успішно додана'], 201);
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
        $council = Council::with('community', 'settlements')->findOrFail($id);

        return new CouncilResource($council);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\API\v1\CouncilRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CouncilRequest $request, $id)
    {
        $council = Council::findOrFail($id);

        $council->update($request->all());

        if ($council->save()) {
            return response()->json(['message' => 'Рада була успішно відредагована']);
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
        $council = Council::findOrFail($id);

        if ($council->delete()) {
            return response()->json(['message' => 'Рада була успішно видалена']);
        }
    }
}
