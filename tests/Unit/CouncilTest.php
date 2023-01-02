<?php

namespace Tests\Unit;

use App\Models\Community;
use App\Models\Council;
use App\Models\CouncilType;
use App\Models\Settlement;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CouncilTest extends TestCase
{
    use RefreshDatabase;

    public function test_council_may_have_settlements()
    {
        $council = Council::factory()->create();

        $settlement = Settlement::factory()->count(3)->create(['council_id' => $council->id]);

        $this->assertCount(3, $council->settlements);
    }

    public function test_council_MUST_HAVE_community()
    {
        $community = Community::factory()->create(['name' => 'Громада']);
        $council = Council::factory()->create(['community_id' => $community->id]);

        $this->assertEquals($council->community->name, $community->name);
    }

    public function test_council_MUST_HAVE_type()
    {
        $type = CouncilType::factory()->create(['name' => 'тип']);

        $council = Council::factory()->create(['council_type_id' => $type->id]);

        $this->assertEquals($council->type->name, $type->name);
    }
}
