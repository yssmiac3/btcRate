<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Cache;

class BTCController extends Controller
{
    public function getRate()
    {
        return Cache::get('btcRate');
    }
}
