<?php

namespace App\Services;

use App\Interfaces\ExchangeInterface;
use Illuminate\Support\Facades\Cache;

class ExchangeService
{

    /**
     * @example exchange_data_2024-04-28
     * @var string
     */
    private string $cache_key_text = 'exchange_data_';

    /**
     * @var ExchangeInterface
     */
    private ExchangeInterface $exchange_repository;

    public function __construct(ExchangeInterface $exchange_repository)
    {
        $this->exchange_repository = $exchange_repository;
    }

    /**
     * @param string $date
     * @return array
     */
    public function getExchangeData(string $date): array
    {
        $currency_data = Cache::remember($this->cache_key_text . $date, now()->addHours(6), function () use ($date) {
            return $this->exchange_repository->getByCreatedAt($date, ['symbol', 'price', 'code', 'source']);
        });
        $cheapest_data = $currency_data->sortBy('price')->first();

        return [
            'date' => $date,
            'current_date_items' => $currency_data,
            'cheapest' => $cheapest_data
        ];
    }

    /**
     * @param $date
     * @return void
     */
    public function clearCache($date = null): void
    {
        Cache::forget($this->cache_key_text . $date);
    }

}
