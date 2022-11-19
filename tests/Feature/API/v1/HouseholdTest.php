<?php

namespace Tests\Feature\API\v1;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HouseholdTest extends TestCase
{
    private $url;

    protected function setUp(): void
    {
        parent::setUp();

        $this->url = '/api/v1/households';
    }

}
