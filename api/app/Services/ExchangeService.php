<?php

namespace App\Services;

use App\Interfaces\ExchangeInterface;

class ExchangeService
{

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
        $currencyData = $this->exchange_repository->getByCreatedAt($date, ['symbol', 'price', 'code', 'source']);
        $cheapestCurrencyInfo = $currencyData->sortBy('price')->first();

        return [
            'date' => $date,
            'current_date_items' => $currencyData,
            'cheapest' => $cheapestCurrencyInfo
        ];
    }
}
