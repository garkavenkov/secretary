<?php

namespace Database\Seeders;

use App\Models\Region;
use App\Models\Council;
use App\Models\District;
use App\Models\Community;
use App\Models\CouncilType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CouncilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Council::truncate();

        $type = CouncilType::where('name', 'Сільська рада')->first();

        $district = District::where('name', 'Конотопський район')
                        ->where('region_id', Region::where('name', 'Сумська область')->first()->id)
                        ->first();

        $community = Community::where('name', 'Попівська громада')->where('district_id', $district->id)->first();

        DB::table('councils')->insert([
            [
                'community_id'      =>  $community->id,
                'council_type_id'   =>  $type->id,
                'name'              =>  'Шаповалівська сільська рада',
                'address'           =>  '41660, Сумська обл., Конотопський р-н, с. Шаповалівка, площа Козацької слави, буд. 9',
                'edrpou'            =>  '04389288',
                'koatuu'            =>  '5922088701',
            ]
        ]);
    }
}
