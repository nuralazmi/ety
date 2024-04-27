<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExchangeFetchTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_fetches_and_saves_exchange_data(): void
    {
        $this->artisan('fetch:exchange-data')
            ->expectsOutput('Exchange data fetched and stored successfully.')
            ->assertExitCode(0);
    }
}
