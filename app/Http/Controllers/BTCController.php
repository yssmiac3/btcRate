<?php

namespace App\Http\Controllers;

use App\ExternalAPI\CoinPaprika;
use App\Services\RateService;
use Illuminate\Support\Facades\Cache;

class BTCController extends Controller
{
    public function getRate()
    {
//        return response()->json([
//            'rate' => Cache::get('btcRate')
//        ],
//            200);
        $rate = resolve(RateService::class)->getRate('BTC');
        return response()->json([
            'rate' => $rate
            ],
            200);
    }
}
