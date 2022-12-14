<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\RegionController;
use App\Http\Controllers\API\v1\CouncilController;
use App\Http\Controllers\API\v1\DistrictController;
use App\Http\Controllers\API\v1\CommunityController;
use App\Http\Controllers\API\v1\HouseholdController;
use App\Http\Controllers\API\v1\WorkPlaceController;
use App\Http\Controllers\API\v1\SettlementController;
use App\Http\Controllers\API\v1\CouncilTypeController;
use App\Http\Controllers\API\v1\LandPlotTypeController;
use App\Http\Controllers\API\v1\HouseholdTypeController;
use App\Http\Controllers\API\v1\HouseholdHouseController;
use App\Http\Controllers\API\v1\SettlementTypeController;
use App\Http\Controllers\API\v1\AdditionalParamController;
use App\Http\Controllers\API\v1\HouseholdMemberController;
use App\Http\Controllers\API\v1\FamilyRelationshipController;
use App\Http\Controllers\API\v1\AdditionalParamCategoryController;
use App\Models\Household;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'v1'], function() {
    Route::resource('regions',                      RegionController::class);
    Route::resource('districts',                    DistrictController::class);
    Route::resource('communities',                  CommunityController::class);
    Route::resource('council-types',                CouncilTypeController::class);
    Route::resource('councils',                     CouncilController::class);
    Route::resource('settlement-types',             SettlementTypeController::class);
    Route::resource('settlements',                  SettlementController::class);
    Route::resource('work-places',                  WorkPlaceController::class);
    Route::resource('family-relationships',         FamilyRelationshipController::class);
    Route::resource('household-types',              HouseholdTypeController::class);
    Route::resource('land-plot-types',              LandPlotTypeController::class);
    Route::resource('households',                   HouseholdController::class);
    Route::resource('household-houses',             HouseholdHouseController::class);
    Route::resource('household-members',            HouseholdMemberController::class);
    Route::resource('additional-param-categories',  AdditionalParamCategoryController::class);
    Route::resource('additional-params',            AdditionalParamController::class);

    Route::post('add-household-owner',              [HouseholdController::class, 'addOwner'])->name('add-household-owner');
    // Route::resource('additional-param-values)
});
