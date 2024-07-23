<?php

namespace Database\Seeders;

use App\Models\SettlementType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettlementTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SettlementType::truncate();

        DB::table('settlement_types')->insert([
            [
                'name'          =>  'Селище міського типу',
                'abbreviation'  =>  'смт.'
            ],
            [
                'name'          =>  'Село',
                'abbreviation'  =>  'с.'
            ],
        ]);
    }
}
