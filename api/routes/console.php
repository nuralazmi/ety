<?php

use App\Console\Commands\FetchExchangeData;
use Illuminate\Support\Facades\Schedule;

Schedule::command(FetchExchangeData::class)->hourly();

