<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExchangeGetRouteTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_returns_exchange_data_with_date_param(): void
    {
        $date = '2024-04-27';
        $response = $this->get('/api/exchange?date=' . $date);
        $response->assertJsonStructure([
            'date',
            'current_date_items',
            'cheapest'
        ]);
    }
}
