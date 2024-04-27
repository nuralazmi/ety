<?php

namespace App\Repositories;

use App\Interfaces\ExchangeInterface;
use App\Models\Exchange;

class ExchangeRepository implements ExchangeInterface
{
    protected Exchange $model;

    public function __construct(Exchange $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $columns
     * @param array $data
     * @return bool
     */
    public function updateOrCreate(array $columns, array $data): bool
    {
        $this->model->query()->updateOrCreate($columns, $data);
        return true;
    }

}
