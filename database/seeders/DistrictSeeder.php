<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\District;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        District::truncate();

        DB::table('districts')->insert([
            [
                'region_id' =>  Region::where('name', 'Сумська область')->first()->id,
                'name'      =>  'Конотопський район',
                'center'    =>  'Конотоп'
            ]
        ]);
    }
}
