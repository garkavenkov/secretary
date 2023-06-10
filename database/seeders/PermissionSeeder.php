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
        // Permission::truncate();
        DB::table('permissions')->delete();

        DB::table('permissions')->insert([
            [
                'code'          =>  'App\Models\HouseholdType',
                'name'          =>  'Тип об\'єкту погосподарського обліку',
                'description'   =>  'Операції з типами об`єктів погосподарського обліку',
                'error'         =>  'У Вас відсутні права на {{action}} типу об\`єкта погосопдарського обліку'
            ],
            [
                'code'          =>  'App\Models\Household',
                'name'          =>  'Облікова картка',
                'description'   =>  'Операції з обліковою карткою домогосподарства',
                'error'         =>  'У Вас відсутні права на {{action}} облікової картки'
            ],
            [
                'code'          =>  'App\Models\HouseholdOwner',
                'name'          =>  'Власник домогосподарства',
                'description'   =>  'Операції з власником домогосподарства',
                'error'         =>  'У Вас відсутні права на {{action}} власника домогосподарства'
            ],
            [
                'code'          =>  'App\Models\HouseholdHouse',
                'name'          =>  'Будинок/Квартира домогосподарства',
                'description'   =>  'Операції з будинком/квартирою домогосподарства',
                'error'         =>  'У Вас відсутні права на {{action}} будинка/квартири домогосподарства'
            ],
            [
                'code'          =>  'App\Models\HouseholdLand',
                'name'          =>  'Земельна ділянка домогосподарства',
                'description'   =>  'Операції з земельною ділянкою домогосподарства',
                'error'         =>  'У Вас відсутні права на {{action}} земельної ділянки домогосподарства'
            ],
            [
                'code'          =>  'App\Models\HouseholdMember',
                'name'          =>  'Член домогосподарства',
                'description'   =>  'Операції з членом домогосподарства',
                'error'         =>  'У Вас відсутні права на {{action}} члена домогосподарства'
            ],
            [
                'code'          =>  'App\Models\HouseholdMemberLand',
                'name'          =>  'Земельная ділянка члена домогосподарства',
                'description'   =>  'Операції із земельною ділянкою члена домогосподарства',
                'error'         =>  'У Вас відсутні права на {{action}} земельної ділянки члена домогосподарства'
            ],
            [
                'code'          =>  'App\Models\Region',
                'name'          =>  'Область',
                'description'   =>  'Операції з областями',
                'error'         =>  'У Вас відсутні права на {{action}} області'
            ],
            [
                'code'          =>  'App\Models\District',
                'name'          =>  'Район',
                'description'   =>  'Операції з районами',
                'error'         =>  'У Вас відсутні права на {{action}} району'
            ],
            [
                'code'          =>  'App\Models\Community',
                'name'          =>  'Громада',
                'description'   =>  'Операції з громадами',
                'error'         =>  'У Вас відсутні права на {{action}} громади'
            ],
            [
                'code'          =>  'App\Models\Council',
                'name'          =>  'Міська / сільська рада',
                'description'   =>  'Операції з міськими / сільськими радами',
                'error'         =>  'У Вас відсутні права на {{action}} міської / сільської ради'
            ],
            [
                'code'          =>  'App\Models\Settlement',
                'name'          =>  'Населений пункт',
                'description'   =>  'Операції з населеними пунктами',
                'error'         =>  'У Вас відсутні права на {{action}} населеного пункта'
            ],
            [
                'code'          =>  'App\Models\SettlementType',
                'name'          =>  'Тип населеного пункту',
                'description'   =>  'Операції з типами населених пунктів',
                'error'         =>  'У Вас відсутні права на {{action}} типу населеного пункта'
            ],
            [
                'code'          =>  'App\Models\WorkPlace',
                'name'          =>  'Код місця роботи',
                'description'   =>  'Операції з кодами місць роботи',
                'error'         =>  'У Вас відсутні права на {{action}} коду місця роботи'
            ],
            [
                'code'          =>  'App\Models\FamilyRelationshipType',
                'name'          =>  'Тип родинних стосунків',
                'description'   =>  'Операції з типами родинних стосунків',
                'error'         =>  'У Вас відсутні права на {{action}} тип родинних стосунків'
            ],
            [
                'code'          =>  'App\Models\AdditionalParamCategory',
                'name'          =>  'Категорія додаткових параметрів',
                'description'   =>  'Операції з категоріями додаткових параметрів',
                'error'         =>  'У Вас відсутні права на {{action}} категорії додаткових параметрів'
            ],
            [
                'code'          =>  'App\Models\AdditionalParam',
                'name'          =>  'Додатковий параметр',
                'description'   =>  'Операції з додатковими параметрами',
                'error'         =>  'У Вас відсутні права на {{action}} додаткового параметру'
            ],
            [
                'code'          =>  'App\Models\Role',
                'name'          =>  'Ролі',
                'description'   =>  'Операції з ролями',
                'error'         =>  'У Вас відсутні права на {{action}} ролі'
            ],
            [
                'code'          =>  'App\Models\User',
                'name'          =>  'Користувач',
                'description'   =>  'Операції з користувачами',
                'error'         =>  'У Вас відсутні права на {{action}} користувача'
            ],
            [
                'code'          =>  'App\Models\Permission',
                'name'          =>  'Дозвіл',
                'description'   =>  'Операції з дозволами',
                'error'         =>  'У Вас відсутні права на {{action}} дозволу'
            ],
            [
                'code'          =>  'App\Models\PermissionRight',
                'name'          =>  'Права дозволу',
                'description'   =>  'Операції з правами дозволу',
                'error'         =>  'У Вас відсутні права на {{action}} права дозволу'
            ],
            // [
            //     'code'          =>  'App\Models\UserRole',
            //     'name'          =>  'Додатковий параметр',
            //     'error'         =>  'У Вас відсутні права на {{action}} додаткового параметру'
            // ],
        ]);
    }
}
