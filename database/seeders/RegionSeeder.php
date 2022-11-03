<?php

namespace Database\Seeders;

use App\Models\Region;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Region::truncate();

        DB::table('regions')->insert([
            [
                'name'      =>  'Автономна Республіка Крим',
                'center'    =>  'Сімферополь'
            ],
            [
                'name'      =>  'Вінницька область',
                'center'    =>  'Вінниця'
            ],
            [
                'name'      =>  'Волинська область',
                'center'    =>  'Волинь'
            ],
            [
                'name'      =>  'Дніпропетровська область',
                'center'    =>  'Дніпро'
            ],
            [
                'name'      =>  'Донецька область',
                'center'    =>  'Донецьк'
            ],
            [
                'name'      =>  'Житомирська область',
                'center'    =>  'Житомир'
            ],
            [
                'name'      =>  'Закарпатська область',
                'center'    =>  'Закарпаття'
            ],
            [
                'name'      =>  'Запорізька область',
                'center'    =>  'Запоріжжя'
            ],
            [
                'name'      =>  'Івано-Франківська область',
                'center'    =>  'Івано-Франківськ'
            ],
            [
                'name'      =>  'Київська область',
                'center'    =>  'Київ'
            ],
            [
                'name'      =>  'Кіровоградська область',
                'center'    =>  'Кропивницький'
            ],
            [
                'name'      =>  'Луганська область',
                'center'    =>  'Луганськ'

            ],
            [
                'name'      =>  'Львівська область',
                'center'    =>  'Львів'
            ],
            [
                'name'      =>  'Миколаївська область',
                'center'    =>  'Миколаіїв'
            ],
            [
                'name'      =>  'Одеська область',
                'center'    =>  'Одеса'
            ],
            [
                'name'      =>  'Полтавська область',
                'center'    =>  'Полтава'
            ],
            [
                'name'      =>  'Рівненська область',
                'center'    =>  'Рівне'
            ],
            [
                'name'      =>  'Сумська область',
                'center'    =>  'Суми'
            ],
            [
                'name'      =>  'Тернопільська область',
                'center'    =>  'Тернопіль'
            ],
            [
                'name'      =>  'Харківська область',
                'center'    =>  'Харків'
            ],
            [
                'name'      =>  'Херсонська область',
                'center'    =>  'Херсон'
            ],
            [
                'name'      =>  'Хмельницька область',
                'center'    =>  'Хмельницький'
            ],
            [
                'name'      =>  'Черкаська область',
                'center'    =>  'Черкаси'
            ],
            [
                'name'      =>  'Чернівецька область',
                'center'    =>  'Чернівці'
            ],
            [
                'name'      =>  'Чернігівська область',
                'center'    =>  'Чернігів'
            ],
        ]);
    }
}


