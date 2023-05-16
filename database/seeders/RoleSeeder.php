<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        DB::table('roles')->insert([
            [
                'code'          =>  'administrator',
                'name'          =>  'Адміністратор',
                'description'   =>  'Адміністратор системи',
                'system'        =>  true
            ],
            [
                'code'          =>  'secretary',
                'name'          =>  'Секретар',
                'description'   =>  'Секретар',
                'system'        =>  false
            ],
            [
                'code'          =>  'specialist',
                'name'          =>  'Специаліст',
                'description'   =>  'Специаліст',
                'system'        =>  false
            ],
            [
                'code'          =>  'households',
                'name'          =>  'Облікові картки домогосподарств',
                'description'   =>  'Операції з обліковими картками домогосподарств',
                'system'        =>  false
            ],
        ]);
    }
}
