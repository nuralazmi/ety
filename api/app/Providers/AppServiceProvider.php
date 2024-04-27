<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ExchangeRepository;
use App\Interfaces\ExchangeInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ExchangeInterface::class, ExchangeRepository::class);

//
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
