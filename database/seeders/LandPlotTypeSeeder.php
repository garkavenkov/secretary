<?php

namespace Database\Seeders;

use App\Models\LandPlotType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LandPlotTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LandPlotType::truncate();

        DB::table('land_plot_types')->insert([
            [
                'name'  =>  'для будівництва і обслуговування житлового будинку, господарських будівель і споруд (присадибна ділянка)'
            ],
            [
                'name'  =>  'для ведення особистого сельянського господарства'
            ],
            [
                'name'  =>  'для ведення товарного сільськогосподарського виробництва'
            ],
            [
                'name'  =>  'для сінокосіння і випасання худоби'
            ],
            [
                'name'  =>  'для городництва'
            ],
            [
                'name'  =>  'для індивідуального господарства'
            ],
        ]);
    }
}
