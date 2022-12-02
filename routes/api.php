<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\RegionController;
use App\Http\Controllers\API\v1\CouncilController;
use App\Http\Controllers\API\v1\DistrictController;
use App\Http\Controllers\API\v1\CommunityController;
use App\Http\Controllers\API\v1\PlaceWorkController;
use App\Http\Controllers\API\v1\SettlementController;
use App\Http\Controllers\API\v1\CouncilTypeController;
use App\Http\Controllers\API\v1\FamilyRelationshipController;
use App\Http\Controllers\API\v1\HouseholdController;
use App\Http\Controllers\API\v1\LandPlotTypeController;
use App\Http\Controllers\API\v1\SettlementTypeController;
use App\Http\Controllers\API\v1\HouseholdTypeController;

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
    Route::resource('regions',              RegionController::class);
    Route::resource('districts',            DistrictController::class);
    Route::resource('communities',          CommunityController::class);
    Route::resource('council-types',        CouncilTypeController::class);
    Route::resource('councils',             CouncilController::class);
    Route::resource('settlement-types',     SettlementTypeController::class);
    Route::resource('settlements',          SettlementController::class);
    Route::resource('places-work',          PlaceWorkController::class);
    Route::resource('family-relationships', FamilyRelationshipController::class);
    Route::resource('household-types',      HouseholdTypeController::class);
    Route::resource('land-plot-types',      LandPlotTypeController::class);
    Route::resource('households',           HouseholdController::class);
});
