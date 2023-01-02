<?php

namespace Tests\Unit;

use App\Models\Community;
use App\Models\Council;
use App\Models\District;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommunityTest extends TestCase
{
    use RefreshDatabase;

    public function test_community_MUST_HAVE_district()
    {
        $district = District::factory()->create(['name' => 'Конотопський район']);

        $community = Community::factory()->create(['district_id' => $district->id]);

        $this->assertEquals($community->district->name, $district->name);
    }

    public function test_community_MAY_HAVE_councils()
    {
        $community = Community::factory()->create();

        Council::factory()->count(3)->create(['community_id' => $community->id]);

        $this->assertCount(3, $community->councils);
    }
}
