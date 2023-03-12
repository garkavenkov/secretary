<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();

        DB::table('permissions')->insert([
            [
                'code'          =>  'App\Models\Household',
                'name'          =>  'Облікова картка',
                // 'description'   =>  'Облікова картка домогосподарства',
                'error'         =>  'У Вас відсутні права на {{action}} облікової картки'
            ],
            // [
            //     'code'          =>  'household:read',
            //     'name'          =>  'Облікова картка:читання',
            //     'description'   =>  'Читання облікової картки',
            //     'error'         =>  'У Вас відсутні права на читання облікової картки'
            // ],
            // [
            //     'code'          =>  'household:update',
            //     'name'          =>  'Облікова картка:редагування',
            //     'description'   =>  'Редагування облікової картки',
            //     'error'         =>  'У Вас відсутні права на редагування облікової картки'
            // ],
            // [
            //     'code'          =>  'household:delete',
            //     'name'          =>  'Облікова картка:видалення',
            //     'description'   =>  'Видалення облікової картки',
            //     'error'         =>  'У Вас відсутні права на видалення облікової картки'
            // ]
        ]);
    }
}
