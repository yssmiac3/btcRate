<?php

namespace Tests\Feature;

use App\ExternalAPI\Coin;
use Tests\TestCase;

class GetCoinRateTest extends TestCase
{
    public function test_getting_btc_rate_from_api()
    {
       $rate = (new Coin())->getCertainCoinPrice('btc');

       $this->assertIsFloat($rate);
    }
}
