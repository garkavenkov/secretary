<?php

namespace Database\Seeders;

use App\Models\WorkPlace;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkPlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        WorkPlace::truncate();

        DB::table('work_places')->insert([
            [
                'name'  =>  'на території населенного пункту проживання/перебування'
            ],
            [
                'name'  =>  'за межами населенного пункту проживання/перебування у межаї територільної громаді (об\'єднаної територіальної громади)'
            ],
            [
                'name'  =>  'за межами територіальної громади (об\'єднаної територіальної громади), в межах району'
            ],
            [
                'name'  =>  'за межами району, в межах рагіону'
            ],
            [
                'name'  =>  'за межами регіону, в межаї України'
            ],
            [
                'name'  =>  'за кордоном'
            ],
        ]);
    }
}
