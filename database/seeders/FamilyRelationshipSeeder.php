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
                'name'  =>  'дружина/чоловік'
            ],
            [
                'name'  =>  'дочка/син'
            ],
            [
                'name'  =>  'мати/батько'
            ],
            [
                'name'  =>  'сестра/брат'
            ],
            [
                'name'  =>  'невістка/зять'
            ],
            [
                'name'  =>  'свекруха/свекор;теща/тесть'
            ],
            [
                'name'  =>  'баба/дід'
            ],
            [
                'name'  =>  'онука/онук'
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
