<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Region;
use App\Models\District;
use App\Models\Community;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DistrictTest extends TestCase
{
    use RefreshDatabase;

    public function test_district_must_have_region()
    {
        $region = Region::factory()->create(['name' => 'Сумська область']);

        $district = District::factory()->create(['region_id' => $region->id, 'name' => 'Конотопський район']);

        $this->assertEquals($region->name, $district->region->name);
    }

    public function test_district_may_have_communities()
    {
        $district = District::factory()->create(['name' => 'Конотопський район']);

        Community::factory()->count(3)->create(['district_id' => $district->id]);

        $this->assertCount(3, $district->communities);
    }
}
