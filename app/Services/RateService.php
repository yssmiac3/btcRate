<?php

namespace App\Services;

use App\ExternalAPI\Coin;
use Illuminate\Support\Facades\Cache;

class RateService
{
    private $rateProvider;

    public function __construct(Coin $coin)
    {
        $this->rateProvider = $coin;
    }

    public function getRate(string $coin)
    {
        return Cache::remember(strtoupper($coin) . 'Rate',
            60,
            fn() => $this->rateProvider->getCertainCoinPrice($coin)
        );
    }
}
