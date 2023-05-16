<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use App\Models\PermissionRight;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionRightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PermissionRight::truncate();


        // AdditionalParamvalueType -
        // CouncilType              -
        // FamilyRelationship       ?


        // LandPlotType             -
        // MovementType             ?
        // PermissionRight          ?
        // Position                 -?
        // Report                   ?

        // User                     c?
        // UserRole                 ?

        // $dictionaries->grantPermission(Permission::where('code', 'App\Models\LandPlotType')->firstOrFail(), 15);

        $administrator = Role::where('code', 'administrator')->firstOrFail();

        $administrator->grantPermission(Permission::where('code', 'App\Models\Permission')->firstOrFail(), 15);
        $administrator->grantPermission(Permission::where('code', 'App\Models\Role')->firstOrFail(), 15);
        $administrator->grantPermission(Permission::where('code', 'App\Models\User')->firstOrFail(), 15);
        $administrator->grantPermission(Permission::where('code', 'App\Models\AdditionalParamCategory')->firstOrFail(), 15);
        $administrator->grantPermission(Permission::where('code', 'App\Models\AdditionalParam')->firstOrFail(), 15);
        $administrator->grantPermission(Permission::where('code', 'App\Models\Community')->firstOrFail(), 15);
        $administrator->grantPermission(Permission::where('code', 'App\Models\Council')->firstOrFail(), 15);
        $administrator->grantPermission(Permission::where('code', 'App\Models\District')->firstOrFail(), 15);
        $administrator->grantPermission(Permission::where('code', 'App\Models\Region')->firstOrFail(), 15);
        $administrator->grantPermission(Permission::where('code', 'App\Models\Settlement')->firstOrFail(), 15);
        $administrator->grantPermission(Permission::where('code', 'App\Models\SettlementType')->firstOrFail(), 15);
        $administrator->grantPermission(Permission::where('code', 'App\Models\WorkPlace')->firstOrFail(), 15);
        $administrator->grantPermission(Permission::where('code', 'App\Models\FamilyRelationshipType')->firstOrFail(), 15);


        $system_dictionaries = Role::where('code', 'system_dictionaries')->firstOrFail();

        $system_dictionaries->grantPermission(Permission::where('code', 'App\Models\AdditionalParamCategory')->firstOrFail(), 15);
        $system_dictionaries->grantPermission(Permission::where('code', 'App\Models\AdditionalParam')->firstOrFail(), 15);
        $system_dictionaries->grantPermission(Permission::where('code', 'App\Models\Community')->firstOrFail(), 15);
        $system_dictionaries->grantPermission(Permission::where('code', 'App\Models\Council')->firstOrFail(), 15);
        $system_dictionaries->grantPermission(Permission::where('code', 'App\Models\District')->firstOrFail(), 15);
        $system_dictionaries->grantPermission(Permission::where('code', 'App\Models\Region')->firstOrFail(), 15);
        $system_dictionaries->grantPermission(Permission::where('code', 'App\Models\Settlement')->firstOrFail(), 15);
        $system_dictionaries->grantPermission(Permission::where('code', 'App\Models\SettlementType')->firstOrFail(), 15);
        $system_dictionaries->grantPermission(Permission::where('code', 'App\Models\WorkPlace')->firstOrFail(), 15);
        $system_dictionaries->grantPermission(Permission::where('code', 'App\Models\FamilyRelationshipType')->firstOrFail(), 15);


        $dictionaries = Role::where('code', 'dictionaries')->firstOrFail();

        $dictionaries->grantPermission(Permission::where('code', 'App\Models\HouseholdType')->firstOrFail(), 4);
        $dictionaries->grantPermission(Permission::where('code', 'App\Models\AdditionalParamCategory')->firstOrFail(), 4);
        $dictionaries->grantPermission(Permission::where('code', 'App\Models\AdditionalParam')->firstOrFail(), 4);
        $dictionaries->grantPermission(Permission::where('code', 'App\Models\Community')->firstOrFail(), 4);
        $dictionaries->grantPermission(Permission::where('code', 'App\Models\Council')->firstOrFail(), 4);
        $dictionaries->grantPermission(Permission::where('code', 'App\Models\District')->firstOrFail(), 4);
        $dictionaries->grantPermission(Permission::where('code', 'App\Models\Region')->firstOrFail(), 4);
        $dictionaries->grantPermission(Permission::where('code', 'App\Models\Settlement')->firstOrFail(), 4);
        $dictionaries->grantPermission(Permission::where('code', 'App\Models\SettlementType')->firstOrFail(), 4);
        $dictionaries->grantPermission(Permission::where('code', 'App\Models\WorkPlace')->firstOrFail(), 4);
        $dictionaries->grantPermission(Permission::where('code', 'App\Models\FamilyRelationshipType')->firstOrFail(), 4);


        $households = Role::where('code', 'households')->firstOrFail();

        $households->grantPermission(Permission::where('code', 'App\Models\Household')->firstOrFail(), 15);
        $households->grantPermission(Permission::where('code', 'App\Models\HouseholdHouse')->firstOrFail(), 15);
        $households->grantPermission(Permission::where('code', 'App\Models\HouseholdMember')->firstOrFail(), 15);
        $households->grantPermission(Permission::where('code', 'App\Models\HouseholdMemberLand')->firstOrFail(), 15);
        $households->grantPermission(Permission::where('code', 'App\Models\HouseholdOwner')->firstOrFail(), 15);
        $households->grantPermission(Permission::where('code', 'App\Models\HouseholdMemberMovement')->firstOrFail(), 15);

    }
}
