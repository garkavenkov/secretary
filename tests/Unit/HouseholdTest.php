<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Household;
use App\Models\HouseholdHouse;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HouseholdTest extends TestCase
{
    use RefreshDatabase;

    public function test_household_may_have_information_about_house()
    {
        $household = Household::factory()->create();

        HouseholdHouse::factory()->count(3)->create(['household_id' => $household->id]);

        $this->assertCount(3, $household->house);
    }
}
