<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AdditionalParamValueType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdditionalParamValueTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdditionalParamValueType::truncate();

        DB::table('additional_param_value_types')->insert([
            [
                'code'          =>  'text',
                'name'          =>  'Текст',
                'description'   =>  'Текстове значення'
            ],
            [
                'code'          =>  'number',
                'name'          =>  'Число',
                'description'   =>  'Числове значення'
            ],
            [
                'code'          =>  'boolean',
                'name'          =>  'Логічне (так/ні)',
                'description'   =>  'Логічне значення (так/ні)'
            ]
        ]);
    }
}
