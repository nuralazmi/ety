<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExchangeGetRequest;
use Illuminate\Http\JsonResponse;
use App\Services\ExchangeService;

class ExchangeController extends Controller
{
    protected ExchangeService $exchangeService;

    public function __construct(ExchangeService $exchangeService)
    {
        $this->exchangeService = $exchangeService;
    }

    /**
     * @param ExchangeGetRequest $request
     * @return JsonResponse
     */
    public function getExchangeData(ExchangeGetRequest $request): JsonResponse
    {
        $date = $request->input('date', now()->toDateString());
        $data = $this->exchangeService->getExchangeData($date);
        return response()->json($data);
    }
}
