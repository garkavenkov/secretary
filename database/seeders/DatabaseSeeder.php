<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\District;
use App\Models\Community;
use App\Models\WorkPlace;
use App\Models\CouncilType;
use App\Models\LandPlotType;
use App\Models\HouseholdType;
// use App\Models\SettlementType;
use App\Models\FamilyRelationship;
use Illuminate\Database\Seeder;
use Database\Seeders\RegionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            // UserSeeder::class,
            SettlementTypeSeeder::class,
            CouncilTypeSeeder::class,
            HouseholdTypeSeeder::class,
            LandPlotTypeSeeder::class,
            SettlementTypeSeeder::class,
            WorkPlaceSeeder::class,
            FamilyRelationshipSeeder::class,
            RegionSeeder::class,
            DistrictSeeder::class,
            CommunitySeeder::class,
        ]);

    }
}
