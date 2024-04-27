<?php

namespace App\Services\ExchangeApiAdapters;


use App\Interfaces\ExchangeAdapterInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use App\Services\Validators\ExchangeValidator;

class FirstExchangeApiAdapter implements ExchangeAdapterInterface
{
    private string $endpoint = 'https://mocki.io/v1/d48ae62a-d91f-48fe-963e-020532970dff';
    private string $mock_api_response = '{ "data": { "0": { "symbol": "$", "name": "dolar", "price": "32.50", "shortCode": "USA" }, "1": { "symbol": "€", "name": "euro", "price": "28.85", "shortCode": "EUR" }, "2": { "symbol": "£", "name": "sterlin", "price": "41.10", "shortCode": "GBP" } } }';

    public function fetchAndTransformData(): array
    {
        try {
            $client = new Client();
            $response = $client->request('GET', $this->endpoint);
            $body = $response->getBody()->getContents();
            return $this->transformData(json_decode($body, true));
        } catch (RequestException $e) {
            return $this->transformData(json_decode($this->mock_api_response, true));
        } catch (GuzzleException $e) {
            return [];
        }
    }

    public function getSource(): string
    {
        return 'first_api';
    }

    public function transformData(array $data): array
    {
        if (!isset($data['data'])) return [];
        else $data = $data['data'];

        return array_map(function ($item) {
            if (ExchangeValidator::validate($item, 'first')) {
                return [
                    'symbol' => $item['symbol'],
                    'price' => $item['price'],
                    'code' => $item['shortCode']
                ];
            } else return false;
        }, $data);
    }
}
