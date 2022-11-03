<?php

namespace Tests\Unit;

use App\Models\District;
use Tests\TestCase;
use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegionTest extends TestCase
{
    use RefreshDatabase;

    public function test_region_may_have_districts()
    {
        $region = Region::factory()->create(['name' => 'Сумська область']);

        District::factory()->count(3)->create(['region_id' => $region->id]);

        $this->assertCount(3, $region->districts);
    }
}
