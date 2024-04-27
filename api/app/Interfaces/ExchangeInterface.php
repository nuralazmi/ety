<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface ExchangeInterface
{
    /**
     * @param array $columns
     * @param array $data
     * @return bool
     */
    public function updateOrCreate(array $columns, array $data): bool;


    /**
     * @param string $date
     * @param array $columns
     * @return Collection|array
     */
    public function getByCreatedAt(string $date, array $columns = []): Collection|array;
}
