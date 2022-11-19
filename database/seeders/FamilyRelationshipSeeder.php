<?php

namespace Database\Seeders;

use App\Models\FamilyRelationship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FamilyRelationshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FamilyRelationship::truncate();

        DB::table('family_relationships')->insert([
            [
                'name'  =>  'голова домогосподарства'
            ],
            [
                'name'  =>  'дружина'
            ],
            [
                'name'  =>  'чоловік'
            ],
            [
                'name'  =>  'дочка'
            ],
            [
                'name'  =>  'син'
            ],
            [
                'name'  =>  'мати'
            ],
            [
                'name'  =>  'батько'
            ],
            [
                'name'  =>  'сестра'
            ],
            [
                'name'  =>  'брат'
            ],
            [
                'name'  =>  'невістка'
            ],
            [
                'name'  =>  'зять'
            ],
            [
                'name'  =>  'свекруха'
            ],
            [
                'name'  =>  'свекор'
            ],
            [
                'name'  =>  'теща'
            ],
            [
                'name'  =>  'тесть'
            ],
            [
                'name'  =>  'баба'
            ],
            [
                'name'  =>  'дід'
            ],
            [
                'name'  =>  'онука'
            ],
            [
                'name'  =>  'онук'
            ],
            [
                'name'  =>  'інший ступінь родинних стосунків (свояцтво)'
            ],
            [
                'name'  =>  'не пов\'язаний(на) родинними стосунками'
            ],
        ]);
    }
}
