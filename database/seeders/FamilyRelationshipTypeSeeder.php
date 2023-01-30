<?php

namespace Database\Seeders;

use App\Models\FamilyRelationshipType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamilyRelationshipTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FamilyRelationshipType::truncate();

        DB::table('family_relationship_types')->insert([
            [
                'name'  =>  'голова домогосподарства',
                'sex'   =>  ''
            ],
            [
                'name'  =>  'дружина',
                'sex'   =>  'жіноча'
            ],
            [
                'name'  =>  'чоловік',
                'sex'   =>  'чоловіча'
            ],
            [
                'name'  =>  'дочка',
                'sex'   =>  'жіноча'
            ],
            [
                'name'  =>  'син',
                'sex'   =>  'чоловіча'
            ],
            [
                'name'  =>  'мати',
                'sex'   =>  'жіноча'
            ],
            [
                'name'  =>  'батько',
                'sex'   =>  'чоловіча'
            ],
            [
                'name'  =>  'сестра',
                'sex'   =>  'жіноча'
            ],
            [
                'name'  =>  'брат',
                'sex'   =>  'чоловіча'
            ],
            [
                'name'  =>  'невістка',
                'sex'   =>  'жіноча'
            ],
            [
                'name'  =>  'зять',
                'sex'   =>  'чоловіча'
            ],
            [
                'name'  =>  'свекруха',
                'sex'   =>  'жіноча'
            ],
            [
                'name'  =>  'свекор',
                'sex'   =>  'чоловіча'
            ],
            [
                'name'  =>  'теща',
                'sex'   =>  'жіноча'
            ],
            [
                'name'  =>  'тесть',
                'sex'   =>  'чоловіча'
            ],
            [
                'name'  =>  'баба',
                'sex'   =>  'жіноча'
            ],
            [
                'name'  =>  'дід',
                'sex'   =>  'чоловіча'
            ],
            [
                'name'  =>  'онука',
                'sex'   =>  'жіноча'
            ],
            [
                'name'  =>  'онук',
                'sex'   =>  'чоловіча'
            ],
            [
                'name'  =>  'інший ступінь родинних стосунків (свояцтво)',
                'sex'   =>  ''
            ],
            [
                'name'  =>  'не пов\'язаний(на) родинними стосунками',
                'sex'   =>  ''
            ],
        ]);
    }
}
