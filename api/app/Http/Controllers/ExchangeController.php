<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExchangeGetRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExchangeController extends Controller
{
    /**
     * @param ExchangeGetRequest $request
     * @return JsonResponse
     */
    public function getExchangeData(ExchangeGetRequest $request): JsonResponse
    {
        return response()->json([]);
    }
}
