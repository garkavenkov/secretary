<?php

namespace Tests\Unit;

use App\Models\Council;
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
}
