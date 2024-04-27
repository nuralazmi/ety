<?php

namespace App\Console\Commands;

use App\Interfaces\ExchangeAdapterInterface;
use App\Interfaces\ExchangeInterface;
use Illuminate\Console\Command;
use App\Services\ExchangeApiAdapters\FirstExchangeApiAdapter;

class FetchExchangeData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:exchange-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get exchange data from api services';

    /**
     * Execute the console command.
     */

    protected ExchangeInterface $exchange_repository;

    public function __construct(ExchangeInterface $exchange_repository)
    {
        parent::__construct();
        $this->exchange_repository = $exchange_repository;
    }

    public function handle(): void
    {
        $adapters = [
            new FirstExchangeApiAdapter(),
        ];

        foreach ($adapters as $adapter) {
            $this->fetchAndSaveData($adapter);
        }

        $this->info('Exchange data fetched and stored successfully.');
    }

    private function fetchAndSaveData(ExchangeAdapterInterface $adapter): void
    {
        $data = $adapter->fetchAndTransformData();
        $source = $adapter->getSource();

        foreach ($data as $item) {
            if (!$item) continue;

            $this->exchange_repository->updateOrCreate([
                'code' => $item['code'],
                'source' => $source,
                'created_at' => today(),
            ], $item);
        }
    }
}
