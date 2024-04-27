<?php

namespace App\Repositories;

use App\Interfaces\ExchangeInterface;
use App\Models\Exchange;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ExchangeRepository implements ExchangeInterface
{
    protected Exchange $model;

    public function __construct(Exchange $model)
    {
        $this->model = $model;
    }

}
