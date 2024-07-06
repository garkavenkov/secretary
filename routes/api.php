<?php

use App\Models\Household;
use Illuminate\Http\Request;
use App\Models\HouseholdMember;
use App\Models\PermissionRight;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\RoleController;
use App\Http\Controllers\API\v1\UserController;
use App\Http\Controllers\API\v1\RegionController;
use App\Http\Controllers\API\v1\ReportController;
use App\Http\Controllers\API\v1\CouncilController;
use App\Http\Controllers\API\v1\DistrictController;
use App\Http\Controllers\API\v1\PositionController;
use App\Http\Controllers\API\v1\UserRoleController;
use App\Http\Controllers\API\v1\CommunityController;
use App\Http\Controllers\API\v1\HouseholdController;
use App\Http\Controllers\API\v1\WorkPlaceController;
use App\Http\Controllers\API\v1\ExportDataController;
use App\Http\Controllers\API\v1\PermissionController;
use App\Http\Controllers\API\v1\SettlementController;
use App\Http\Controllers\API\v1\CouncilTypeController;
use App\Http\Controllers\API\v1\LandPlotTypeController;
use App\Http\Controllers\API\v1\MovementTypeController;
use App\Http\Controllers\API\v1\HouseholdLandController;
use App\Http\Controllers\API\v1\HouseholdTypeController;
use App\Http\Controllers\API\v1\HouseholdHouseController;
use App\Http\Controllers\API\v1\HouseholdOwnerController;
use App\Http\Controllers\API\v1\ModelAttributeController;
use App\Http\Controllers\API\v1\SettlementTypeController;
use App\Http\Controllers\API\v1\AdditionalParamController;
use App\Http\Controllers\API\v1\HouseholdMemberController;
use App\Http\Controllers\API\v1\PermissionRightController;
use App\Http\Controllers\API\v1\FamilyRelationshipController;
use App\Http\Controllers\API\v1\HouseholdMemberLandController;
use App\Http\Controllers\API\v1\AdditionalParamValueController;
use App\Http\Controllers\API\v1\FamilyRelationshipTypeController;
use App\Http\Controllers\API\v1\AdditionalParamCategoryController;
use App\Http\Controllers\API\v1\HouseholdMemberMovementController;
use App\Http\Controllers\API\v1\AdditionalParamConditionController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['prefix' => 'v1', 'middleware' => ['auth:sanctum']], function () {
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
    Route::resource('roles',                        RoleController::class);
    Route::resource('permissions',                  PermissionController::class);
    Route::resource('positions',                    PositionController::class);
    Route::resource('users',                        UserController::class);
    Route::resource('reports',                      ReportController::class);
    Route::resource('model-attributes',             ModelAttributeController::class);
    Route::resource('additional-param-conditions',  AdditionalParamConditionController::class);

    Route::post('generate-report',                  [ReportController::class, 'generate'])->name('generate-report');
    // Route::post('generate-report',                  [ReportController::class, 'generateReport'])->name('generate-report');
    Route::post('upload-report-template/{id}',      [ReportController::class, 'uploadTemplate'])->name('upload-report-template');
    Route::get('download-report-template/{id}',    [ReportController::class, 'downloadReportTemplate'])->name('download-report-template');
    Route::post('family-composition-report',        [ReportController::class, 'familyComposition']);

    Route::post('establish-family-relationships',   [FamilyRelationshipController::class, 'establishRelationships'])->name('establish-family-relationships');

    Route::post('house-additional-information',     [HouseholdController::class, 'houseInfo']);
    Route::post('land-additional-information',      [HouseholdController::class, 'landInfo']);
    Route::post('member-additional-params',         [HouseholdMemberController::class, 'setAdditionalParams']);

    Route::get('households/{id}/land-years',        [HouseholdController::class, 'landYears'])->name('household-land-years');
    Route::get('households/{id}/house-years',       [HouseholdController::class, 'houseYears'])->name('household-house-years');
    Route::get('households/{id}/family-relations',  [HouseholdController::class, 'familyRelations'])->name('household-family-relations');
    // Route::get('households/{id}/house-info',        [HouseholdController::class, 'houseInfo'])->name('household-house-info');
    // Route::get('households/{id}/members',           [HouseholdController::class, 'members'])->name('household-members');

    Route::get('household-members/{id}/land-years',         [HouseholdMemberController::class, 'landYears'])->name('member-land-years');
    Route::get('household-members/{id}/additional-data',    [HouseholdMemberController::class, 'additionalParams'])->name('member-additional-data');
    Route::get('household-members/{id}/movements',          [HouseholdMemberController::class, 'memberMovements'])->name('member-additional-movements');
    Route::get('household-members/{id}/relatives',          [HouseholdMemberController::class, 'memberRelatives'])->name('member-relatives');
    Route::get('get-age-of-oldest-person',                  [HouseholdMemberController::class, 'getAgeOfOldestPerson'])->name('get-age-of-oldest-person');

    Route::post('set-additional-params',            [AdditionalParamValueController::class, 'setAdditionalParams']);


    Route::post('grant-permissions',                [PermissionRightController::class, 'grantPermissions']);
    Route::get('granted-permissions',               [PermissionRightController::class, 'grantedPermissions']);

    Route::post('users/{user}/upload-photo',        [UserController::class, 'uploadPhoto']);
    Route::post('users/{user}/roles',               [UserController::class, 'userRoles']);

    Route::post('export-data',                      [ExportDataController::class, 'exportData'])->name('export-data');

    // Widgets API calls
    Route::get('households-total-count',                        [HouseholdController::class, 'totalCount'])->name('households-total-count');
    Route::post('households-by-type',                           [HouseholdController::class, 'householdsByType'])->name('households-by-type');
    Route::get('household-members-total-count',                 [HouseholdMemberController::class, 'totalCount'])->name('household-members-total-count');
    Route::get('household-members-birthday-in-month/{month?}',  [HouseholdMemberController::class, 'birthdayPeople'])->name('household-members-birthday-in-month');
    Route::post('household-members-by-age-ranges',              [HouseholdMemberController::class, 'membersByAgeRange'])->name('household-members-by-age-range');

});
