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
                'icon'          =>  'mdi mdi-file',
                'name'          =>  "Довідка про стан сім\'ї",
                'description'   =>  "Довідка про стан сім\'ї",
                'file_name'     =>  "family_composition.docx",
                'model'         =>  "App\Models\HouseholdMember"
            ],
            [
                'icon'          =>  'mdi mdi-file',
                'name'          =>  "Земельна ділянка",
                'description'   =>  "Довідка про наявність земельної ділянки",
                'file_name'     =>  "member_land.docx",
                'model'         =>  "App\Models\HouseholdMember"
            ]
        ]);
    }
}
