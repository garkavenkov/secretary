<?php

namespace Database\Seeders;

use App\Models\Report;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Report::truncate();

        DB::table('reports')->insert([
            [
                // 'icon'          =>  'mdi mdi-file',
                'code'          =>  "family_composition",
                'name'          =>  "Довідка про склад сім\'ї",
                'file_name'     =>  "FamilyComposition.docx",
                'model'         =>  "App\Models\HouseholdMember"
            ],
            [
                // 'icon'          =>  'mdi mdi-file',
                'code'          =>  "land_owned",
                'name'          =>  "Довідка про наявність земельної ділянки",
                'file_name'     =>  "LandOwned.docx",
                'model'         =>  "App\Models\HouseholdMember"
            ]
        ]);
    }
}
