<?php

namespace Database\Seeders;

use App\Models\HouseholdType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HouseholdTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HouseholdType::truncate();

        DB::table('household_types')->insert([
            [
                'name'  =>  'домогосподарство з реєстрацією місця проживання на території населеного пункту'
            ],
            [
                'name'  =>  'домогосподарство з реґстрацією місця перебування на території населеного пункту'
            ],
            [
                'name'  =>  'домоволодіння'
            ],
            [
                'name'  =>  'землеволодіння'
            ],
            [
                'name'  =>  'закинутий об\'єкт'
            ],
        ]);
    }
}
