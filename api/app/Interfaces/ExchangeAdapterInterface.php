<?php

namespace App\Interfaces;

interface ExchangeAdapterInterface
{
    /**
     * @return array
     */
    public function fetchAndTransformData(): array;

    /**
     * @return string
     */
    public function getSource(): string;

    /**
     * @param array $data
     * @return array
     */
    public function transformData(array $data): array;
}
