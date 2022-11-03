<?php

namespace Database\Seeders;

use App\Models\CouncilType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouncilTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CouncilType::truncate();

        DB::table('council_types')->insert([
            [
                'name'  =>  'Сільська рада'
            ]
        ]);
    }
}
