<?php

namespace Tests\Unit;

use App\Models\Council;
use App\Models\Settlement;
use App\Models\SettlementType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SettlementTest extends TestCase
{
    use RefreshDatabase;

    public function test_settlement_must_have_council()
    {
        $council = Council::factory()->create();

        $settlement = Settlement::factory()->create(['council_id' => $council->id]);

        $this->assertEquals($council->name, $settlement->council->name);
    }

    public function test_settlement_must_have_type()
    {
        $type = SettlementType::factory()->create(['name' => 'село']);

        $settlement = Settlement::factory()->create(['settlement_type_id' => $type->id]);

        $this->assertEquals($settlement->type->name, $type->name);
    }
}
