<?php

namespace Database\Seeders;

use App\Models\Council;
use App\Models\Settlement;
use App\Models\SettlementType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettlementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settlement::truncate();

        $council = Council::where('koatuu', '5922088701')->first();
        $type = SettlementType::where('name', 'Село')->first();

        DB::table('settlements')->insert([
            [
                'council_id'            =>  $council->id,
                'settlement_type_id'    =>  $type->id,
                'name'                  =>  'Шаповалівка',
                'inner_code'            =>  1,
                'postcode'              =>  '41660',
                'katottg'               =>  'UA59020130380057468'
            ],
            [
                'council_id'            =>  $council->id,
                'settlement_type_id'    =>  $type->id,
                'name'                  =>  'Привокзальне',
                'inner_code'            =>  2,
                'postcode'              =>  '41661',
                'katottg'               =>  'UA59020130250036991'
            ],
        ]);
    }
}
