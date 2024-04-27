<?php

namespace App\Interfaces;

interface ExchangeInterface
{
    /**
     * @param array $columns
     * @param array $data
     * @return bool
     */
    public function updateOrCreate(array $columns, array $data): bool;

}
