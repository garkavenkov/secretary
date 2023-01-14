<?php

namespace Database\Seeders;

use App\Models\MovementType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MovementTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MovementType::truncate();

        DB::table('movement_types')->insert([
            [
                'code'  =>  'register',
                'name'  =>  'Реєстрація місця проживання'
            ],
            [
                'code'  =>  'leave',
                'name'  =>  'Повне вибуття'
            ],
        ]);
    }
}
