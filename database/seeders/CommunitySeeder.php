<?php

namespace Database\Seeders;

use App\Models\Community;
use App\Models\District;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Community::truncate();

        DB::table('communities')->insert([
            [
                'district_id'   =>  District::where('name', 'Конотопський район')->first()->id,
                'name'          =>  'Попівська громада',
                'address'       =>  'Сумська обл., Конотопський р-н, с. Попівка, вул. Миру, буд. 1',
                'koatuu'        =>  '5922086601',
                'edrpou'        =>  '04389220'
            ]
        ]);
    }
}
