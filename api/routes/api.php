<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExchangeController;

Route::get('exchange', [ExchangeController::class, 'getExchangeData']);
