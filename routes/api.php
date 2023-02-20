<?php

use App\Models\Household;
use Illuminate\Http\Request;
use App\Models\HouseholdMember;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\RegionController;
use App\Http\Controllers\API\v1\ReportController;
use App\Http\Controllers\API\v1\CouncilController;
use App\Http\Controllers\API\v1\DistrictController;
use App\Http\Controllers\API\v1\CommunityController;
use App\Http\Controllers\API\v1\HouseholdController;
use App\Http\Controllers\API\v1\WorkPlaceController;
use App\Http\Controllers\API\v1\SettlementController;
use App\Http\Controllers\API\v1\CouncilTypeController;
use App\Http\Controllers\API\v1\LandPlotTypeController;
use App\Http\Controllers\API\v1\MovementTypeController;
use App\Http\Controllers\API\v1\HouseholdLandController;
use App\Http\Controllers\API\v1\HouseholdTypeController;
use App\Http\Controllers\API\v1\HouseholdHouseController;
use App\Http\Controllers\API\v1\HouseholdOwnerController;
use App\Http\Controllers\API\v1\SettlementTypeController;
use App\Http\Controllers\API\v1\AdditionalParamController;
use App\Http\Controllers\API\v1\HouseholdMemberController;
use App\Http\Controllers\API\v1\FamilyRelationshipController;
use App\Http\Controllers\API\v1\HouseholdMemberLandController;
use App\Http\Controllers\API\v1\FamilyRelationshipTypeController;
use App\Http\Controllers\API\v1\AdditionalParamCategoryController;
use App\Http\Controllers\API\v1\HouseholdMemberMovementController;
use App\Http\Controllers\API\v1\AdditionalParamValueTypeController;

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


Route::group(['prefix' => 'v1', 'middleware' => ['auth:sanctum']], function() {
    Route::resource('regions',                      RegionController::class);
    Route::resource('districts',                    DistrictController::class);
    Route::resource('communities',                  CommunityController::class);
    Route::resource('council-types',                CouncilTypeController::class);
    Route::resource('councils',                     CouncilController::class);
    Route::resource('settlement-types',             SettlementTypeController::class);
    Route::resource('settlements',                  SettlementController::class);
    Route::resource('work-places',                  WorkPlaceController::class);
    Route::resource('family-relationship-types',    FamilyRelationshipTypeController::class);
    Route::resource('family-relationships',         FamilyRelationshipController::class);
    Route::resource('household-types',              HouseholdTypeController::class);
    Route::resource('land-plot-types',              LandPlotTypeController::class);
    Route::resource('households',                   HouseholdController::class);
    Route::resource('household-houses',             HouseholdHouseController::class);
    Route::resource('household-members',            HouseholdMemberController::class);
    Route::resource('additional-param-categories',  AdditionalParamCategoryController::class);
    Route::resource('additional-param-value-types', AdditionalParamValueTypeController::class);
    Route::resource('additional-params',            AdditionalParamController::class);
    Route::resource('movement-types',               MovementTypeController::class);
    Route::resource('household-member-movements',   HouseholdMemberMovementController::class);
    Route::resource('household-member-lands',       HouseholdMemberLandController::class);
    Route::resource('household-lands',              HouseholdLandController::class);
    Route::resource('household-owners',             HouseholdOwnerController::class);

    Route::post('add-household-owner',              [HouseholdController::class, 'addOwner'])->name('add-household-owner');
    Route::post('generate-report',                  [ReportController::class, 'generate'])->name('generate-report');
    Route::post('upload-report-template/{id}',      [ReportController::class, 'uploadTemplate'])->name('upload-report-template');
    Route::post('establish-family-relationships',   [FamilyRelationshipController::class, 'establishRelationships'])->name('establish-family-relationships');
    Route::post('family-composition-report',        [ReportController::class, 'familyComposition']);

    Route::post('house-additional-information',     [HouseholdController::class, 'houseInfo']);
    Route::post('land-additional-information',      [HouseholdController::class, 'landInfo']);
    Route::post('member-additional-params',         [HouseholdMemberController::class, 'setAdditionalParams'] );
});
