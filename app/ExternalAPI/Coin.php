<?php

namespace App\ExternalAPI;

interface Coin
{
    public function getCertainCoinPrice(string $coinName): float;
}
