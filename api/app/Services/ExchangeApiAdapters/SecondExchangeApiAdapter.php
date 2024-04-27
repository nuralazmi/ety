<?php

namespace App\Services\ExchangeApiAdapters;


use App\Interfaces\ExchangeAdapterInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use App\Services\Validators\ExchangeValidator;

class SecondExchangeApiAdapter implements ExchangeAdapterInterface
{
    private string $endpoint = 'https://mocki.io/v1/6242a1b1-99a1-4237-8b39-17784726e56f';
    private string $mock_api_response = '{ "data": { "0": { "symbol": "$", "currencyName": "dolar", "amount": "32.67", "shrtCode": "USA" }, "1": { "symbol": "€", "currencyName": "euro", "amount": "35.81", "shrtCode": "EUR" }, "2": { "symbol": "£", "currencyName": "sterlin", "amount": "40.93", "shrtCode": "GBP" } } }';

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
        return 'second_api';
    }

    public function transformData(array $data): array
    {
        if (!isset($data['data'])) return [];
        else $data = $data['data'];

        return array_map(function ($item) {
            if (ExchangeValidator::validate($item, 'second')) {
                return [
                    'symbol' => $item['symbol'],
                    'price' => $item['amount'],
                    'code' => $item['shrtCode']
                ];
            } else return false;
        }, $data);
    }
}
