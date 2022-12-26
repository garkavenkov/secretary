<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AdditionalParamCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdditionalParamCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdditionalParamCategory::truncate();

        DB::table('additional_param_categories')->insert([
            [
                'code'  =>  'household',
                'name'  =>  'Домогосподарство'
            ],
            [
                'code'  =>  'household-member',
                'name'  =>  'Член домогосподарства'
            ]
        ]);
    }
}
