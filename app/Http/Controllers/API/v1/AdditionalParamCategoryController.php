<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdditionalParamCategory;
use App\Http\Requests\API\v1\AdditionalParamCategoryRequest;
use App\Http\Resources\API\v1\AdditionalParamCategory\AdditionalParamCategoryResource;

class AdditionalParamCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return App\Http\Resources\API\v1\AdditionalParamCategory\AdditionalParamCategoryResource
     */
    public function index()
    {
        $categories = AdditionalParamCategory::all();

        return AdditionalParamCategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\API\v1\AdditionalParamCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdditionalParamCategoryRequest $request)
    {
        $category = AdditionalParamCategory::create($request->validated());

        if ($category) {
            return  response()->json(['message' => 'Категорія додаткович параметрів успішно додана'], 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return App\Http\Resources\API\v1\AdditionalParamCategory\AdditionalParamCategoryResource
     */
    public function show($id)
    {
        $category = AdditionalParamCategory::findOrFail($id);

        return new AdditionalParamCategoryResource($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\API\v1\AdditionalParamCategoryRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdditionalParamCategoryRequest $request, $id)
    {
        $category = AdditionalParamCategory::findOrFail($id);

        $category->update($request->validated());

        if ($category->save()) {
            return response()->json(['message' => 'Категорі додаткових параметрів була успішно змінена']);
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
        $category = AdditionalParamCategory::findOrFail($id);

        if ($category->delete()) {
            return response()->json(['message' => 'Категорія додаткових параметрів була успішно видалена']);
        }
    }
}
