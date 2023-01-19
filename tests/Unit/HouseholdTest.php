<?php

namespace Tests\Unit;

use App\Models\AdditionalParam;
use App\Models\AdditionalParamCategory;
use Tests\TestCase;
use App\Models\Household;
use App\Models\HouseholdHouse;
use App\Models\HouseholdLand;
use App\Models\HouseholdMember;
use App\Models\HouseholdType;
use App\Models\Settlement;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HouseholdTest extends TestCase
{
    use RefreshDatabase;

    public function test_household_may_have_information_about_house()
    {
        $household = Household::factory()->create();

        HouseholdHouse::factory()->count(3)->create(['household_id' => $household->id]);

        $this->assertCount(3, $household->houseYears);
    }

    public function test_household_must_have_settlement()
    {
        $settlement = Settlement::factory()->create(['name' => 'Шаповалівка']);
        $household = Household::factory()->create(['settlement_id' => $settlement->id]);

        $this->assertEquals($household->settlement->name, $settlement->name);
    }

    public function test_household_must_have_type()
    {
        $type = HouseholdType::factory()->create(['name' => 'Тип 1']);
        $household = Household::factory()->create(['household_type_id' => $type->id]);

        $this->assertEquals($household->type->name, $type->name);
    }

    public function test_household_may_have_memebers()
    {
        $household = Household::factory()->create();

        HouseholdMember::factory()->count(3)->create(['household_id' => $household->id]);

        $this->assertCount(3, $household->members);
    }

    public function test_household_may_have_additional_params()
    {
        $household = Household::factory()->create();
        $category = AdditionalParamCategory::factory()->create(['code' => 'category']);
        $param = AdditionalParam::factory()->create(['category_id' => $category->id, 'code' => 'param']);

        $this->assertArrayHasKey($household->params, $param->code);
    }

    public function test_household_may_have_information_about_land()
    {
        $household = Household::factory()->create();

        HouseholdLand::factory()->count(3)->create(['household_id' => $household->id]);

        $this->assertCount(3, $household->landYears);
    }
}
