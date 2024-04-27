<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExchangeController;
use App\Http\Middleware\SetLocaleMiddleware;

Route::middleware([SetLocaleMiddleware::class])->group(function () {
    Route::get('exchange', [ExchangeController::class, 'getExchangeData']);
});
