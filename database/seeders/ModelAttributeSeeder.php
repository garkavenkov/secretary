<?php

namespace Database\Seeders;

use App\Models\ModelAttribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModelAttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ModelAttribute::truncate();

        DB::table('model_attributes')->insert([
            [
                'model'             =>  'App\\Models\\HouseholdMember',
                'code'              =>  'full_age',
                'name'              =>  'Вік (повних років)',
                'available_values'  =>  '',
                'conditions'        =>  '>=,>,=,!=,<=,<',
            ],
            [
                'model'             =>  'App\\Models\\HouseholdMember',
                'code'              =>  'gender',
                'name'              =>  'Стать',
                'available_values'  =>  'чоловіча,жіноча',
                'conditions'        =>  '=,!='
            ],
            
        ]);
    }
}
