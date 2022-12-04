<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Household;
use App\Models\HouseholdHouse;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HouseholdHouseTest extends TestCase
{
    use RefreshDatabase;

    public function test_house_must_have_household()
    {
        $household = Household::factory()->create();

        $house = HouseholdHouse::factory()->create(['household_id' => $household->id]);

        $this->assertEquals($house->card->address, $household->address);
    }
}
