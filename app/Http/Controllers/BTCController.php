<?php

namespace App\Http\Controllers;

use App\ExternalAPI\Coin;
use Illuminate\Support\Facades\Cache;

class BTCController extends Controller
{
    public function getRate()
    {
//        return response()->json([
//            'rate' => Cache::get('btcRate')
//        ],
//            200);
        return response()->json([
            'rate' => (new Coin())->getCertainCoinPrice('BTC')
            ],
            200);
    }
}
