<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ExchangeController extends Controller
{
    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getExchangeData(Request $request): JsonResponse
    {
        return response()->json([]);
    }
}
