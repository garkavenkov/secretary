<?php

namespace Database\Seeders;

use App\Models\AdditionalParam;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AdditionalParamCategory;
use App\Models\AdditionalParamValueType;
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

        $household = AdditionalParamCategory::where('code', 'App\Models\Household')->first();
        $member = AdditionalParamCategory::where('code', 'App\Models\HouseholdMember')->first();

        $text_type = AdditionalParamValueType::where('code', 'text')->first();
        $bool_type = AdditionalParamValueType::where('code', 'boolean')->first();

        DB::table('additional_params')->insert([
            [
                'category_id'   =>  $household->id,
                'code'          =>  'house_year_of_construction',
                'name'          =>  'Рік побудови',
                'value_type_id' =>  $text_type->id,
                'is_system'     =>  true
            ],
            [
                'category_id'   =>  $household->id,
                'code'          =>  'house_material_walls',
                'name'          =>  'Матеріал стін',
                'value_type_id' =>  $text_type->id,
                'is_system'     =>  true
            ],
            [
                'category_id'   =>  $household->id,
                'code'          =>  'house_material_roof',
                'name'          =>  'Матеріал покровлі',
                'value_type_id' =>  $text_type->id,
                'is_system'     =>  true
            ],
            [
                'category_id'   =>  $household->id,
                'code'          =>  'house_additional_data',
                'name'          =>  'Додаткова інформація по будинку',
                'value_type_id' =>  $text_type->id,
                'is_system'     =>  true
            ],
            [
                'category_id'   =>  $household->id,
                'code'          =>  'land_additional_data',
                'name'          =>  'Додаткова інформація по землі',
                'value_type_id' =>  $text_type->id,
                'is_system'     =>  true
            ],
            [
                'category_id'   =>  $household->id,
                'code'          =>  'family_single_parent',
                'name'          =>  'Неповна сім\'я',
                'value_type_id' =>  $bool_type->id,
                'is_system'     =>  false
            ],
            [
                'category_id'   =>  $household->id,
                'code'          =>  'family_single_parent_multi_child',
                'name'          =>  'Неповна багатодітна сім\'я',
                'value_type_id' =>  $bool_type->id,
                'is_system'     =>  false
            ],

            [
                'category_id'   =>  $member->id,
                'code'          =>  'disabled',
                'name'          =>  'Інвалід',
                'value_type_id' =>  $bool_type->id,
                'is_system'     =>  false
            ],
            [
                'category_id'   =>  $member->id,
                'code'          =>  'child_orphan',
                'name'          =>  'Дитина сирота',
                'value_type_id' =>  $bool_type->id,
                'is_system'     =>  false
            ],
            [
                'category_id'   =>  $member->id,
                'code'          =>  'child_disabled',
                'name'          =>  'Дитина інвалід',
                'value_type_id' =>  $bool_type->id,
                'is_system'     =>  false
            ],
            [
                'category_id'   =>  $member->id,
                'code'          =>  'single_parent_multi_child',
                'name'          =>  'Одинока багатодітна мати(батько)',
                'value_type_id' =>  $bool_type->id,
                'is_system'     =>  false
            ],
            [
                'category_id'   =>  $member->id,
                'code'          =>  'single_parent',
                'name'          =>  'Одинока мати(батько)',
                'value_type_id' =>  $bool_type->id,
                'is_system'     =>  false
            ],
        ]);
    }
}
