<?php

namespace Database\Seeders;

use App\Models\AdditionalParam;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AdditionalParamCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdditionalParamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdditionalParam::truncate();

        $category = AdditionalParamCategory::where('code', 'household')->first();

        DB::table('additional_params')->insert([
            [
                'category_id'   =>  $category->id,
                'code'          =>  'owner',
                'name'          =>  'Власник'
            ]
        ]);
    }
}
