<?php

namespace App\Services\Validators;

class ExchangeValidator
{
    /**
     * @param $item
     * @param $adapterType
     * @return bool
     */
    public static function validate($item, $adapterType): bool
    {
        if ($adapterType === 'first_api') {
            return isset($item['symbol']) && isset($item['price']) && isset($item['shortCode']);
        } elseif ($adapterType === 'second_api') {
            return isset($item['symbol']) && isset($item['amount']) && isset($item['shrtCode']);
        } else {
            return false; // Bilinmeyen adapter türü için false döndür
        }
    }
}
